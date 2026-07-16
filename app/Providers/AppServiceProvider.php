<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Config;
use Session;
use App\Models\DMThongTin;
use Illuminate\Support\Facades\View;

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
        ini_set('memory_limit', '512M');
        $locale = app()->getLocale();
        $arr_lang = Config::get('app.arr_language');
        view()->share('arr_lang', $arr_lang);
        Paginator::useBootstrap();
        View::composer(['Frontend.menu_vi', 'Frontend.menu_en'], function ($view) {
            $menu_tintuc = DMThongTin::where('locale', '=', app()->getLocale())
                ->where('thu_tu', '>', 0)
                ->orderBy('thu_tu', 'asc')
                ->get();

            $view->with('menu_tintuc', $menu_tintuc);
        });
    }
}
