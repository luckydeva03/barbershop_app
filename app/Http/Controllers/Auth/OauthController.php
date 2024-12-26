<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $existingUser = User::firstOrCreate(
            ['email' => $user->email],
            ['name' => $user->name]
        );

        auth('user')->login($existingUser);

        return redirect()->route('user.dashboard');
    }

}
