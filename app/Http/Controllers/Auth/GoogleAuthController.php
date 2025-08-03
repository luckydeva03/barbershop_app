<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if user already exists with this Google ID
            $user = User::where('google_id', $googleUser->getId())->first();
            
            if ($user) {
                // Update user avatar if it's different
                if ($user->avatar !== $googleUser->getAvatar()) {
                    $user->update(['avatar' => $googleUser->getAvatar()]);
                }
                
                Auth::guard('user')->login($user);
                return redirect()->route('user.dashboard')->with('success', 'Welcome back!');
            }
            
            // Check if user exists with same email
            $existingUser = User::where('email', $googleUser->getEmail())->first();
            
            if ($existingUser) {
                // Link Google account to existing user
                $existingUser->update([
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'provider' => 'google'
                ]);
                
                Auth::guard('user')->login($existingUser);
                return redirect()->route('user.dashboard')->with('success', 'Google account linked successfully!');
            }
            
            // Create new user
            $newUser = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'provider' => 'google',
                'password' => Hash::make(Str::random(16)), // Random password for Google users
                'points' => 0,
                'email_verified_at' => now(),
            ]);
            
            Auth::guard('user')->login($newUser);
            return redirect()->route('user.dashboard')->with('success', 'Account created successfully with Google!');
            
        } catch (\Exception $e) {
            return redirect()->route('user.login')->with('error', 'Google authentication failed. Please try again.');
        }
    }
}
