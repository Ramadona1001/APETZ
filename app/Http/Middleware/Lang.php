<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Cookie;

class Lang
{

    public function handle($request, Closure $next)
    {

        if(Cookie::has('webLanG')){
            App::setLocale(Cookie::get('webLanG'));
        }else{
            App::setLocale('en');
        }

        return $next($request);
    }
}
