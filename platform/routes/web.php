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
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {

Route::get('/home', 'CryptoController@index');
Route::get('cryptos/create', 'CryptoController@create');
Route::get('cryptos/create', 'Classificationcontroller@load');
Route::post('cryptos/create', 'CryptoController@store');
Route::get('cryptos/{crypto}', 'CryptoController@show');
Route::get('cryptos/{crypto}/edit', 'CryptoController@edit');
Route::patch('crypto/{cryptos}/', 'CryptoController@update');

Route::get('classifications/create', 'ClassificationController@create');
Route::post('classifications/create', 'ClassificationController@store');
});
