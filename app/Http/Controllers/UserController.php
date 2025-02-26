<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class UserController extends Controller
{
    public function edituser(User $userinfo): View
    {

        return view('profile.edit', [
            'user' => $userinfo,
        ]);
    }

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
}
