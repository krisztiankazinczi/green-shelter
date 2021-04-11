<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\AnimalType;

class AnimalTypeController extends Controller
{
    public function index($type_id) {
        $animals = Animal::with('images', 'animalType', 'menu')->where('animal_type_id', $type_id)->where('adopted', false)->get();
        $animal_type = AnimalType::where('id', $type_id)->first();
        return view('pages/animal_type', compact('animals', 'animal_type'));
    }
}
