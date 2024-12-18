<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddPointRequest;
use App\Http\Requests\Admin\ShowPointRequest;
use App\Models\HistoryPoint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserManagementController extends Controller
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = $this->user
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(10); // 10 items per page

        return view('pages.admin.user-management.index', compact('users', 'search'));
    }

    public function storePoint(AddPointRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $user = $this->user->find($validated['user_id']);

            if ($validated['type'] === 'deposit') {
                $user->increment('points', $validated['points']);
            } else if ($validated['type'] === 'withdrawal') {
                if ($user->points < $validated['points']) {
                    return response()->json([
                        'message' => 'Insufficient points',
                        'status' => 'error',
                    ], 400);
                }
                $user->decrement('points', $validated['points']);
            }

            HistoryPoint::create([
                'user_id' => $validated['user_id'],
                'after_transaction' => $user->points,
                'before_transaction' => $validated['type'] === 'deposit' ? $user->points - $validated['points'] : $user->points + $validated['points'],
                'points' => $validated['points'],
                'type' => $validated['type'],
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Point added successfully',
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

    public function showHistory(int $userId)
    {
        $histories = HistoryPoint::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->with('user')
            ->paginate(10);

        return view('pages.admin.user-management.history', compact('histories'));
    }

    public function deleteUser(int $userId)
    {
        $user = $this->user->find($userId);
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
            'status' => 'success',
        ], 200);
    }
}
