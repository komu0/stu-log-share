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

Route::get('/', 'StuLogsController@index');

// ユーザ登録
//return view('auth.register');している
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
//登録処理
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

