<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Support\Facades\View;

class Animals extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getDogs(Request $request)
    {
        $uri = $request->path();
        $menuItem = Menu::where('route', $uri)->first();
        $category = Category::where('menu_id', $menuItem->id)->first();
        return View::make('pages/home')->with('category', $category);
    }
}
