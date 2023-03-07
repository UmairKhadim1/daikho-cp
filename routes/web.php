<?php

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes([
    'register' => false, // Register Routes...
]);
Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', 'UserController@dashboard')->name('dashboard');
    Route::get('/allmovies','MovieController@index')->name('allmovies');
    Route::get('/allseries','SeriesController@index')->name('allseries');
    Route::get('/season/{series_id}/{season_id}/{key}','SeriesController@getSeason')->name('season');
    Route::any('updateFree/{id}', 'MovieController@update');
    Route::any('updateTime/{id}/{time}', 'MovieController@updateTime');

});
Route::get('/home', 'HomeController@index')->name('home');
