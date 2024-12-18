<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginForm;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    private Admin $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function login(LoginForm $request)
    {
        $credentials = $request->validated();

        if (auth('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function showLoginForm()
    {
        return view('pages.admin.auth.login');
    }

    public  function logout()
    {
        auth('admin')->logout();
        return redirect()->route('admin.login');
    }
}
