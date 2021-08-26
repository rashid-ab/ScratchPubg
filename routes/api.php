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
Route::post('login','ApiController@login');
Route::post('signup','ApiController@signup');
Route::post('silver_coins','ApiController@silver_coins');
Route::post('golden_coins','ApiController@golden_coins');
Route::post('platinum_coins','ApiController@platinum_coins');
Route::post('getUser','ApiController@getUser');
Route::post('tokenupdate','ApiController@tokenupdate');
Route::post('change_password','ApiController@change_password');
Route::post('forget_password','ApiController@forget_password');
Route::post('send_mail','ApiController@send_mail');
Route::post('profile','ApiController@profile');