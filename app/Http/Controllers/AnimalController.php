<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Animal;
use Illuminate\Support\Facades\View;

class AnimalController extends Controller
{

     /**
     * Show the application dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function getAnimals(Request $request, $page)
    // {
    //     $uri = 'animals/' . $page;
    //     $menuItem = Menu::where('route', $uri)->first();
    //     $category = Category::where('menu_id', $menuItem->id)->first();
    //     $animals = Animal::with('images')->where('category_id', $category->id)->get();
    //     return View::make('pages/animals')->with('category', $category)->with('animals', $animals);
    // }

    /**
     * Display a listing of the resource.
     *
      * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $page)
    {
        // $uri = $request->path();
        $uri = 'animals/' . $page;
        $menuItem = Menu::where('route', $uri)->first();
        $category = Category::where('menu_id', $menuItem->id)->first();
        $animals = Animal::with('images')->where('category_id', $category->id)->get();
        return View::make('pages/animals')->with('category', $category)->with('animals', $animals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $page
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($page, $id)
    {
        $animal = Animal::with('images')->where('id', $id)->first();
        $menu = Menu::where('id', $animal->menu_id)->first();
        $animal->{"menu"} = $menu;
        return View::make('pages/animal')->with('animal', $animal);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
