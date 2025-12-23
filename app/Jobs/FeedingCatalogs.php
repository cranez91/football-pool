<?php

namespace App\Jobs;

use App\Models\Country;
use App\Models\League;
use App\Models\Season;
use App\Models\Team;
use App\Services\RapidApi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class FeedingCatalogs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private static $countries = [
        /*'FR' => ['active' => 0],*/
        'GB' => ['active' => 1],
        'DE' => ['active' => 1],
        'IT' => ['active' => 1],
        'ES' => ['active' => 1],
        'MX' => ['active' => 1]
    ];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Fetching catalogs in background.');

        $activeSeason = null;

        foreach (self::$countries as $code => $cty) {
            $country = null;
            $response = RapidApi::getCountryByCode($code);
            $response = array_shift($response);

            if (!empty($response)) {
                $country = Country::firstOrCreate( ['code' => $response['code']],
                    [
                        'name' => $response['name'],
                        'flag' => $response['flag'],
                        'active' => $cty['active']
                    ]
                );
            }

            if ($country && $cty['active']) {
                $leagues = RapidApi::getLeaguesByCountry($response['code']);
                $league = array_shift($leagues);
                $newLeague = League::firstOrCreate( ['slug' => Str::slug($league['league']['name'], '-')],
                    [
                        'name' => $league['league']['name'],
                        'id' => $league['league']['id'],
                        'country_id' => $country->id,
                        'logo' => $league['league']['logo']
                    ]
                );

                foreach ($league['seasons'] as $season) {
                    $newSeason = Season::firstOrCreate( ['year' => $season['year'], 'league_id' => $league['league']['id'] ],
                        [
                            'start' => $season['start'],
                            'end' => $season['end'],
                            'current' => $season['current']
                        ]
                    );

                    if ($newSeason->current) {
                        $activeSeason = $newSeason;
                    }
                }

                $teams = RapidApi::getTeamsByLeague($league['league']['id'], $activeSeason->year);
                foreach ($teams as $team) {

                    $newTeam = Team::firstOrCreate( ['id' => $team['team']['id']],
                        [
                            'name' => $team['team']['name'],
                            'nickname' => '',
                            'code' => $team['team']['code'],
                            'logo' => $team['team']['logo'],
                            'league_id' => $league['league']['id'],
                            'broadcaster_id' => null,
                            'active' => 1,
                            'city' => $team['venue']['city'],
                            'stadium' => $team['venue']['name'],
                            'stadium_address' => $team['venue']['address'],
                            'stadium_image' => $team['venue']['image'],
                            'stadium_capacity' => $team['venue']['capacity'],
                        ]
                    );
                }
            }
        }
        Log::info('Fetching catalogs process finished.');
    }
}
