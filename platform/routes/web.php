<?php

use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
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
Route::post('/home', 'RatingController@create');

Route::get('/crypto-filter', 'CryptoController@CryptoFilter');
Route::post('/crypto-filter', 'RatingController@create');

route::get('crypto-search', 'CryptoController@CryptoSearch');

Route::get('cryptos/create', 'ClassificationController@load')->middleware('role:author,admin');
Route::post('cryptos/create', 'CryptoController@store')->middleware('role:author,admin');

route::get('cryptos/own', 'CryptoController@UserCrypto' );
Route::get('cryptos/other/{user}', 'Cryptocontroller@otherCrypto');
Route::get('cryptos/review', 'CryptoController@review')->middleware('role:admin');
Route::patch('cryptos/review', 'CryptoController@visibility')->middleware('role:admin');
Route::get('cryptos/{crypto}', 'CryptoController@show');
Route::get('cryptos/{crypto}/edit', 'CryptoController@edit');
Route::patch('cryptos/{crypto}/', 'CryptoController@update');
Route::get('cryptos/{crypto}/delete', 'CryptoController@delete');


route::get('users/all', 'UserController@index')->middleware('role:admin');
route::get('users/{user}/edit', 'UserController@edit')->middleware('role:admin');
route::patch('users/{user}/', 'UserController@update')->middleware('role:admin');


Route::get('classifications/create', 'ClassificationController@create')->middleware('role:admin');
Route::post('classifications/create', 'ClassificationController@store')->middleware('role:admin');

});
