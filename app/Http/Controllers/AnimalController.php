<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Animal;
use App\Models\AnimalType;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;


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
     */
    public function create($page)
    {
        $animal_types = AnimalType::all();
        return view('pages/create_animal', compact('animal_types', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $page)
    {
        // checkolni h user be van e jelentkezve ->redirect
        // szinten nehany dolgot csak adminok tolthetnek fel, azt is checkolni kell!!!!!!!!

        // Validate Form Data
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required',
            'animal_type'=>'required'
        ]);

        // Get the relationship ids
        $menu = Menu::where('route', 'animals/' . $page)->first();
        $category = Category::where('menu_id', $menu->id)->first();
        
        // Create Record
        Animal::create([
            'title' => $request->title,
            'description' => $request->description,
            'animal_type_id' => $request->animal_type,
            'menu_id' => $menu->id,
            'category_id' => $category->id,
            'user_id' => Auth::user()->id
        ]);

        return redirect('animals/' . $page)->with('success', 'Sikeresen feladtad a hirdetést, reméljük hamarosan gazdira talál.');
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
