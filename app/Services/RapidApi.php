<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class RapidApi {
    private $client;
    const HALF_DAY = 43200;
    const DAY = 86400;
    const FOUR_HOURS = 14400;

    public static function getTeamsByLeague(int $league, string $season = '2022') //
    {
        $key = __METHOD__ . "-$league-$season";
        $value = Cache::remember($key, self::DAY, function () use ($league, $season) {
            return self::makeRequest("teams?league=$league&season=$season");
        }); 

        $data = json_decode($value, true);
        return $data['response'];
    }

    public static function getRoundsByLeague(int $league, string $season = '2022', bool $current = false) //
    {
        $key = __METHOD__ . "-$league-$season-$current";
        $value = Cache::remember($key, self::DAY, function () use ($league, $season, $current) {
            $curr = $current ? "&current=true" : '';
            return self::makeRequest("fixtures/rounds?league=$league&season=$season" . $curr);
        }); 

        $data = json_decode($value, true);
        return $data['response'];
    }

    public static function getFixturesByLeague(int $league, string $season = '2022') //
    {
        $key = __METHOD__ . "-$league-$season";
        $value = Cache::remember($key, self::FOUR_HOURS, function () use ($league, $season) {
            return self::makeRequest("fixtures?league=$league&season=$season&timezone=America/Mexico_City");
        }); 

        $data = json_decode($value, true);
        return $data['response'];
    }

    public static function getFixturesByRound(int $league, string $season, string $round) //
    {
        $key = __METHOD__ . "-$league-$season-$round";
        $value = Cache::remember($key, self::FOUR_HOURS, function () use ($league, $season, $round) {
            return self::makeRequest("fixtures?league=$league&season=$season&round=$round&timezone=America/Mexico_City");
        }); 

        $data = json_decode($value, true);
        return $data['response'];
    }

    public static function getLeagueById(int $league) //
    {
        $key = __METHOD__ . "-$league";
        $value = Cache::remember($key, self::DAY, function () use ($league) {
            return self::makeRequest("leagues?id=$league");
        }); 

        $data = json_decode($value, true);
        return $data['response'];
    }

    public static function getCountryByCode(string $code) //
    {
        $key = __METHOD__ . "-$code";
        $value = Cache::remember($key, self::DAY, function () use ($code) {
            return self::makeRequest("countries?code=$code");
        }); 

        $data = json_decode($value, true);
        return $data['response'];
    }

    public static function getLeaguesByCountry(string $code) //
    {
        $key = __METHOD__ . "-$code";
        $value = Cache::remember($key, self::DAY, function () use ($code) {
            return self::makeRequest("leagues?code=$code");
        }); 

        $data = json_decode($value, true);
        return $data['response'];
    }

    private static function makeRequest(string $url)
    {
        $client = new \GuzzleHttp\Client();
        $key = config('services.rapid_api.key');
        $host = config('services.rapid_api.host');
        $url = "https://$host/v3/$url";

        $response = $client->request('GET', $url, [
            'headers' => [
                'X-RapidAPI-Host' => $host,
                'X-RapidAPI-Key' => $key,
            ],
        ]);

        return $response->getBody()->getContents();
    }
}