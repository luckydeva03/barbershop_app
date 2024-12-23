<?php

namespace App\Http\Controllers\Route;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class UserPageController extends Controller
{
    public function index()
    {
        $reviews = Review::where('is_approved', true)->get();
        return view('pages.home.index', compact('reviews'));
    }
}
