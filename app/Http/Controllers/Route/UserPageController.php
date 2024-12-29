<?php

namespace App\Http\Controllers\Route;

use App\Http\Controllers\Controller;
use App\Models\HistoryPoint;
use App\Models\Review;
use Illuminate\Http\Request;

class UserPageController extends Controller
{
    public function index()
    {
        $reviews = Review::where('is_approved', true)->get();
        return view('pages.home.index', compact('reviews'));
    }

    public function dashboard()
    {
        $user = auth('user')->user();
        $review = Review::where('user_id', auth('user')->id())->first();
        return view('pages.user.dashboard.index', compact('review', 'user'));
    }

    public function transactionHistory()
    {
        $histories = HistoryPoint::where('user_id', auth('user')->id())->get();
        return view('pages.user.history.index', compact('histories'));
    }
}
