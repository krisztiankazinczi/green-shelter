<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Animal;

class CheckAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {  
      $animal_id = $request->route('id');
      $advertisement = Animal::where('id', $animal_id)->first();
      if (!$advertisement) {
        return redirect()->back()->with('error', 'Sajnáljuk, de a keresett hirdetés nem található');
      }
      // if the user is who created it or if the user is admin
      if (Auth::user()->id == $advertisement->user_id || Auth::user()->role_id == 3) {
        app()->instance('advertisement', $advertisement);
        return $next($request);
      } else {
        return redirect()->back()->with('error', 'Nincs jogosultságod módosítani ezt a hirdetést.');
      }
    }
}
