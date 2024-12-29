<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    private Review $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function index()
    {
        $review = $this->review->where('user_id', auth()->id())->first();
        return view('pages.user.review.index', compact('review'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required'
        ]);

        $this->review->updateOrCreate(
            ['user_id' => auth('user')->id()],
            ['content' => $validated['content']]
        );

        return response()->json([
            'message' => 'Review created successfully',
            'status' => 'success',
        ]);
    }
}
