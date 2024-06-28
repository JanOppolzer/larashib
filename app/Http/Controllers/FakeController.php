<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FakeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if (app()->environment(['local', 'testing'])) {
            $user = User::findOrFail($request->id);

            Auth::login($user);
            Session::regenerate();

            return redirect()->intended('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(): RedirectResponse
    {
        if (app()->environment(['local', 'testing'])) {
            Auth::logout();
            Session::flush();

            return redirect('/');
        }
    }
}
