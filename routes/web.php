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

Route::get('create', 'DisplayDataController@create');
Route::get('index', 'DisplayDataController@index');

// Display view
Route::get('datatable', 'DisplayDataController@datatable');
// Get Data
Route::get('datatable/getdata', 'DisplayDataController@getPosts')->name('datatable/getdata');