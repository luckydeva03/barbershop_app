<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('user')->check()) {
            Log::info('Unauthenticated user access attempt', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
                'method' => $request->method()
            ]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Authentication required',
                    'status' => 'error'
                ], 401);
            }
            
            return redirect()->route('home')->with('info', 'Please login to access this page');
        }

        // Check if user account is still active (not soft deleted)
        $user = Auth::guard('user')->user();
        if ($user && method_exists($user, 'trashed') && $user->trashed()) {
            Auth::guard('user')->logout();
            $request->session()->invalidate();
            
            Log::warning('Soft deleted user attempted access', [
                'user_id' => $user->id,
                'ip' => $request->ip()
            ]);
            
            return redirect()->route('home')->with('error', 'Account is no longer active');
        }

        return $next($request);
    }
}
