<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginForm;
use App\Http\Requests\Auth\RegisterForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function me()
    {
        $user = Auth::guard('user')->user();

        return response()->json([
            'message' => 'User profile',
            'status' => 'success',
            'data' => $user,
        ]);
    }

    public function logout()
    {
        Auth::guard('user')->logout();

        return redirect()->route('user.login');
    }

    public function showLoginForm()
    {
        return view('pages.user.auth.login');
    }

    public function showRegisterForm()
    {
        return view('pages.user.auth.register');
    }
}
