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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/log', 'LogController@index')->name('log')->middleware('auth');
Route::get('/team/create', 'TeamController@create')->name('team.create');
Route::post('/team/store', 'TeamController@store')->name('team.store')->middleware('CheckTeam');
