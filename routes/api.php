<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AirPortsController;
use \App\Http\Controllers\PortsController;

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

Route::get('/airports', [AirPortsController::class, 'index'])->name('airports');

Route::get('/specific_airports/{id?}', [AirPortsController::class, 'getAirPortSpecific'])->name('specific_airports');

Route::get('/ports', [PortsController::class, 'index'])->name('ports');

Route::get('/specific_ports/{id?}', [PortsController::class, 'getPortSpecific'])->name('specific_ports');
