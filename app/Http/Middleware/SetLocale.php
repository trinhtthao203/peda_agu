<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Session;
use App;
use Config;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->segment(1);

        if (in_array($locale, Config::get('app.arr_locale'))) {
            app()->setLocale($locale);

            URL::defaults(['locale' => $locale]);

            return $next($request);
        } else {
            echo 'NO LANGUAGE';
            exit();
        }
    }
}
