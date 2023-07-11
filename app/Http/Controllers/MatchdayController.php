<?php

namespace App\Http\Controllers;

use App\Models\Matchday;
use App\Models\Tournament;
use App\Http\Requests\StoreMatchdayRequest;
use App\Http\Requests\UpdateMatchdayRequest;
use App\Services\RapidApi;
use Illuminate\Support\Str;

class MatchdayController extends Controller
{
    private static $leagueIds = ['mx' => 262];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matchdays = Matchday::with(['league', 'userMatchdays'])->orderBy('matchdays.start_date', 'asc')->get();
        return view('catalogs.matchdays.index', compact('matchdays'));
    }

    public function gamers(string $slug)
    {
        $matchday = Matchday::with([
            'league',
            'userMatchdays',
            'userMatchdays.user',
            'userMatchdays.userMatches' => function ($query) {
                $query->orderBy('match_id', 'asc');
            }
        ])
        ->where('slug', $slug)
        ->first();
        return view('catalogs.matchdays.gamers', compact('matchday'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMatchdayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMatchdayRequest $request)
    {
        Matchday::create($request->all());
        return response()->json(null, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Matchday  $matchday
     * @return \Illuminate\Http\Response
     */
    public function show(Matchday $matchday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Matchday  $matchday
     * @return \Illuminate\Http\Response
     */
    public function edit(Matchday $matchday)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMatchdayRequest  $request
     * @param  \App\Models\Matchday  $matchday
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMatchdayRequest $request, Matchday $matchday)
    {
        foreach (array_keys( $request->safe()->except(['_method']) ) as $property) {
            $matchday->{$property} = $request->input( $property );
        }
        $matchday->update();
        return back()->with('status', '¡La quiniela ha sido actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Matchday  $matchday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matchday $matchday)
    {
        $matchday->delete();
        return response()->json(null, 200);
    }
}
