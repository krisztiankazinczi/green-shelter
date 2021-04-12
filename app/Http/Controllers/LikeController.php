<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Animal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class LikeController extends Controller
{
    public function toggleLike($animal_id) {
        $my_like = Like::where('animal_id', $animal_id)->where('user_id', Auth::user()->id)->first();
        if (!$my_like) {
            Like::create([
                'animal_id' => $animal_id,
                'user_id' => Auth::user()->id
            ]);
        } else {
            $my_like->delete();
        }
        return redirect()->back();
    }

    public function myLikes() {
        // $animals = Animal::join('likes', 'animals.id', '=', 'likes.animal_id')->with('images', 'animalType', 'menu', 'likesCount')
        // ->where('likes.user_id', Auth::user()->id)
        // ->get();
        $animals = Animal::with('images', 'animalType', 'menu', 'likesCount')->whereHas('likedByMe')->get();
        return view('pages/my_likes', compact('animals'));
    }
}
