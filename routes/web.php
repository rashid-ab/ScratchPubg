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
    Route::post('/send_pass_var', 'RegisterController@sendPasswordVar');
    
    Route::get('/manage_categories', 'DashboardController@manage_categories');
    Route::get('/block_category/{id}', 'DashboardController@block_category');
    Route::get('/unblock_category/{id}', 'DashboardController@un_block_category');
    Route::get('/new_category', 'DashboardController@new_category');
    Route::post('/new_category', 'DashboardController@add_category');
    Route::get('/edit_category/{id}', 'DashboardController@edit_category');
    Route::post('/update_category', 'DashboardController@update_category');
    Route::get('/delete_category/{id}', 'DashboardController@delete_category');

    Route::get('/manage_seasons', 'DashboardController@manage_seasons');
    Route::get('/block_season/{id}', 'DashboardController@block_season');
    Route::get('/unblock_season/{id}', 'DashboardController@un_block_season');
    Route::get('/new_season', 'DashboardController@new_season');
    Route::post('/new_season', 'DashboardController@add_season');
    Route::get('/edit_season/{id}', 'DashboardController@edit_season');
    Route::post('/update_season', 'DashboardController@update_season');
    Route::get('/delete_season/{id}', 'DashboardController@delete_season');

    // SEASON NO
    Route::get('/manage_season_no', 'DashboardController@manage_season_no');
    Route::get('/new_season_no', 'DashboardController@new_season_no');
    Route::post('/new_season_no', 'DashboardController@add_season_no');
    Route::get('/edit_season_no/{id}', 'DashboardController@edit_season_no');
    Route::post('/update_season_no', 'DashboardController@update_season_no');
    Route::get('/delete_season_no/{id}', 'DashboardController@delete_season_no');

    
    // FILMS
    Route::get('/manage_films', 'DashboardController@manage_films');
    Route::get('/new_film', 'DashboardController@new_film');
    Route::post('/add_film', 'DashboardController@add_film');
    Route::get('/edit_film/{id}', 'DashboardController@edit_film');
    Route::get('/delete_film/{id}', 'DashboardController@delete_film');
    Route::post('/update_film', 'DashboardController@update_film');

    //Season Episode

    Route::get('/season_episode', 'DashboardController@season_episode');
    Route::get('/new_season_episode', 'DashboardController@new_season_episode');
    Route::post('/add_season_episode', 'DashboardController@add_season_episode');
    Route::get('/delete_episode/{id}', 'DashboardController@delete_episdoe');
    Route::get('/edit_season_episode/{id}', 'DashboardController@edit_season_episode');
    Route::post('/update_season_episode', 'DashboardController@update_season_episode');
});