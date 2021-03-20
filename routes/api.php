<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('category','CategoryController@index');
Route::get('category/{id}','CategoryController@getData');
Route::post('create/category','CategoryController@store');
Route::post('delete/category/{id}','CategoryController@destroy');
Route::post('edit/category/{id}','CategoryController@update');
Route::post('create/blog','BlogController@store');
Route::get('blog','BlogController@index');
Route::post('edit/blog/{id}','BlogController@update');
Route::post('delete/blog/{id}','BlogController@destroy');
Route::get('blog/{id}','BlogController@getData');