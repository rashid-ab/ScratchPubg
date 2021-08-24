<?php

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
    //   return view('share');
    return view('index');
});
Route::get('/login', 'RegisterController@index');
Route::post('/submit_login', 'RegisterController@login');
Route::group(['middleware' => 'login'], function () {
    Route::get('/logout', 'RegisterController@get_logout');
    Route::get('/share_data/{id}', 'RegisterController@share_data');
    Route::get('/manage_user', 'DashboardController@manage_user');
    Route::get('/block_user/{id}', 'DashboardController@block_user');
    Route::get('/un_block_user/{id}', 'DashboardController@un_block_user');
    Route::get('/get_details/{id}', 'DashboardController@get_data');
    Route::get('/delete_user/{id}', 'DashboardController@delete_user');
    Route::post('email_send', 'RegisterController@email_send');
    Route::get('/change_password', 'RegisterController@changepassword');
    Route::get('/manage_notification', 'DashboardController@manage_notification');
    Route::post('/send_pass_var', 'RegisterController@sendPasswordVar');
    Route::post('/send_noti', 'DashboardController@send_noti');
    Route::post('/redeem', 'DashboardController@redeem');
});