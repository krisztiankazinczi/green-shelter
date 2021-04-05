<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Animal;
use App\Models\Adoption;

class AdoptionController extends Controller
{
    public function adoptionRequest($id) {
        $animal = Animal::where('id', $id)->first();
        if (!$animal) {
            return redirect('home')->with('error', 'A befogadni kívánt hirdxetés nem létezik a rendszerünkben.');
        }
        Adoption::create([
            'user_id' => Auth::user()->id,
            'animal_id' => $id
        ]);
        return redirect()->back()->with('success', 'Befogadási szándékodat rögzítettük, hamarosan jelentkezünk.');
    }
}
