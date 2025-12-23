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
use App\Models\League;
use App\Models\Round;
use App\Models\Matchday;
use App\Models\Matchup;
use App\Models\Season;
use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Support\Str;

class FeedingLeagueRounds implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $lstRounds = $lstMatchdays = [];
        Log::info('Fetching league rounds in background.');
        
        foreach (League::fromActiveCountry() as $league) {
            $activeSeason = $this->getCurrentSeason($league->id);
            $current = RapidApi::getRoundsByLeague($league->id, $activeSeason->year, true);
            $rounds = RapidApi::getRoundsByLeague($league->id, $activeSeason->year);
            Log::info('Fetching rounds:', ['current' => json_encode($current), 'data' => json_encode($rounds)]);
            
            $numRounds = sizeof($rounds);
            foreach ($rounds as $index => $round) {
                $rnd = $this->createRound($current, $round, $league->id);
                $lstRounds[$round] = $rnd;

                $mday = $this->createMatchday($current, $round, $league->id);
                $lstMatchdays[$round] = $mday;
            }

            $games = RapidApi::getFixturesByLeague($league->id, $activeSeason->year);
            foreach ($games as $game) {
                $gameRound = $lstRounds[$game['league']['round']];
                $objMatchday = $lstMatchdays[$game['league']['round']];
                if (!$game['fixture']['timestamp']) {
                    $timestamp = Carbon::now('America/Mexico_city');
                } else {
                    $timestamp = Carbon::createFromTimestamp($game['fixture']['timestamp'], 'America/Mexico_city');
                }
                //$timestamp->subHour(1); // this is because the modern mexico time

                $newGame = $this->createGame($gameRound->id, $game, $timestamp);

                $match = Matchup::firstOrCreate( ['game_id' => $game['fixture']['id'], 'matchday_id' => $objMatchday->id ],
                    [
                        'result' => ''
                    ]
                );

                if ($game['fixture']['status']['short'] === 'FT') {
                    if ($game['goals']['home'] > $game['goals']['away']) {
                        $match->result = 'L';
                    } elseif ($game['goals']['away'] > $game['goals']['home']) {
                        $match->result = 'V';
                    } else {
                        $match->result = 'E';
                    }
                    $match->update();
                }
            }
        }

        foreach ($lstMatchdays as $matchday) {
            $matches = $matchday->matches()->orderBy('created_at', 'asc')->get();
            if ($matches->count() > 0) {
                $firstGame = $matches->first()->game;
                $lastGame = $matches->last()->game;
                $matchday->number_matches = $matches->count();
                $matchday->start_date = $firstGame->date . ' ' . $firstGame->time;
                $matchday->end_date = $lastGame->date . ' ' . $lastGame->time;
                $matchday->update();
            }
        }
        
        Log::info('Fetching league rounds finished.');
    }

    private function getCurrentSeason($leagueId) {
        return Season::where([ ['current', '=', 1], ['league_id', '=', $leagueId] ])
            ->first();
    }

    private function createRound($current, $round, $leagueId) {
        $isCurrent = $current[0] == $round ? 1 : 0;
        $newRound = Round::firstOrCreate( ['name' => $round, 'league_id' => $leagueId],
            [
                'current' => 0,
            ]
        );
        $newRound->current = $isCurrent;
        $newRound->update();
        return $newRound;
    }

    private function createMatchday($current, $round, $leagueId) {
        $isCurrent = $current[0] == $round ? 1 : 0;
        $matchday = Matchday::firstOrCreate( ['name' => $round, 'league_id' => $leagueId],
            [
                'slug' => Str::slug($round, '-'),
                'current' => 0,
                'active' => 0,
                'price' => config('app.matchday_price'),
            ]
        );
        $matchday->current = $isCurrent;
        $matchday->update();
        return $matchday;
    }

    private function createGame ($gameRoundId, $game, $timestamp) {
        $newGame = Game::firstOrCreate( ['id' => $game['fixture']['id'], 'round_id' => $gameRoundId],
            [
                'home_id' => $game['teams']['home']['id'], 
                'away_id' => $game['teams']['away']['id'], 
                'home_score' => $game['goals']['home'], 
                'away_score' => $game['goals']['away'], 
                'referee' => $game['fixture']['referee'], 
                'date' => $timestamp->format('Y-m-d'),
                'time' => $timestamp->format('H:i'), 
                'status' => ''
            ]
        );
        Log::info('createGame:', [ 'game' => $game]);
        $newGame->home_score = $game['goals']['home'];
        $newGame->away_score = $game['goals']['away'];
        $newGame->status = $game['fixture']['status']['short'];
        $newGame->update();
        return $newGame;
    }
}
