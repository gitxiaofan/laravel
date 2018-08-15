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

Route::group(['middleware' => ['web']],function (){
    Route::any('login', ['uses' => 'LoginController@index']);
    Route::any('logout', ['uses' => 'LoginController@logout']);

});

Route::group(['middleware' => ['web','adminauth']], function (){
    Route::get('index', ['uses' => 'HomeController@index']);
    Route::get('show', ['uses' => 'HomeController@show']);
    Route::get('admin/index', ['uses' => 'AdminController@index']);
    Route::any('admin/create', ['uses' => 'AdminController@create']);
    Route::any('admin/update/{id}', ['uses' => 'AdminController@update']);
    Route::get('admin/check_name', ['uses' => 'AdminController@check_name']);
    Route::get('admin/delete/{id}', ['uses' => 'AdminController@delete']);
    Route::get('proone/index', ['uses' => 'ProoneController@index']);
    Route::any('proone/create', ['uses' => 'ProoneController@create']);
    Route::any('proone/update/{id}', ['as' => 'one_update', 'uses' => 'ProoneController@update']);
    Route::any('proone/delete/{id}', ['uses' => 'ProoneController@delete']);
    Route::get('proone/deleterecord/{id}', ['uses' => 'ProoneController@deleteRecord']);
});





