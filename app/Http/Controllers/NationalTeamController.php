<?php

namespace App\Http\Controllers;

use App\Models\NationalTeam;
use App\Http\Requests\StoreNationalTeamRequest;
use App\Http\Requests\UpdateNationalTeamRequest;

class NationalTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nations = NationalTeam::orderBy('name', 'asc')->get();
        return view('catalogs.national_teams.index', compact('nations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('catalogs.national_teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNationalTeamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNationalTeamRequest $request)
    {
        $team = NationalTeam::create($request->all());
        return response()->json($team, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NationalTeam  $nationalTeam
     * @return \Illuminate\Http\Response
     */
    public function show(NationalTeam $nationalTeam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NationalTeam  $nationalTeam
     * @return \Illuminate\Http\Response
     */
    public function edit(NationalTeam $nationalTeam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNationalTeamRequest  $request
     * @param  \App\Models\NationalTeam  $nationalTeam
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNationalTeamRequest $request, NationalTeam $nationalTeam)
    {
        foreach (array_keys( $request->all() ) as $property) {
            $nationalTeam->{$property} = $request->input( $property );
        }
        $nationalTeam->update();
        return response()->json(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NationalTeam  $nationalTeam
     * @return \Illuminate\Http\Response
     */
    public function destroy(NationalTeam $nationalTeam)
    {
        $nationalTeam->delete();
        return response()->json(null, 200);
    }
}
