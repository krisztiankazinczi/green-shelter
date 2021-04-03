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
        $menu = Menu::where('route', $uri)->first();
        // redirect if not exists
        $category = Category::where('menu_id', $menu->id)->first();
        // joinolni a tablakat!!!!
        $animals = Animal::with('images')->where('category_id', $category->id)->where('adopted', false)->get();
        return view('pages/animals', compact('animals', 'category', 'menu'));
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
        return view('pages/animal', compact('animal', 'page'));
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
        $animal_types = AnimalType::all();
        return view('pages/edit_animal', compact('animal', 'page', 'animal_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $page, $id)
    {
        // dd($request->all());

        $rules = [
            'title'=>'required|max:70',
            'description'=>'required',
            'animal_type'=>'required',
            'images.*' => 'mimes:jpeg,jpg,png,gif|max:2048'
        ];
        $customMessages = [
            'required' => 'A mezőt kötelező kitölteni.',
            'max' => 'Meghaladtad a maximális karakterhosszt (:max).',
            'mimes' => 'Csak képeket (jpg, png, jpeg, gif) lehet feltölteni',
            'images.max' => 'Képfeltöltés nem sikerült, a képek maximális mérete 2MB'
        ];
        $this->validate($request, $rules, $customMessages);

        // Get the relationship ids
        $animal = Animal::where('id', $id)->first();
        if (!$animal) {
            return redirect('animals/' . $page . '/' . $id . '/edit')->with('error', 'A módosítani kívánt hirdetés nem létezik az adatbázisunkban');
        }
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
        // Update Record
        try {
            DB::transaction(function() use ($animal, $request, $images, $page, $id, $files)
            {
                $animal->title = $request->title;
                $animal->description = $request->description;
                $animal->animal_type_id = $request->animal_type;
                $animal->save();

                if ($files) {
                    foreach ($images as $index => $image_name) {
                        Image::create([
                            'filename' => $image_name,
                            'main' => false, // main image have been uploaded earlier, we don't need a new one
                            'animal_id' => $animal->id
                        ]);
                    }
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
            return redirect('animals/' . $page . '/' . $id . '/edit')->with('error', 'Sajnos nem tudtuk módosítani a hirdetést, kérünk próbálkozz később.');
        }            
        return redirect('animals/' . $page . '/' . $id)->with('success', 'Sikeresen módosítottad a hirdetést.');
    }

    public function destroy($id)
    {
        // it must exists since in a middleware already checked
        $advertisement = Animal::where('id', $id)->first();
        $file_names = array();
        $images = Image::where('animal_id', $advertisement->id)->get();
        foreach ($images as $image) {
            $file_names[] = $image->filename;
        }
        try {
            DB::transaction(function() use ($advertisement, $images) {
                foreach ($images as $image) {
                    $image->delete();
                }
                $advertisement->delete();
            });

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            // ezt meg ki kell talalni hova redirectaljunk
            return redirect('home')->with('error', 'Nem sikerült törölni a hirdetést, próbáld meg később.');
        }

        foreach ($file_names as $image_name) {
            $file_path = base_path() . '/public/images/' . $image_name;
            if(file_exists($file_path)){
                unlink($file_path);
            }
        }
        // ezt meg ki kell talalni hova redirectaljunk
        return redirect('home')->with('success', 'Sikeresen töröltük a hirdetést az adatbázisból.');
    }

    public function successStories() {
        $animals = Animal::with('images')->where('adopted', true)->get();
        $category = Category::with('menu')->where('id', 4)->first();
        // ez igy nem helyes, csinald vissza a modelt es joinold ezt
        if (!$animals || !$category) {
            return redirect('home')->with('error', 'Az oldal jelenleg nem elérhető, ezért visszairányítottunk a főoldalra..');
        }
        return view('pages/adopteds', compact('animals', 'category'));
    }

    public function successStory($id) {
        $animal = Animal::with('images')->where('id', $id)->first();
        if (!$animal) {
            return redirect('home')->with('error', 'Adatbázis hiba, kérünk próbálkozz később.');
        }
        return view('pages/adopted', compact('animal'));
    }

    public function adopt($page, $id) {
        $animal = Animal::where('id', $id)->first();
        if (!$animal) {
            return redirect()->back()->with('error', 'Adatbázis hiba, kérünk próbálkozz később.');
        }
        $animal->adopted = true;
        $animal->save();

        return redirect('success-stories/' . $id)->with('success', 'Sikeresen mentettük a befogadást a rendszerünkben.');
    }

    public function withdrawAdopt($id) {
        $animal = Animal::where('id', $id)->first();
        if (!$animal) {
            return redirect()->back()->with('error', 'Adatbázis hiba, kérünk próbálkozz később.');
        }
        $menu = Menu::where('id', $animal->menu_id)->first();
        $animal->adopted = false;
        $animal->save();
        return redirect($menu->route . '/' . $id)->with('success', 'Visszavontuk a befogadást a rendszerünkben.');
    }

    public function animalOfWeek () {
        $animal = Animal::with('images')->where('dog_of_the_week', true)->first();
        if (!$animal) {
            return redirect('home')->with('error', 'Adatbázis hiba, kérünk próbálkozz később.');
        }
        $menu = Menu::where('id', $animal->menu_id)->first();
        $animal->{"menu"} = $menu;
        $split = explode('/',$menu->route);
        $page = end($split);
        return view('pages/animal', compact('animal', 'page'));
    }

}
