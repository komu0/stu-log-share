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

// ユーザ登録
//return view('auth.register');している
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
//登録処理
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');


//メインページ
Route::get('/', 'StulogsController@index');

//アバウト
Route::get('about', 'AboutController@index')->name('about');
Route::resource('users', 'UsersController', ['only' => ['show']]);

Route::group(['middleware' => ['auth']], function () {;
    Route::resource('stulogs', 'StulogsController', ['only' => ['store', 'destroy']]);
    
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
    });
});

Route::group(['prefix' => 'users/{id}'], function () {
    Route::get('followings', 'UsersController@followings')->name('users.followings');
    Route::get('followers', 'UsersController@followers')->name('users.followers');
});
