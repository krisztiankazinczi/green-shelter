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
        // auth nem biztos hogy van
        $amIAdoptedAndReviewed = Adoption::join('reviews', 'adoptions.id', '=', 'reviews.adoption_id')
        ->where('adoptions.user_id', Auth::user()->id)
        ->first();

        $amIAdopted = null;
        if (!$amIAdoptedAndReviewed) {
            $amIAdopted = Adoption::where('user_id', Auth::user()->id)->first();
        }
        $buttonFunction = null;
        if ($amIAdoptedAndReviewed) $buttonFunction = 'edit';
        if ($amIAdopted) $buttonFunction = 'create';
        
        return view('pages.reviews', compact('reviews', 'buttonFunction'));
    }
}
