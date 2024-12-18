<?php

namespace App\Http\Controllers\Route;

use App\Http\Controllers\Controller;
use App\Models\ReedemCode;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = User::all()->count();
        $codeRedeem = ReedemCode::all()->count();
        $codeRedeemActive = ReedemCode::where('is_active', 1)->count();
        $review = Review::all()->count();
        $reviewActive = Review::where('is_approved', 1)->count();
        return view('pages.admin.dashboard.index', compact('user', 'codeRedeem', 'codeRedeemActive', 'review', 'reviewActive'));
    }
}
