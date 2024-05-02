<?php

namespace App\Http\Service;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Review;
use App\Models\User;
use App\Models\UserIdentification;
use App\Models\UserInformation;
use App\Models\UserRole;
use App\Models\UserVerification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ReviewsService
{
    public static function index()
    {
        $authUser = Auth::user();
       
        $reviews = Review::where('reviewee_id', $authUser->id)
        ->orderBy('created_at', 'DESC')
        ->get();

        return response()->json([
            'reviews' => $reviews,
        ]);
    }

    public static function getMyReviews() 
    {
        $authUser = Auth::user();

        $reviews = Review::where('reviewer_id', $authUser->id)
        ->orderBy('created_at', 'DESC')
        ->get();

        return response()->json([
            'reviews' => $reviews,
        ]);
    }

    public static function store(Request $request)
    {
        $authUser = Auth::user();
        
        $reviewee_id = $request->input('reviewee_id');

        //gcp here multiple images then make an array then json_encode

        Review::create([
            'reviewer_id' => $authUser->id,
            'reviewee_id' => $reviewee_id,
            'title' => $request->input('title'),
            'message' => $request->input('message'),
            // 'images' => $request->input('images'),
            'rating' => $request->input('rating'),
        ]);
    }

    public function show(Review $review)
    {
        $review = Review::where('id', $review->id)
        ->first();

        return response()->json([
            'reviews' => $review,
        ]);
    }

    public function update(Request $request, Review $review)
    {
        $authUser = Auth::user();

        $review = Review::where('reviewer_id', $authUser->id)
        ->where('id', $review->id)
        ->first();

        //gcp here multiple images then make an array then json_encode

        $review->update([
            'title' => $request->input('title'),
            'message' => $request->input('message'),
            // 'images' => $request->input('images'),
            'rating' => $request->input('rating'),
        ]);

        return response()->json([
            'reviews' => $review,
        ]);
    }

    public function destroy(Review $review)
    {
        $authUser = Auth::user();

        $review = Review::where('reviewer_id', $authUser->id)
        ->where('id', $review->id)
        ->first();

        if (! $review) {
            return response()->json([
                'error' => 'Review does not exist'
            ], 404);
        }

        $review->delete();

        return response()->json([
            'success' => 'Review deleted'
        ], 200);
    }
}
