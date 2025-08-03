<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah admin sudah login
        if (!Auth::guard('admin')->check()) {
            Log::warning('Unauthorized admin access attempt', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
                'method' => $request->method()
            ]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthorized access',
                    'status' => 'error'
                ], 401);
            }
            
            return redirect()->route('admin.login')->with('error', 'Please login to access admin area');
        }

        // Check if admin account is still active (not soft deleted)
        $admin = Auth::guard('admin')->user();
        if ($admin && method_exists($admin, 'trashed') && $admin->trashed()) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            
            Log::warning('Soft deleted admin attempted access', [
                'admin_id' => $admin->id,
                'ip' => $request->ip()
            ]);
            
            return redirect()->route('admin.login')->with('error', 'Account is no longer active');
        }

        return $next($request);
    }
}
