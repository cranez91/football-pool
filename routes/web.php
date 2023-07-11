<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\NationalTeamController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\MatchdayController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\RoundController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name('facebook.login');
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

Auth::routes();

Route::get('/comenzar', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/reglamento', [App\Http\Controllers\HomeController::class, 'rules'])->name('reglamento');
Route::get('/jugar', [App\Http\Controllers\HomeController::class, 'play'])->name('jugar');
Route::get('/jugar/{slug}/jornadas', [App\Http\Controllers\HomeController::class, 'leagueRounds'])->name('jornadas.liga');
Route::get('/jornada/{id}/quiniela', [App\Http\Controllers\HomeController::class, 'roundQuiniela'])->name('quiniela.jornada');
Route::get('/quiniela/{slug}/participantes', [App\Http\Controllers\HomeController::class, 'gamers'])->name('quiniela.participantes');

Route::post('/predictions/{slug}', [App\Http\Controllers\UserMatchdayController::class, 'store'])->name('predictions');

Route::resource('countries', CountryController::class);
Route::resource('leagues', LeagueController::class);
Route::resource('seasons', SeasonController::class);
Route::resource('rounds', RoundController::class);
Route::resource('national_teams', NationalTeamController::class);
Route::resource('teams', TeamController::class);
Route::resource('tournaments', TournamentController::class);
Route::resource('matchdays', MatchdayController::class);
Route::resource('user_matchdays', UserMatchdayController::class);

Route::get('/matchday/{slug}/gamers', [App\Http\Controllers\MatchdayController::class, 'gamers'])->name('matchday.gamers');