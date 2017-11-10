<?php

use \Illuminate\Support\Facades\Route;

/*
 * 路由前缀admin
 * */
Route::prefix('admin')->group(function () {
    //登录页
    Route::get('/login', function () {
        return view('admin.login.login');
    })->name('admin.login.page');

    //验证登录信息
    Route::post('/login', '\App\admin\Controllers\LoginController@login')->name('admin.login');

    /*
     * 未登录不准访问路由
     * */
    Route::middleware(['auth:admin'])->group(function () {

        //登出
        Route::get('/logout', '\App\admin\Controllers\LoginController@Logout')->name('admin.logout');
        //首页路由
        Route::get('/index', '\App\admin\Controllers\HomeController@index')->name('admin.index');

        Route::middleware(['can:admin'])->group(function () {
            //用户管理页
            Route::get('/users', '\App\admin\Controllers\AdminUserController@index')->name('admin.user');
            //增加用户页
            Route::get('/users/add', function () {
                return view('admin.user.add');
            })->name('admin.user.add');
            //增加用户
            Route::post('/users/store', '\App\admin\Controllers\AdminUserController@store')->name('admin.user.store');
            //用户添加角色页面
            Route::get('/users/{user}/role', '\App\admin\Controllers\AdminUserController@roleList')->name('user.role.page');
            //用户添加角色动作
            Route::post('/users/{user}/role/store', '\App\admin\Controllers\AdminUserController@storeRoleStore')->name('user.role.store');

            //角色列表页面
            Route::get('/roles', '\App\admin\Controllers\RoleController@index')->name('role.index');
            //角色添加页面
            Route::get('/roles/create', '\App\admin\Controllers\RoleController@create')->name('role.create');
            //角色添加动作
            Route::post('/roles/store', '\App\admin\Controllers\RoleController@store')->name('role.store');
            //角色权限列表页面
            Route::get('/roles/{role}/permissions', '\App\admin\Controllers\RoleController@perList')->name('role.per.page');
            //保存角色权限列表
            Route::post('/roles/{role}/permissions/store', '\App\admin\Controllers\RoleController@perListStore')->name('role.per.store');

            //权限列表
            Route::get('/permissions', '\App\admin\Controllers\PermissionController@index')->name('per.index');
            //权限添加页面
            Route::get('/permissions/create', '\App\admin\Controllers\PermissionController@create')->name('per.create');
            //权限添加动作
            Route::post('/permissions/store', '\App\admin\Controllers\PermissionController@store')->name('per.store');
        });


        Route::middleware(['can:post'])->group(function () {
            //文章管理页
            Route::get('/posts', '\App\admin\Controllers\PostController@index')->name('admin.posts');
            //审核文章
            Route::post('/posts/{post}/status', '\App\admin\Controllers\PostController@status');

        });


    });


});