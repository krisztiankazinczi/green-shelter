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

    public function approveAdoption($id) {
        $adoption_request = Adoption::where('id', $id)->first();
        if (!$adoption_request) {
            return redirect()->back()->with('error', 'A módosítani kívánt kérés már nem szerepel az adatbázisban');
        }

        try {
            DB::transaction(function() use ($adoption_request)
            {
                $adoption_request->status = 'adopted';
                $adoption_request->save();
        
                $requests_for_same_animal = Adoption::where('animal_id', $adoption_request->animal_id)->get();
                foreach ($requests_for_same_animal as $request) {
                    if ($adoption_request->id != $request->id) {
                        $request->status = 'rejected';
                        $request->save();
                    }
                }
            });

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Adatbázis hiba, kérünk próbálkozz később');
        }
        return redirect()->back()->with('success', 'Sikeresen jóváhagytad a befogadást.');
    }
}
