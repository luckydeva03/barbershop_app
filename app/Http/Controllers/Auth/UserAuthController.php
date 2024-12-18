<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginForm;
use App\Http\Requests\Auth\RegisterForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UserAuthController extends Controller
{
    private  User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function register(RegisterForm $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('user.login')->with('success', 'User created successfully');
    }

    public function login(LoginForm $request)
    {
        $validated = $request->validated();

       if(Auth::guard('user')->attempt($validated)){
            return redirect()->route('user.dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Auth::guard('user')->logout();

        return redirect()->route('user.login');
    }
}
