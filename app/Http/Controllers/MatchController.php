<?php

namespace App\Http\Controllers;

use App\Models\Match;
use App\Http\Requests\StoreMatchRequest;
use App\Http\Requests\UpdateMatchRequest;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreMatchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMatchRequest $request)
    {
        Match::create($request->all());
        return response()->json(null, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function show(Match $match)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function edit(Match $match)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMatchRequest  $request
     * @param  \App\Models\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMatchRequest $request, Match $match)
    {
        foreach (array_keys( $request->all() ) as $property) {
            $match->{$property} = $request->input( $property );
        }
        $match->update();
        return response()->json(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function destroy(Match $match)
    {
        $match->delete();
        return response()->json(null, 200);
    }
}
