<?php

use \Illuminate\Support\Facades\Route;

//路由前缀admin
Route::prefix('admin')->group(function () {
    //登录页
    Route::get('/login', function () {
        return view('admin.login.login');
    })->name('admin.login.page');

    //验证登录信息
    Route::post('/login', '\App\admin\Controllers\LoginController@login')->name('admin.login');

    //未登录不准访问路由
    Route::middleware(['auth:admin'])->group(function () {

        //登出
        Route::get('/logout', '\App\admin\Controllers\LoginController@Logout')->name('admin.logout');

        //首页路由
        Route::get('/index', '\App\admin\Controllers\HomeController@index')->name('admin.index');

        //用户管理页
        Route::get('/users', '\App\admin\Controllers\AdminUserController@index')->name('admin.user');

        //增加用户页
        Route::get('/users/add', function () {
            return view('admin.user.add');
        })->name('admin.user.add');

        //增加用户
        Route::post('/users/store', '\App\admin\Controllers\AdminUserController@store')->name('admin.user.store');

        //文章管理页
        Route::get('/posts', '\App\admin\Controllers\PostController@index')->name('admin.posts');

        //审核文章
        Route::post('/posts/{post}/status', '\App\admin\Controllers\PostController@status');
    });


});