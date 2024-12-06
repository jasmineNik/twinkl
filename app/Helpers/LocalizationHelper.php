<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationHelper
{
    /**
     * @brief Setting the locale for the api request
     * @param Request $request
     * @return void
     */
    public static function setLocale(Request $request): void
    {
        $locale = app()->getLocale();
        if ($request->hasHeader('Accept-Language')) {
            $locale = $request->header("Accept-Language");
            if (str_contains($locale, '-')) {
                $locale = explode('-', $locale)[0];
            }
            session()->put('language', $locale);
        } elseif (session('locale')) {
            $locale = session('locale');
        }
        App::setLocale($locale);
    }
}
