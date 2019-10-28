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


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/index/login','admin\LoginController@getIndex');
Route::post('/index/postLogin','admin\LoginController@postLogin');
Route::get('index/user/index','admin\UserController@getIndex');

Route::group(['prefix'=>'admin','namespace'=>'admin','middleware'=>'login'],function (){
    Route::get('/','AdminController@index');});
Route::get('index/out-login','admin\LoginController@getOutLogin');
Route::post('index/user/update','admin\UserController@update');
Route::resource('edit','admin\UserController');
Route::get('index/user/delete/{id}','admin\UserController@getDelete');