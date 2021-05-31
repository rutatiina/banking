<?php


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


Route::group(['middleware' => ['auth:api', 'tenant']], function() {

	Route::prefix('api/v1/banking')->group(function () {

		Route::resource('banks', 'Rutatiina\Banking\Http\Controllers\Api\V1\BankController', ['as' => 'api.v1.banking']);
		Route::resource('accounts', 'Rutatiina\Banking\Http\Controllers\Api\V1\AccountController', ['as' => 'api.v1.banking']);


	});

});

