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

Route::post('get-schedule-ride', 'ApiController@getScheduleRide');

Route::post('store-ride', 'ApiController@storeRide');

Route::post('get-ride-by-id', 'ApiController@getRideById');

Route::post('get-return-ride-by-id', 'ApiController@getReturnRideById');

Route::post('addRideSeats', 'ApiController@addRideSeats');

Route::post('subtractRideSeats', 'ApiController@subtractRideSeats');
