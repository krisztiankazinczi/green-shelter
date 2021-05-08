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
use App\Models\Adoption;

use Jenssegers\Date\Date;


class AnimalController extends Controller
{

    public function __construct()
    {
        Date::setLocale('hu');
    }

    /**
     * Display a listing of the resource.
     *
      * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $page)
    {
        $searchFor = $request->query('t');
        $filter_by = $request->query('filter');
        $order = $request->query('order');

        // if (($filter_by && ($filter_by != 'created_at' || $filter_by != 'title')) && 
        // ($order && ($order != 'desc' || $order != 'asc'))) {
        //     return redirect('home')->with('error', 'Érvénytelen url');
        // }

        $menu = Menu::where('route', $page)->first();
        if (!$menu) {
            return redirect('home')->with('error', 'A megnyitni próbált oldal nem létezik, ezért visszairányítottunk a főoldalra');
        }
        // in front-end I will check if user has access to create this kind of advertisement or not
        $create_menu = Menu::where('route', $page . '/create')->first();
        $create_button_role_id = $create_menu->role_id;
        // redirect if not exists
        $category = Category::with('menu')->where('menu_id', $menu->id)->first();
        $animals = Animal::with('images', 'animalType', 'menu', 'likesCount')
            ->where('menu_id', $menu->id)
            ->where('adopted', false);

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
        return view('pages/animals', compact('animals', 'category', 'menu', 'create_button_role_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create($page)
    {
        $animal_types = AnimalType::orderBy('name')->get();
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
        $menu = Menu::where('route', $page)->first();
        if (!$menu) {
            return redirect('home/')->with('error', 'Érvénytelen url-ről érkezett kérés.');
        }
        if ($menu->role_id > Auth::user()->role_id) {
            // if this page is accessible only for admins
            return redirect('home/')->with('error', 'Nincs jogosultságod ilyen hirdetést feltölteni');
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
            
        // Create Record
        try {
            DB::transaction(function() use ($request, $images, $menu, $page)
            {
                $newAnimal = Animal::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'animal_type_id' => $request->animal_type,
                    'menu_id' => $menu->id,
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
        $animal = Animal::with('images', 'adoptions', 'menu', 'likesCount')->where('id', $id)->first();
        $adoptionRequest = null;

        if (Auth::user()) {
            $adoptionRequest = Adoption::where([
                'animal_id' => $id,
                'user_id' => Auth::user()->id
            ])->first();
        }

        return view('pages/animal', compact('animal', 'page', 'adoptionRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($page, $id)
    {
        $animal = Animal::with('images', 'menu')->where('id', $id)->first();
        $animal_types = AnimalType::orderBy('name',)->get();
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
        if ($advertisement->animal_of_the_week) {
            return redirect()->back()->with('error', 'A hét állata nem törölhető.');
        }
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

    public function successStories(Request $request) {
        $searchFor = $request->query('t');
        $filter_by = $request->query('filter');
        $order = $request->query('order');

        $animals = Animal::with('images', 'animalType', 'menu', 'likesCount')
            ->where('adopted', true);

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


        $category = Category::with('menu')->where('id', 6)->first();
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
        return view('pages/animal', compact('animal'));
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
        $animal = Animal::with('menu')->where('id', $id)->first();
        if (!$animal) {
            return redirect()->back()->with('error', 'Adatbázis hiba, kérünk próbálkozz később.');
        }
        $animal->adopted = false;
        $animal->save();
        return redirect($animal->menu->route . '/' . $id)->with('success', 'Visszavontuk a befogadást a rendszerünkben.');
    }

    public function animalOfWeek () {
        $animal = Animal::with('images', 'menu')->where('animal_of_the_week', true)->first();
        if (!$animal) {
            return redirect('home')->with('error', 'Adatbázis hiba, kérünk próbálkozz később.');
        }
        $split = explode('/',$animal->menu->route);
        $page = end($split);

        $adoptionRequest = null;

        if (Auth::user()) {
            $adoptionRequest = Adoption::where([
                'animal_id' => $animal->id,
                'user_id' => Auth::user()->id
            ])->first();
        }

        return view('pages/animal', compact('animal', 'page', 'adoptionRequest'));
    }

    public function setAnimalOfWeek ($id) {
        $previousAnimalOfWeek = Animal::where('animal_of_the_week', true)->first();
        $newAnimalOfWeek = Animal::where('id', $id)->first();
        if (!$newAnimalOfWeek) {
            return redirect()->back()->with('error', 'Adatbázis hiba, kérünk próbálkozz később.');
        }

        try {
            DB::transaction(function() use ($previousAnimalOfWeek, $newAnimalOfWeek) {
                $previousAnimalOfWeek->dog_of_the_week = false;
                $previousAnimalOfWeek->save();
                $newAnimalOfWeek->dog_of_the_week = true;
                $newAnimalOfWeek->save();
            });

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Adatbázis hiba, kérünk próbálkozz később.');
        }

        return redirect('animal-of-week')->with('success', 'Sikeresen frissítettük a hét állatát.');
    }

}
