<?php

namespace App\Providers;

use App\Channel;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('*', function($view) {
            $channels = Cache::rememberForever('channels', function() {
               return Channel::all();
            });
            $channels = Channel::all();
            $view->with('channels', $channels);
        });
        \Validator::extend('spamfree', 'App\Rules\SpamFree@passes');
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