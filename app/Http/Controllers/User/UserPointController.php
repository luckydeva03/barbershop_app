<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HistoryPoint;
use App\Models\ReedemCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserPointController extends Controller
{
    private HistoryPoint $historyPoint;

    public function __construct(HistoryPoint $historyPoint)
    {
        $this->historyPoint = $historyPoint;
    }

    public function showHistory(int $userId)
    {
        try {
            // Authorization check
            $currentUser = Auth::guard('user')->user();
            if ($currentUser->id !== $userId) {
                Log::warning('Unauthorized access to user history', [
                    'current_user_id' => $currentUser->id,
                    'requested_user_id' => $userId,
                    'ip' => request()->ip()
                ]);
                
                return response()->json([
                    'message' => 'Unauthorized access',
                    'status' => 'error',
                ], 403);
            }

            $histories = $this->historyPoint
                ->forUser($userId)
                ->with('user:id,name,email')
                ->orderBy('created_at', 'desc')
                ->paginate(15);

            return response()->json([
                'message' => 'User point history retrieved successfully',
                'status' => 'success',
                'data' => $histories,
            ]);
            
        } catch (ModelNotFoundException $e) {
            Log::warning('User history not found', [
                'user_id' => $userId,
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'message' => 'User not found',
                'status' => 'error',
            ], 404);
            
        } catch (\Exception $e) {
            Log::error('Error retrieving user history', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'message' => 'Internal server error',
                'status' => 'error',
            ], 500);
        }
    }

    public function redeemCode(Request $request)
    {
        try {
            // Rate limiting
            $key = 'redeem_code_' . Auth::guard('user')->id();
            if (RateLimiter::tooManyAttempts($key, 3)) {
                $seconds = RateLimiter::availableIn($key);
                throw ValidationException::withMessages([
                    'code' => "Too many redeem attempts. Please try again in {$seconds} seconds.",
                ]);
            }

            $validated = $request->validate([
                'code' => 'required|string|max:255',
            ]);

            $reedemCode = ReedemCode::where('code', $validated['code'])->first();
            
            if (!$reedemCode) {
                RateLimiter::hit($key, 600); // 10 minutes decay
                
                Log::warning('Invalid redeem code attempted', [
                    'code' => $validated['code'],
                    'user_id' => Auth::guard('user')->id(),
                    'ip' => $request->ip()
                ]);
                
                throw ValidationException::withMessages([
                    'code' => 'Code not found',
                ]);
            }

            if (!$reedemCode->isValid()) {
                RateLimiter::hit($key, 300); // 5 minutes decay
                
                $message = $reedemCode->isExpired() ? 'Code has expired' : 'Code is not active or has been used';
                
                Log::info('Invalid redeem code status', [
                    'code' => $validated['code'],
                    'user_id' => Auth::guard('user')->id(),
                    'is_active' => $reedemCode->is_active,
                    'expires_at' => $reedemCode->expires_at,
                    'current_uses' => $reedemCode->current_uses,
                    'max_uses' => $reedemCode->max_uses
                ]);
                
                throw ValidationException::withMessages([
                    'code' => $message,
                ]);
            }

            DB::beginTransaction();
            
            $user = Auth::guard('user')->user();
            $previousPoints = $user->points;
            $newPoints = $previousPoints + $reedemCode->points;

            // Create history record
            HistoryPoint::create([
                'user_id' => $user->id,
                'type' => 'deposit',
                'before_transaction' => $previousPoints,
                'after_transaction' => $newPoints,
                'points' => $reedemCode->points,
                'description' => "Redeem code: {$reedemCode->code}",
            ]);

            // Update user points
            User::where('id', $user->id)->increment('points', $reedemCode->points);
            $newPoints = $previousPoints + $reedemCode->points;

            // Mark code as used
            $reedemCode->markAsUsed($user);

            DB::commit();
            RateLimiter::clear($key);

            Log::info('Code redeemed successfully', [
                'code' => $validated['code'],
                'user_id' => $user->id,
                'points_added' => $reedemCode->points,
                'previous_points' => $previousPoints,
                'new_points' => $newPoints
            ]);

            return response()->json([
                'message' => 'Code redeemed successfully',
                'status' => 'success',
                'data' => [
                    'points_added' => $reedemCode->points,
                    'total_points' => $newPoints
                ]
            ], 200);
            
        } catch (ValidationException $e) {
            DB::rollBack();
            throw $e;
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Code redeem error', [
                'error' => $e->getMessage(),
                'user_id' => Auth::guard('user')->id(),
                'code' => $validated['code'] ?? 'unknown',
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'message' => 'Internal server error',
                'status' => 'error',
            ], 500);
        }
    }
}
