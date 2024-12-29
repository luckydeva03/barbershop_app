<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HistoryPoint;
use App\Models\ReedemCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $histories = $this->historyPoint->where('user_id', $userId)->get();
            return response()->json([
                'message' => 'User point history',
                'status' => 'success',
                'data' => $histories,
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'error',
            ]);
        }
    }

    public function redeemCode(Request $request)
    {
        try {
            $validated = $request->validate([
                'code' => 'required|string',
            ]);

            $reedemCode = ReedemCode::where('code', $validated['code'])->first();
            if (!$reedemCode) {
                return response()->json([
                    'message' => 'Code not found',
                    'status' => 'error',
                ]);
            }
            if($reedemCode->is_active == 0){
                return response()->json([
                    'message' => 'Code is not active',
                    'status' => 'error',
                ]);
            }

            DB::beginTransaction();
            $user = auth('user')->user();
            HistoryPoint::create([
                'user_id' => $user->id,
                'type' => 'deposit',
                'before_transaction' => $user->points,
                'after_transaction' => $user->points + $reedemCode->points,
                'points' => $reedemCode->points,
            ]);

            $user->points += $reedemCode->points;
            $user->save();

            $reedemCode->is_active = 0;
            $reedemCode->user_id = $user->id;
            $reedemCode->save();

            DB::commit();

            return response()->json([
                'message' => 'Code reedem success',
                'status' => 'success',
            ], 200);
        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'error',
            ], 500);
        }
    }
}
