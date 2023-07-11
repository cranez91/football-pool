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
use App\Models\Country;
use App\Models\League;
use App\Models\Season;
use App\Models\Broadcaster;
use App\Models\Team;
use Illuminate\Support\Str;

class FeedingCatalogs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private static $countries = [
        /*'FR' => ['active' => 0],
        'GB' => ['active' => 0],
        'DE' => ['active' => 0],
        'IT' => ['active' => 0],
        'ES' => ['active' => 0],*/
        'MX' => ['active' => 1]
    ];

    private $broadcasters;
    private $broadcasterTeams;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->broadcasterTeams = [
            'TUDN' => ['Club America', 'U.N.A.M. - Pumas', 'Toluca', 'Cruz Azul', 'Guadalajara Chivas'],
            'TV AZTECA' => ['Mazatlán', 'Puebla', 'Necaxa', 'Atlas', 'Club Tijuana'],
            'Fox Sports' => ['Leon', 'Pachuca', 'Monterrey', 'FC Juarez', 'Club Queretaro'],
            'ESPN' => ['Atletico San Luis'],
            'Afizzionados' => ['Tigres UANL'],
            'Vix+' => ['Santos Laguna'],
        ];
        $this->broadcasters = Broadcaster::get();
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
            $response = RapidApi::getCountryByCode($code);
            $response = array_shift($response);
            $country = Country::firstOrCreate( ['code' => $response['code']],
                [
                    'name' => $response['name'],
                    'flag' => $response['flag'],
                    'active' => $cty['active']
                ]
            );

            if ($cty['active']) {
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
                    $newSeason = Season::firstOrCreate( ['year' => $season['year']],
                        [
                            'start' => $season['start'],
                            'end' => $season['end'],
                            'league_id' => $league['league']['id'],
                            'current' => $season['current']
                        ]
                    );
                    if ($newSeason->current) $activeSeason = $newSeason;
                }

                $teams = RapidApi::getTeamsByLeague($league['league']['id'], $activeSeason->year);
                foreach ($teams as $team) {

                    $objBroadcaster = null;
                    foreach ($this->broadcasterTeams as $broadcaster => $teams) {
                        if (in_array($team['team']['name'], $teams)) {
                            $objBroadcaster = $this->broadcasters->where('name', $broadcaster)->first();
                            break;
                        }
                    }
                    $newTeam = Team::firstOrCreate( ['id' => $team['team']['id']],
                        [
                            'name' => $team['team']['name'],
                            'code' => $team['team']['code'],
                            'logo' => $team['team']['logo'],
                            'league_id' => $league['league']['id'],
                            'broadcaster_id' => $objBroadcaster->id,
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
        Log::info('Fetching catalogs finished.');
    }
}
