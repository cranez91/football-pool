<?php

namespace App\Http\Controllers;

use App\Models\UserMatchday;
use App\Models\Distribuitor;
use App\Http\Requests\StoreUserMatchdayRequest;
use App\Http\Requests\UpdateUserMatchdayRequest;
use Illuminate\Http\Request;
use App\Services\Internal\MatchdayService;
use App\Services\Internal\UserMatchdayService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserMatchdayController extends Controller
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
     * @param  \App\Http\Requests\StoreUserMatchdayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(
        StoreUserMatchdayRequest $request,
        MatchdayService $service,
        UserMatchdayService $userMatchdayService
    ) {
        $requestData = $request->validated();
        $matchday = $service->getItemBySlug( $requestData['matchday_slug'] );
        $userMatch = $userMatchdayService->insert( array_merge(
            ['uuid' => Str::upper( Str::random(10) )],
            ['user_id' => Auth::id(), 'matchday_id' => $matchday->id], 
            $request->safe()->only(['paid', 'winner'])
        ) );
        $userMatchdayService->insertMatches($userMatch, $matchday->matches, $requestData['predictions']);
        return back()->with('status', '¡Quiniela guardada con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserMatchday  $userMatchday
     * @return \Illuminate\Http\Response
     */
    public function show(UserMatchday $userMatchday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserMatchday  $userMatchday
     * @return \Illuminate\Http\Response
     */
    public function edit(UserMatchday $userMatchday)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserMatchdayRequest  $request
     * @param  \App\Models\UserMatchday  $userMatchday
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserMatchdayRequest $request, UserMatchday $userMatchday)
    {
        foreach (array_keys( $request->safe()->except(['_method']) ) as $property) {
            $userMatchday->{$property} = $request->input( $property );
        }
        if ($request->has('distribuitor')) {
           $dist = Distribuitor::where('name', $request->input('distribuitor'))->first();
           if ($dist) {
               $userMatchday->distribuitor_id = $dist->id;
           }
        }
        $userMatchday->update();
        return back()->with('status', '¡La quiniela ha sido pagada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserMatchday  $userMatchday
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserMatchday $userMatchday)
    {
        $userMatchday->delete();
        return response()->json(null, 200);
    }
}
