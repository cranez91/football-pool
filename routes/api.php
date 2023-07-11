<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('countries', 'App\Http\Controllers\CountryController');
Route::apiResource('teams', 'App\Http\Controllers\TeamController');
Route::apiResource('national_teams', 'App\Http\Controllers\NationalTeamController');
Route::apiResource('tournaments', 'App\Http\Controllers\TournamentController');
Route::apiResource('matchdays', 'App\Http\Controllers\MatchdayController');
Route::apiResource('matches', 'App\Http\Controllers\MatchController');
Route::apiResource('user_matchdays', 'App\Http\Controllers\UserMatchdayController');
Route::apiResource('user_matches', 'App\Http\Controllers\UserMatchController');