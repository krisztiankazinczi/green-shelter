<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Adoption;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index() {
        $reviews = Review::with('adoption', 'adoption.user')->get();
        
        $buttonFunction = null;
        $myReview = null;
        if (Auth::user()) {
            $amIAdoptedAndReviewed = Adoption::join('reviews', 'adoptions.id', '=', 'reviews.adoption_id')
            ->where('adoptions.user_id', Auth::user()->id)
            ->first();

            $amIAdopted = null;
            if (!$amIAdoptedAndReviewed) {
                $amIAdopted = Adoption::where('user_id', Auth::user()->id)->first();
            }
            if ($amIAdoptedAndReviewed) {
                $myReview = $amIAdoptedAndReviewed;
                $buttonFunction = 'edit';
            } 
            if ($amIAdopted) $buttonFunction = 'create';
        }

        
        return view('pages.reviews', compact('reviews', 'buttonFunction', 'myReview'));
    }

    public function addReview(Request $request) {
        dd($request->review);
    }

    public function editReview(Request $request) {
        dd($request->rating);
    }


}
