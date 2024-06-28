<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserStatusController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        Gate::authorize('do-everything');

        if ($request->user()->is($user)) {
            return redirect()
                ->route('users.show', $user)
                ->with('status', __('users.cannot_toggle_your_status'))
                ->with('color', 'red');
        }

        $user->active = $user->active ? false : true;
        $user->update();

        $status = $user->active ? 'active' : 'inactive';
        $color = $user->active ? 'green' : 'red';

        return redirect()
            ->route('users.show', $user)
            ->with('status', __("users.$status", ['name' => $user->name]))
            ->with('color', $color);
    }
}
