<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Log;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sessionLocale = Session::get('locale');
        Log::info('Session locale: ' . ($sessionLocale ?? 'null'));

        if ($sessionLocale) {
            App::setLocale($sessionLocale);
        } else {
            $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
            if (!in_array($locale, ['en', 'lv'])) {
                $locale = 'en';
            }
            App::setLocale($locale);
        }

        Log::info('Locale after setting: ' . App::getLocale());

        return $next($request);
    }
}
