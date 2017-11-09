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

        //用户添加角色页面
        Route::get('/users/{user}/role', '\App\admin\Controllers\AdminUserController@role')->name('user.role_page');
        //用户添加角色动作
        Route::post('/users/role/store', '\App\admin\Controllers\AdminUserController@storeRole')->name('user.role');

        //角色列表页面
        Route::get('/roles', '\App\admin\Controllers\RoleController@index')->name('role.index');
        //角色添加页面

        Route::get('/roles/create', '\App\admin\Controllers\RoleController@create')->name('role.create');

        //角色添加动作
        Route::post('/roles/store', '\App\admin\Controllers\RoleController@store')->name('role.store');
        //角色权限列表
        Route::get('/roles/{role}/permission', '\App\admin\Controllers\PermissionController@index')->name('per.index');

        //修改权限提交
        Route::post('/roles/index', '\App\admin\Controllers\PermissionController@store')->name('per.store');
        //权限添加页面
        Route::get('/roles/create', '\App\admin\Controllers\PermissionController@create')->name('per.create');
        //权限添加动作
        Route::get('/roles/store', '\App\admin\Controllers\PermissionController@create')->name('per.store');

    });


});