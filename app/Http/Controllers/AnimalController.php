<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Menu;
use App\Models\Category;
use App\Models\Animal;
use App\Models\Image;
use App\Models\AnimalType;


class AnimalController extends Controller
{

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
        // Validate Form Data, created custom hungarian error messages
        $rules = [
            'title'=>'required|max:70',
            'description'=>'required',
            'animal_type'=>'required',
            'images' => 'required',
            'images.*' => 'mimes:jpeg,jpg,png,gif|max:2048'
        ];
        $customMessages = [
            'required' => 'A mezőt kötelező kitölteni.',
            'max' => 'Meghaladtad a maximális karakterhosszt (:max).',
            'mimes' => 'Csak képeket (jpg, png, jpeg, gif) lehet feltölteni',
            'images.required' => 'Minimum 1 kép feltöltése kötelező',
            'images.max' => 'Képfeltöltés nem sikerült, a képek maximális mérete 2MB'
        ];
        $this->validate($request, $rules, $customMessages);

        // Get the relationship ids
        $menu = Menu::where('route', 'animals/' . $page)->first();
        if (!$menu) {
            return redirect('home/')->with('error', 'Érvénytelen url-ről érkezett kérés.');
        }
        if ($menu->role_id > Auth::user()->role_id) {
            // if this page is accessible only for admins
            return redirect('home/')->with('error', 'Nincs jogosultságod ilyen hirdetést feltölteni');
        }
        $category = Category::where('menu_id', $menu->id)->first();
        
        //File upload to server
        $files = $request->images;
        $images=array();
        if ($files) {
            foreach($files as $file){
                $extension = $file->extension();
                $name = Str::uuid()->toString() . '.' . $extension;
                $destination = base_path() . '/public/images';
                $file->move($destination ,$name);
                $images[] = $name;
            }
        }
            
        // Create Record
        try {
            DB::transaction(function() use ($request, $images, $menu, $category, $page)
            {
                $newAnimal = Animal::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'animal_type_id' => $request->animal_type,
                    'menu_id' => $menu->id,
                    'category_id' => $category->id,
                    'user_id' => Auth::user()->id
                ]);
                foreach ($images as $index => $image_name) {
                    Image::create([
                        'filename' => $image_name,
                        'main' => $index == 0 ? true : false,
                        'animal_id' => $newAnimal->id
                    ]);
                }
            });

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            // delete images if db create was unsuccess
            foreach ($images as $image_name) {
                $file_path = base_path() . '/public/images/' . $image_name;
                if(file_exists($file_path)){
                    unlink($file_path);
                }
            }
            // ez valamiert nem redirectel vissza
            return redirect('animals/' . $page . '/create')->with('error', 'Sajnos nem tudtuk létrehozni a hirdetést, kérünk próbálkozz később.');
        }            
        return redirect('animals/' . $page . '/create')->with('success', 'Sikeresen feladtad a hirdetést, reméljük hamarosan gazdira talál.');
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
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($page, $id)
    {
        $animal = Animal::with('images')->where('id', $id)->first();
        $menu = Menu::where('id', $animal->menu_id)->first();
        $animal->{"menu"} = $menu;
        return View::make('pages/animal')->with('animal', $animal);
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
