<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App; 

use Illuminate\Support\Facades\Log;

class LanguageController extends Controller
{
    public function switchLanguage(Request $request)
    {
        $lang = $request->input('language');
        Log::info('Language requested to switch: ' . $lang);

        $availableLocales = config('app.available_locales', ['en', 'lv']);
        if (!in_array($lang, $availableLocales)) {
            $lang = config('app.fallback_locale', 'en');
        }

        Session::put('locale', $lang);
        Log::info('Session locale set to: ' . Session::get('locale'));

        App::setLocale($lang);

        return redirect()->back();
    }
}
