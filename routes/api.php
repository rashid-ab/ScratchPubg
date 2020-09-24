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

Route::get('get_categories','ApiController@get_categories');
Route::post('get_seasons','ApiController@get_seasons');

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});
