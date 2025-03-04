<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class UserController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edituser(User $userinfo): View
    {

        return view('profile.edit', [
            'user' => $userinfo,
        ]);
    }
    /**
     * Update the user's profile information.
     */
    public function updateuser(ProfileUpdateRequest $request, $userinfo): RedirectResponse
    {
        $userinfo = User::findOrFail($userinfo);
        $userinfo->fill($request->validated());

        if ($userinfo->isDirty('email')) {
            $userinfo->email_verified_at = null;
        }

        $userinfo->save();

        return Redirect::route('user.edit', ['userinfo' => $userinfo])->with('status', 'profile-updated');
    }
    /**
     * Delete the user's account.
     */
    public function destroyuser(Request $request, $userinfo): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = User::findOrFail($userinfo);

        // Auth::logout();

        $user->delete();

        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        return Redirect::to('/dashboard');
    }
}
