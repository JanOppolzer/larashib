<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ShibbolethController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(): RedirectResponse|string
    {
        if (is_null(request()->server('Shib-Handler'))) {
            return 'login';
        }

        return redirect(
            request()
                ->server('Shib-Handler')
                .'/Login?target='
                .action('\\'.__CLASS__.'@store')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(): RedirectResponse|View
    {
        $mail = explode(';', request()->server('mail'));

        $user = User::updateOrCreate(
            ['uniqueid' => request()->server('uniqueId')],
            [
                'name' => request()->server('cn'),
                'email' => $mail[0],
                'emails' => count($mail) > 1 ? request()->server('mail') : null,
            ]
        );

        $user->refresh();

        if (! $user->active && $user->created_at->isToday()) {
            Log::channel('slack')->critical("A new account for {$user->name} is waiting for an approval!");

            return view('account_created');
        }

        if (! $user->active) {
            return view('inactive');
        }

        Auth::login($user);
        Session::regenerate();

        return redirect()->intended('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(): RedirectResponse
    {
        Auth::logout();
        Session::flush();

        return redirect('/Shibboleth.sso/Logout');
    }
}
