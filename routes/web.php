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
Route::get('posts/{post}/delete', 'PostController@delete')->name('posts.delete');

//提交评论
Route::post('posts/comment', 'PostController@comment');
//点赞
Route::get('posts/{post}/zan', 'PostController@zan')->name('zan');
Route::get('posts/{post}/unzan', 'PostController@unZan')->name('unzan');
//个人首页
Route::get('user/{user}', 'UserController@index')->name('user.index');
//关注
Route::get('user/{user}/star', 'UserController@star')->name('user.star');
