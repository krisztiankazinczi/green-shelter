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

    public function myLikes(Request $request) {
        $searchFor = $request->query('t');
        $filter_by = $request->query('filter');
        $order = $request->query('order');

        $filter_options = array('created_at', 'title', null);
        $order_options = array('asc', 'desc', null);
        if (!in_array($filter_by, $filter_options) || !in_array($order, $order_options)) {
            return redirect()->route('home')->with('error', 'Érvénytelen url');
        }

        $animals = Animal::with('images', 'animalType', 'menu', 'likesCount')->whereHas('likedByMe');
        if ($searchFor) {
            $animals = $animals->where(function ($q) use ($searchFor) {
                $q->where('title', 'like', "%{$searchFor}%")
                    ->orWhere('description', 'like', "%{$searchFor}%");
            });
        }
        if ($filter_by) {
            if ($order) {
                $animals = $animals->orderBy($filter_by, $order)->get();
            } else {
                $animals = $animals->orderBy($filter_by, 'DESC')->get();
            }
        } elseif ($order) {
            $animals = $animals->orderBy('updated_at', $order)->get();
        } else {
            $animals = $animals->orderBy('updated_at', 'DESC')->get();
        }
        
        return view('pages/my_likes', compact('animals'));
    }
}
