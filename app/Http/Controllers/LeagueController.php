<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Services\RapidApi;
use Illuminate\Support\Str;

class LeagueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leagues = League::orderBy('country_id', 'asc')->get();
        return view('catalogs.leagues.index', compact('leagues'));
    }
}
