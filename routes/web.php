<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubMatchController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\MatchController;

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

// index
Route::get('/', [ClubMatchController::class, 'index']);

// Clubs
Route::controller(ClubController::class)->group(function () {
    Route::get('/clubs/data', 'getData');
    Route::get('/clubs', 'index');
    Route::post('/clubs/store', 'store');
});

// Matchs
Route::controller(MatchController::class)->group(function () {
    Route::get('/matchs', 'index');
});

// MatchClub
Route::controller(ClubMatchController::class)->group(function () {
    Route::post('/matchs/store', 'store');
});


