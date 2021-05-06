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
                $amIAdopted = Adoption::where('user_id', Auth::user()->id)->where('status', 'adopted')->first();
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
        $rules = [
            'rating'=>'required|numeric|min:1|max:5',
            'review'=>'required',
        ];
        $customMessages = [
            'required' => 'A mezőt kötelező kitölteni.',
            'numeric' => 'A mező értéke csak szám lehet.',
            'max' => 'Az értékelés mezo maximális értéke: :max.',
            'min' => 'Az értékelés mezo minimális értéke: :max.',
        ];
        $this->validate($request, $rules, $customMessages);

        $myAdoption = Adoption::where('user_id', Auth::user()->id)->where('status', 'adopted')->first();
        if (!$myAdoption) {
            return redirect()->back()->with('error', 'Amíg nem fogadtál be egy kiskedvencet, nem írhatsz véleményt rólunk');
        }

        Review::create([
            'adoption_id' => $myAdoption->id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);
        return redirect()->back()->with('success', 'A véleményedet siekresen mentettük az adatbázisban.');
    }

    public function editReview(Request $request) {
        $rules = [
            'rating'=>'required|numeric|min:1|max:5',
            'review'=>'required',
        ];
        $customMessages = [
            'required' => 'A mezőt kötelező kitölteni.',
            'numeric' => 'A mező értéke csak szám lehet.',
            'max' => 'Az értékelés mezo maximális értéke: :max.',
            'min' => 'Az értékelés mezo minimális értéke: :max.',
        ];
        $this->validate($request, $rules, $customMessages);
        // $review = Review::where('id', )
    }


}
