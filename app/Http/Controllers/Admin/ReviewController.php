<?php

namespace App\Http\Controllers\Admin;

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

    public function index(Request $request)
    {
        $search = $request->input('search');

        $reviews = $this->review
            ->when($search, function ($query, $search) {
                return $query->where('content', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('pages.admin.review.index', compact('reviews', 'search'));
    }

    public function toggleApproval($id)
    {
        $review = $this->review->find($id);

        // Toggle the approval status
        $review->update([
            'is_approved' => !$review->is_approved,
        ]);

        return redirect()->back()->with('success', 'Review approval status has been toggled.');
    }
}
