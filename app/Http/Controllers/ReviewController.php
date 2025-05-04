<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        return view('Review');
    }

    public function store(ReviewRequest $request)
    {
        Review::create($request->validated());

        return redirect()->back()->with('success', 'Thank you for your review! It will be visible after moderation.');
    }

    public function adminIndex()
    {
        $reviews = Review::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function updateStatus(Request $request, Review $review)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $review->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Review status updated successfully.');
    }
}
