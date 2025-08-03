<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginForm;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    private Admin $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function login(LoginForm $request)
    {
        try {
            $credentials = $request->validated();
            $key = 'admin_login_' . $request->ip();

            // Check rate limiting
            if (RateLimiter::tooManyAttempts($key, 5)) {
                $seconds = RateLimiter::availableIn($key);
                return redirect()->back()->with('error', "Terlalu banyak percobaan login. Silakan coba lagi dalam {$seconds} detik.")
                           ->withInput($request->only('email'));
            }

            if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
                RateLimiter::clear($key);
                $request->session()->regenerate();
                
                Log::info('Admin logged in successfully', [
                    'admin_id' => Auth::guard('admin')->id(),
                    'email' => $credentials['email'],
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ]);

                return redirect()->intended(route('admin.dashboard'))
                              ->with('success', 'Selamat datang di Admin Panel!');
            }

            RateLimiter::hit($key, 300); // 5 minutes decay
            
            Log::warning('Failed admin login attempt', [
                'email' => $credentials['email'],
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            return redirect()->back()->with('error', 'Email atau password yang Anda masukkan salah.')
                         ->withInput($request->only('email'));

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())
                         ->withInput($request->only('email'));
        } catch (\Exception $e) {
            Log::error('Admin login error', [
                'error' => $e->getMessage(),
                'email' => $request->input('email'),
                'ip' => $request->ip()
            ]);
            
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.')
                         ->withInput($request->only('email'));
        }
    }

    public function showLoginForm()
    {
        return view('pages.admin.auth.login');
    }

    public function logout(Request $request)
    {
        try {
            $adminId = Auth::guard('admin')->id();
            
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            Log::info('Admin logged out successfully', [
                'admin_id' => $adminId,
                'ip' => $request->ip()
            ]);

            return redirect()->route('admin.login')
                           ->with('success', 'Anda telah berhasil logout.');
            
        } catch (\Exception $e) {
            Log::error('Admin logout error', [
                'error' => $e->getMessage(),
                'admin_id' => Auth::guard('admin')->id()
            ]);
            
            return redirect()->route('admin.login')
                           ->with('error', 'Terjadi kesalahan saat logout.');
        }
    }
}
