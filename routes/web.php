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

Route::get('search', 'ItemController@search');
Route::group(['prefix' => 'result'], function () {

    Route::get('line/{line}', 'ItemController@line');
    Route::get('plateNumber/{plateNumber}', 'ItemController@plateNumber');
    Route::get('like', 'ItemController@like')->name('result.like');
});
Route::resource('items', 'ItemController');
