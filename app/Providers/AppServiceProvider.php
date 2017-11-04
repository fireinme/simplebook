<?php

namespace App\Providers;

use App\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        //视图绑定
        View::composer('layouts._side', function ($view) {
            $topics = Topic::all();
            $view->with('topics', $topics);
        });
        View::composer('admin.layouts._head', function ($view) {
            $user = Auth::guard('admin')->user();
            $view->with('user', $user);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
