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
    Route::get('index', ['as' => 'index','uses' => 'HomeController@index']);
    Route::get('show', ['as' => 'show', 'uses' => 'HomeController@show']);
    Route::get('role', ['as' => 'role', 'uses' => 'HomeController@role']);

});

Route::group(['middleware' => ['web','adminauth']], function (){
    Route::get('admin/index', ['as' => 'admin_index', 'uses' => 'AdminController@index']);
    Route::any('admin/create', ['as' => 'admin_create', 'uses' => 'AdminController@create']);
    Route::any('admin/update/{id}', ['as' => 'admin_update', 'uses' => 'AdminController@update']);
    Route::get('admin/check_name', ['as' => 'admin_check_name', 'uses' => 'AdminController@check_name']);
    Route::get('admin/delete/{id}', ['as' => 'admin_delete','uses' => 'AdminController@delete']);
    Route::get('proone/index', ['as' => 'proone_index', 'uses' => 'ProoneController@index']);
    Route::get('proone/toexcel', ['as' => 'proone_toexcel', 'uses' => 'ProoneController@toExcel']);
    Route::any('proone/create', ['as' => 'proone_create', 'uses' => 'ProoneController@create']);
    Route::any('proone/detail/{id}', ['as' => 'proone_detail', 'uses' => 'ProoneController@detail']);
    Route::any('proone/detailtoexcel/{id}', ['as' => 'proone_detailtoexcel', 'uses' => 'ProoneController@detailToExcel']);
    Route::any('proone/update/{id}', ['as' => 'proone_update', 'uses' => 'ProoneController@update']);
    Route::any('proone/delete/{id}', ['as' => 'proone_delete', 'uses' => 'ProoneController@delete']);
    Route::get('proone/deleterecord/{id}', ['as' => 'proone_deleterecord', 'uses' => 'ProoneController@deleteRecord']);
});





