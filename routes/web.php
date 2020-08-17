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
Route::get('/', 'StulogsController@index')->name('home');

//アバウト
Route::get('about', 'AboutController@index')->name('about');
Route::resource('users', 'UsersController', ['only' => ['show']]);

Route::group(['middleware' => ['auth']], function () {;
    Route::resource('stulogs', 'StulogsController', ['only' => ['create', 'edit', 'store', 'update', 'destroy']]);
    Route::resource('categories', 'CategoriesController', ['only' => ['store']]);
    Route::post('tags/store/on/{id}', 'TagsController@store')->name('tags.store');
    Route::put('setting/update/categories-order', 'CategoriesController@updateOrder')->name('update.category.order');
    Route::put('setting/update/tags-order', 'TagsController@updateOrder')->name('update.tag.order');
    Route::get('timeline', 'TimelineController@index')->name('timeline');
    Route::get('setting', 'SettingController@index')->name('setting');
    Route::get('setting/tags', 'SettingController@tags')->name('setting.tags');
    Route::get('setting/mutings', 'UsersController@mutings')->name('user.mutings');
    Route::put('profile/update', 'UsersController@profileUpdate')->name('profile.update');
    Route::put('password/update', 'UsersController@passwordUpdate')->name('password.update');
    
    Route::group(['prefix' => 'categories/{id}'], function () {
        Route::put('update/name', 'CategoriesController@updateName')->name('update.category.name');
        Route::delete('destroy', 'CategoriesController@destroy')->name('category.destroy');
    });
    
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::post('mute', 'UserMuteController@store')->name('user.mute');
        Route::delete('unmute', 'UserMuteController@destroy')->name('user.unmute');
    });
});

Route::group(['prefix' => 'users/{id}'], function () {
    Route::get('followings', 'UsersController@followings')->name('users.followings');
    Route::get('followers', 'UsersController@followers')->name('users.followers');
    Route::get('analyze', 'AnalyzeController@index')->name('analyze');
});