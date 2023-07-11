<?php

namespace App\Http\Controllers;

use App\Models\UserMatch;
use App\Http\Requests\StoreUserMatchRequest;
use App\Http\Requests\UpdateUserMatchRequest;

class UserMatchController extends Controller
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
     * @param  \App\Http\Requests\StoreUserMatchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserMatchRequest $request)
    {
        UserMatch::create($request->all());
        return response()->json(null, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserMatch  $userMatch
     * @return \Illuminate\Http\Response
     */
    public function show(UserMatch $userMatch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserMatch  $userMatch
     * @return \Illuminate\Http\Response
     */
    public function edit(UserMatch $userMatch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserMatchRequest  $request
     * @param  \App\Models\UserMatch  $userMatch
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserMatchRequest $request, UserMatch $userMatch)
    {
        foreach (array_keys( $request->all() ) as $property) {
            $userMatch->{$property} = $request->input( $property );
        }
        $userMatch->update();
        return response()->json(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserMatch  $userMatch
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserMatch $userMatch)
    {
        $userMatch->delete();
        return response()->json(null, 200);
    }
}
