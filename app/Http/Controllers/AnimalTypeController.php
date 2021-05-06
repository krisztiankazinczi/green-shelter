<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\AnimalType;
use Illuminate\Support\Str;


class AnimalTypeController extends Controller
{
    public function index($type_id) {
        $animals = Animal::with('images', 'animalType', 'menu')->where('animal_type_id', $type_id)->where('adopted', false)->get();
        $animal_type = AnimalType::where('id', $type_id)->first();
        return view('pages/animal_type', compact('animals', 'animal_type'));
    }

    public function create(Request $request) {
        $rules = [
            'name'=>'required|max:40',
            'description'=>'required',
            'image' => 'required',
            'image.*' => 'mimes:jpeg,jpg,png,gif|max:2048'
        ];
        $customMessages = [
            'required' => 'A mezőt kötelező kitölteni.',
            'max' => 'Meghaladtad a maximális karakterhosszt (:max).',
            'mimes' => 'Csak képeket (jpg, png, jpeg, gif) lehet feltölteni',
            'image.required' => 'Minimum 1 kép feltöltése kötelező',
            'image.max' => 'Képfeltöltés nem sikerült, a kép maximális mérete 2MB'
        ];
        $this->validate($request, $rules, $customMessages);
        $image = $request->image;
        $extension = $image->extension();
        $file_name = Str::uuid()->toString() . '.' . $extension;
        $destination = base_path() . '/public/images/types/';
        $image->move($destination ,$file_name);

        try {
            AnimalType::create([
                'name' => $request->name,
                'description' => $request->description,
                'image_uri' => 'types/' . $file_name,
            ]);
        } catch (\Throwable $th) {
            $file_path = base_path() . '/public/images/types/' . $file_name;
            if(file_exists($file_path)){
                unlink($file_path);
            }
            return redirect()->back()->with('error', 'Adatbázis hiba, kérünk próbálkozz később.');
        }
        return redirect()->back()->with('success', 'Sikeresen elmentettük az adatbázisban az új fajtát.');
    }

    public function show($id) {
        $animal_type = AnimalType::where('id', $id)->first();
        if (!$animal_type) {
            return redirect()->back()->with('error', 'A módosítani kívánt fajta már nem létezik az adatbázisunkban');
        }
        return view('pages/edit-species', compact('animal_type'));
    }

    public function edit(Request $request, $id) {
        $rules = [
            'name'=>'required|max:40',
            'description'=>'required',
            'image.*' => 'mimes:jpeg,jpg,png,gif|max:2048'
        ];
        $customMessages = [
            'required' => 'A mezőt kötelező kitölteni.',
            'max' => 'Meghaladtad a maximális karakterhosszt (:max).',
            'mimes' => 'Csak képeket (jpg, png, jpeg, gif) lehet feltölteni',
            'image.max' => 'Képfeltöltés nem sikerült, a kép maximális mérete 2MB'
        ];
        $this->validate($request, $rules, $customMessages);

        $animal_type = AnimalType::where('id', $id)->first();
        if (!$animal_type) {
            return redirect()->back()->with('error', 'A módosítani kívánt fajta már nem létezik az adatbázisunkban');
        }
        
        $animal_type->name = $request->name;
        $animal_type->description = $request->description;

        if (!$request->image) {
            $animal_type->save();
            return redirect('type/' . $animal_type->id)->with('success', 'Sikeresen mentettük a módosítást az adatbázisban.');
        }
        
        $previous_image_path = base_path() . '/public/images/' . $animal_type->image_uri;
        if(file_exists($previous_image_path)){
            unlink($previous_image_path);
        }
        
        $extension = $request->image->extension();
        $new_image_name = Str::uuid()->toString() . '.' . $extension;
        $destination = base_path() . '/public/images/types/';
        $request->image->move($destination ,$new_image_name);

        $animal_type->image_uri = 'types/' . $new_image_name;
        $animal_type->save();

        return redirect('type/' . $animal_type->id)->with('success', 'Sikeresen mentettük a módosítást az adatbázisban.');
    }

    public function destroy ($id) {
        $animal_type = AnimalType::where('id', $id)->first();
        if (!$animal_type) {
            return redirect()->back()->with('error', 'A módosítani kívánt fajta már nem létezik az adatbázisunkban');
        }

        $is_animal_attached_to_this_species = Animal::where('animal_type_id', $id)->first();

        if ($is_animal_attached_to_this_species) {
            return redirect()->back()->with('error', 'Az állatfajta nem törölhető, mert vannak hozzá tartozó állatok az adatbázisban.');
        }

        $stored_image_path = base_path() . '/public/images/' . $animal_type->image_uri;
        $animal_type->delete();
        if(file_exists($stored_image_path)){
            unlink($stored_image_path);
        }

        return redirect()->back()->with('success', 'Az állatfajtát sikeresen törölted az adatbázisból');
        
    }
}
