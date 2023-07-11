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
use App\Models\Match;
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
            $activeSeason = Season::where([
                ['current', '=', 1],
                ['league_id', '=', $league->id],
            ])
            ->first();
            $current = RapidApi::getRoundsByLeague($league->id, $activeSeason->year, true);
            $rounds = RapidApi::getRoundsByLeague($league->id, $activeSeason->year);
            $numRounds = sizeof($rounds);
            foreach ($rounds as $index => $round) {
                $lstRounds[$round] = Round::firstOrCreate( ['name' => $round],
                    [
                        'current' => $current[0] == $round ? 1 : 0,
                        'league_id' => $league->id,
                    ]
                );

                $lstMatchdays[$round] = Matchday::firstOrCreate( ['name' => $round],
                    [
                        'slug' => Str::slug($round, '-'),
                        'current' => $current[0] == $round ? 1 : 0,
                        'league_id' => $league->id,
                        'active' => 0,
                        'price' => config('app.matchday_price'),
                    ]
                );
            }

            $games = RapidApi::getFixturesByLeague($league->id, $activeSeason->year);
            foreach ($games as $game) {
                $gameRound = $lstRounds[$game['league']['round']];
                $objMatchday = $lstMatchdays[$game['league']['round']];
                $timestamp = Carbon::createFromTimestamp($game['fixture']['timestamp'], 'America/Mexico_city');

                $timestamp->subHour(1); // this is because the modern mexico time

                $newGame = Game::firstOrCreate( ['id' => $game['fixture']['id']],
                    [
                        'round_id' => $gameRound->id,
                        'home_id' => $game['teams']['home']['id'], 
                        'away_id' => $game['teams']['away']['id'], 
                        'home_score' => $game['goals']['home'], 
                        'away_score' => $game['goals']['away'], 
                        'referee' => $game['fixture']['referee'], 
                        'date' => $timestamp->format('Y-m-d'),
                        'time' => $timestamp->format('H:i'), 
                        'status' => $game['fixture']['status']['short']
                    ]
                );

                $match = Match::firstOrCreate( ['game_id' => $game['fixture']['id'] ],
                    [
                        'matchday_id' => $objMatchday->id
                    ]
                );
            }
        }

        foreach ($lstMatchdays as $matchday) {
            $matches = $matchday->matches()->orderBy('created_at', 'asc')->get();
            $firstGame = $matches->first()->game;
            $lastGame = $matches->last()->game;
            $matchday->number_matches = $matches->count();
            $matchday->start_date = $firstGame->date . ' ' . $firstGame->time;
            $matchday->end_date = $lastGame->date . ' ' . $lastGame->time;
            $matchday->update();
        }
        
        Log::info('Fetching league rounds finished.');
    }
}
