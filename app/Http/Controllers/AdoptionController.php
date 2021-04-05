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
        $animal = Animal::where('id', $adoption_request->animal_id)->first();
        if (!$animal) {
            return redirect()->back()->with('error', 'A befogadni kívánt hirdetés nem létezik a rendszerünkben');
        }
        try {
            DB::transaction(function() use ($adoption_request, $animal)
            {
                $adoption_request->status = 'adopted';
                $adoption_request->save();

                $animal->adopted = true;
                $animal->save();
        
                $requests_for_same_animal = Adoption::where('animal_id', $adoption_request->animal_id)->get();
                foreach ($requests_for_same_animal as $request) {
                    if ($adoption_request->id != $request->id) {
                        $request->status = 'rejected';
                        $request->save();
                        // write listener on this operation and send email to users about rejection
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

    public function rejectAdoption($id) {
        $adoption_request = Adoption::where('id', $id)->first();
        if (!$adoption_request) {
            return redirect()->back()->with('error', 'A módosítani kívánt kérés már nem szerepel az adatbázisban');
        }
        $animal = Animal::where('id', $adoption_request->animal_id)->first();
        if (!$animal) {
            return redirect()->back()->with('error', 'A befogadni kívánt hirdetés nem létezik a rendszerünkben');
        }
        $adoption_request->status = 'rejected';
        $adoption_request->save();

        return redirect()->back()->with('success', 'A kérést elutasítottad');
    }

    public function revertAdoptionRejection($id) {
        $adoption_request = Adoption::where('id', $id)->first();
        if (!$adoption_request) {
            return redirect()->back()->with('error', 'A módosítani kívánt kérés már nem szerepel az adatbázisban');
        }
        $animal = Animal::where('id', $adoption_request->animal_id)->first();
        if (!$animal) {
            return redirect()->back()->with('error', 'A befogadni kívánt hirdetés nem létezik a rendszerünkben');
        }

        if ($animal->adopted) {
            return redirect()->back()->with('error', 'Az állatot már befogadták, így nem lehet visszavonni az elutasítást. Ha mégis szeretnéd, akkor vond vissza előbb a befogadást');
        }

        $adoption_request->status = 'requested';
        $adoption_request->save();
        return redirect()->back()->with('success', 'Az elutasított befogadási kérést sikeresen visszavontad');

    }
}
