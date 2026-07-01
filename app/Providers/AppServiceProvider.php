<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Config;use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $locale = app()->getLocale();
        $arr_lang = Config::get('app.arr_language');
        view()->share('arr_lang', $arr_lang);
        Paginator::useBootstrap();
    }
}
