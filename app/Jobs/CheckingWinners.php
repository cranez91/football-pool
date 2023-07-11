<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Services\RapidApi;
use App\Models\Matchday;
use App\Models\Game;
use App\Models\League;
use App\Models\Season;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CheckingWinners implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $currMatchday;
    private const PRIZE_PERCENT = 0.7;
    private const MEX_TIMEZONE = 'America/Mexico_City';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->validateCurrentMatchday();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Checking winners in background.');
        DB::beginTransaction();
        if ($this->currMatchday) {
            $this->checkResults();
            if ($this->closeMatchday()) {
                $this->currMatchday->active = 0;
                $this->setPrize();
                $this->currMatchday->update();

                if ($this->readyForWinners()) {
                    $this->setWinners();
                }
            }
        }
        DB::commit();
        Log::info('Checking winners finished.');
    }

    private function validateCurrentMatchday()
    {
        $curr = Matchday::current();
        $endDate = Carbon::parse($curr->end_date, self::MEX_TIMEZONE);
        $now = Carbon::now(self::MEX_TIMEZONE);
        if ($endDate->diffInHours($now) > 24) {
            $curr->current = 0;
            $curr->update();
            $this->setCurrentMatchday();
            return;
        }
        $this->currMatchday = $curr;
    }

    private function setCurrentMatchday()
    {
        $now = Carbon::now(self::MEX_TIMEZONE)->format('Y-m-d H:i');
        $curr = Matchday::whereRaw("
            '$now' BETWEEN DATE_SUB(start_date, INTERVAL 3 DAY) AND DATE_ADD(end_date, INTERVAL 1 DAY)
        ")->first();
        $curr->current = 1;
        $curr->update();
        $this->currMatchday = $curr;
    }

    private function closeMatchday() {
        $start = $this->currMatchday->start_date;
        $startDate = Carbon::parse($start, self::MEX_TIMEZONE);
        $now = Carbon::now(self::MEX_TIMEZONE);
        return $now->greaterThan($startDate) || $startDate->diffInHours($now) <= 4;
    }

    private function readyForWinners() {
        $end = $this->currMatchday->end_date;
        $endDate = Carbon::parse($end, self::MEX_TIMEZONE);
        $now = Carbon::now(self::MEX_TIMEZONE);
        return $now->greaterThan($endDate);
    }

    private function checkResults() {
        $this->updateScores();
        foreach ($this->currMatchday->matches as $match) {
            $game = $match->game;
            if ($game->status == 'FT' && !$match->result) {
                if ($game->home_score > $game->away_score) {
                    $match->result = 'L';
                } elseif ($game->home_score < $game->away_score) {
                    $match->result = 'V';
                } else {
                    $match->result = 'E';
                }
                $match->update();
                $this->checkGamersPredictions($match);
            }
        }
    }

    private function updateScores() {
        $leagueId = $this->currMatchday->league_id;
        $activeSeason = Season::where([ ['current', '=', 1], ['league_id', '=', $leagueId], ])->first();
        $games = RapidApi::getFixturesByRound($leagueId, $activeSeason->year, $this->currMatchday->name);
        foreach ($games as $game) {
            $this->currMatchday->games()
                ->where('id', $game['fixture']['id'])
                ->update([
                    'status' => $game['fixture']['status']['short'],
                    'home_score' => $game['goals']['home'],
                    'away_score' => $game['goals']['away']
                ]);
        }
    }

    private function checkGamersPredictions($match) {
        $this->currMatchday->userMatches()
            ->where('match_id', '=', $match->id)
            ->where('prediction', '=', $match->result)
            ->update(['success' => 'S']);

        $this->currMatchday->userMatches()
            ->where('match_id', '=', $match->id)
            ->where('prediction', '!=', $match->result)
            ->update(['success' => 'N']);
    }

    private function setPrize() {
        $price = $this->currMatchday->price;
        $gamers = $this->currMatchday->userMatchdays()->where('paid', 1)->count();
        $this->currMatchday->high_prize = $price * $gamers * self::PRIZE_PERCENT;
    }

    private function setWinners() {
        $top = 0;
        $winners = [];
        $gamers = $this->currMatchday->userMatchdays()->where('paid', 1)->get();
        foreach ($gamers as $gamer) {
            $predictions = $gamer->userMatches()->where('success', 'S')->count();
            if ($predictions >= $top) {
                $top = $predictions;
                
                $winners[$top][] = $gamer->id;
            }
        }
        $this->currMatchday->userMatchdays()
            ->whereIn('id', array_values( $winners[$top] ) )
            ->update(['winner' => 1]);
    }
}
