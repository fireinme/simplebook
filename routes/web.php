<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!ss
|
*/
//注册
Route::get('register', function () {
    return view('register.index');
});
//注册用户
Route::post('register', 'RegisterController@register')->name('register');
//登录页面
Route::get('login', function () {
    return view('login.index');
});
//登录
Route::post('login', 'LoginController@login')->name('login');
//登出
Route::get('logout', 'LoginController@logout')->name('logout');
//个人设置页面
Route::get('user/me/setting', function () {
    return view('user.setting');
});
//个人设置活动
Route::post('user/{user}', 'UserController@settingStore');

Route::resource('posts', 'PostController');
Route::post('posts/image/upload', 'PostController@imageUpload');
Route::get('posts/{post}/delete', 'PostController@delete')->name('posts.delete');