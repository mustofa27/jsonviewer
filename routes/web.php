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
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/ajax', 'HomeController@ajax')->name('ajax');
Route::get('/get', 'HomeController@getdata')->name('getdata');
Route::get('/dummydata', 'DataController@dataDummy')->name('dummydata');
Route::get('/tes', 'DataController@teskoneksi')->name('tes');
Route::get('/airlines/{kode}/{terminal}/{direction}', 'HomeController@getScheduleToday')->name('airlines');

