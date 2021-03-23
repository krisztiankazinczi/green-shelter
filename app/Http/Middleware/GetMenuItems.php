<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\View;

class GetMenuItems
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
        $menuItems = Menu::all();
        foreach ($menuItems as $item) {
            foreach ($menuItems as $item1) {
                if ($item->name == $item1->parent && !isset($item->hasSubMenu)) {
                    $item->{"hasSubMenu"} = true;
                }
            };
        }
        View::share('menuItems', $menuItems);
        return $next($request);
    }
}
