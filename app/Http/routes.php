<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/master', function () {
    return view('master');
});

Route::get('/hibah', 'HibahController@index');

Route::get('/borang', 'BorangController@index');

Route::get('/laporan', 'LaporanController@index');

Route::get('/laporankemajuan', 'LaporanController@laporankemajuan');

Route::get('/uploadkemajuan', 'LaporanController@uploadkemajuan');

Route::get('/uploadlaporanberhibah', 'LaporanController@uploadlaporanberhibah');

Route::get('/uploadlaporantdkberhibah', 'LaporanController@uploadlaporantdkberhibah');