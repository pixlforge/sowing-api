<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class setAppLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->has('client_locale')) {
            App::setLocale($request->client_locale);
        }
        
        return $next($request);
    }
}
