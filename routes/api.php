<?php

use Illuminate\Http\Request;

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

// Gets the vehicale info
Route::get('vehicles/getInfo/{vehicleId}', 'Apis\\VehiclesController@get')
    ->name('api.vehicles.vehicle.get_info')
    ->where('vehicleId', '[0-9]+');

// Gets the vehicale info
Route::get('customers/find/{term}', 'Apis\\CustomersController@find')
    ->name('api.customers.customer.find');

// Gets the vehicale info
Route::post('customers/store', 'Apis\\CustomersController@store')
    ->name('api.customers.customer.store');
