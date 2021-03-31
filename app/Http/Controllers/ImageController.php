<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Image;


class ImageController extends Controller
{
    public function changeMain ($id, $image_id) {
        $originalMainImage = Image::where(['animal_id' => $id, 'main' => true])->first();
        $newMainImage = Image::where('id', $image_id)->first();
        if (!$originalMainImage || !$newMainImage) {
            return redirect()->back()->with('error', 'Sajnos nem tudtuk módosítani a borítóképet, kérünk próbálkozz később.');
        }
        try {
            DB::transaction(function() use ($originalMainImage, $newMainImage)
            {
                $originalMainImage->main = false;
                $originalMainImage->save();
                $newMainImage->main = true;
                $newMainImage->save();
            });

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Sajnos nem tudtuk módosítani a borítóképet, kérünk próbálkozz később.');
        }    
        return redirect()->back()->with('success', 'A borítókép sikeresen megváltozott.');        
    }

    public function destroy ($id) {
        dd($id);
    }
}
