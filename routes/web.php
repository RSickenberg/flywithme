<?php

use App\Http\Controllers\FlightsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', static function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(static function () {
    Route::get('/dashboard', static function () {
        return view('dashboard');
    })->name('dashboard');

    // -----------------------------------
    Route::controller(FlightsController::class)
        ->prefix('flight')
        ->middleware(['role:admin'])
        ->group(static function () {
            Route::get('/', 'index')->name('flight_index');
            Route::get('/create', 'create')->name('flight_create');
        });
});
