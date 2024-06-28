<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $language): RedirectResponse
    {
        if (isset($language) && in_array($language, config('app.locales'))) {
            App::setLocale($language);
            Session::put('locale', $language);
        }

        return back();
    }
}
