<?php

namespace App\Http\Controllers;

use App\Models\Distribuitor;
use App\Models\User;
use App\Http\Requests\StoreDistribuitorRequest;
use App\Http\Requests\UpdateDistribuitorRequest;
use Illuminate\Support\Facades\Hash;

class DistribuitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distribuitors = Distribuitor::orderBy('name', 'asc')->get();
        return view('catalogs.distribuitors.index', compact('distribuitors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('catalogs.distribuitors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDistribuitorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistribuitorRequest $request)
    {
        
        $dist = $request->safe()->except(['password_confirmation', 'password', 'email', 'whatsapp']);
        $dist['commission_pct'] = 10;
        $dist['active'] = 1;	
        $usr = $request->safe()->except(['address', 'city', 'state', 'password_confirmation']);
        $usr['password'] = Hash::make($usr['password']);
        $usr['type'] = 'D';
        Distribuitor::create($dist);
        User::create($usr);
        return redirect()->route('distribuitors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Distribuitor  $dist
     * @return \Illuminate\Http\Response
     */
    public function show(Distribuitor $dist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Distribuitor  $dist
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dist = Distribuitor::findOrFail($id);
        $usr = User::where('name', $dist->name)->firstOrFail();
        $dist->email = $usr->email;
        $dist->whatsapp = $usr->whatsapp;
        $dist->password = $dist->password_confirmation = '';
        return view('catalogs.distribuitors.edit', compact('dist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDistribuitorRequest  $request
     * @param  \App\Models\Distribuitor  $dist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDistribuitorRequest $request, $id)
    {
        $dist = Distribuitor::findOrFail($id);
        $usr = User::where('name', $dist->name)->firstOrFail();
        foreach (array_keys( $request->safe()->except(['password_confirmation', 'password', 'email', 'whatsapp']) ) as $property) {
            $dist->{$property} = $request->input( $property );
        }
        $dist->update();
        foreach (array_keys( $request->safe()->except(['address', 'city', 'state', 'password_confirmation', 'password']) ) as $property) {
            $usr->{$property} = $request->input( $property );
        }
        if ($request->filled('password')) {
            $usr->password = Hash::make($request->input('password'));
        }
        $usr->update();
        return response()->json(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Matchup  $dist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distribuitor $dist)
    {
        $dist->delete();
        return response()->json(null, 200);
    }
}
