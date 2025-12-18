<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\League;
use App\Models\Round;
use App\Models\Matchday;
use App\Models\Distribuitor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['rules', 'play', 'leagueRounds', 'gamers']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function rules()
    {
        return view('rules');
    }

    public function play()
    {
        $leagues = League::fromActiveCountry();
        return view('play.index', compact('leagues'));
    }

    /**
     * Listar las jornadas de la liga
     */
    public function leagueRounds(string $slug)
    {
        $rounds = Matchday::with(['games' => function ($query) {
            $query->orderBy('date', 'asc')->orderBy('time', 'asc');
        }, 'games.home.broadcaster', 'games.away', 'league'])
        ->whereHas('league', function(Builder $query) use ($slug) {
            return $query->where('slug', '=', $slug);
        })
        ->where('visible', 1)
        ->orderBy('id', 'desc')
        ->get();
        return view('play.rounds', compact('rounds'));
    }

    public function roundQuiniela(string $slug)
    {
        $userId = Auth::id();
        $round = Matchday::with(['games' => function ($query) {
            $query->orderBy('date', 'asc')->orderBy('time', 'asc');
            },'userMatchdays' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }, 'games.home.broadcaster', 'league', 'games.away', 'userMatchdays.userMatches', 'userMatchdays.matchday'])
            ->where('slug', $slug)
            ->first();
        $distribuitors = Distribuitor::all();
        return view('play.quiniela', compact('round', 'distribuitors'));
    }

    public function gamers(string $slug)
    {
        $matchday = Matchday::with([
            'league',
            'games',
            'games.home.broadcaster',
            'games.away',
            'userMatchdays',
            'userMatchdays.user',
            'userMatchdays.userMatches' => function ($query) {
                $query->orderBy('match_id', 'asc');
            }
        ])
        ->where('slug', $slug)
        ->first();
        return view('play.gamers', compact('matchday'));
    }
}
