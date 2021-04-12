<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

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
}
