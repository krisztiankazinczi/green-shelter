<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Image;
use App\Models\Menu;


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

    public function destroy ($id, $image_id) {
        $image = Image::where('id', $image_id)->first();
        if (!$image) {
            return redirect()->back()->with('error', 'A kép nem található az adatbázisban.');
        }
        $file_path = base_path() . '/public/images/' . $image->filename;
        if(file_exists($file_path)){
            unlink($file_path);
        }
        $image->delete();
        return redirect()->back()->with('success', 'A képet töröltük az adatbázisból');
    }

    public function gallery () {
        $images = Image::with('animal')->get();
        if (!$images) {
            return redirect('home')->with('error', 'Adatbázis hiba miatt az oldal jelenleg nem elérhető. Dolgozunk a problémán.');
        }
        foreach ($images as $image) {
            $menu = Menu::where('id', $image->animal->menu_id)->first();
            $image->{"menu"} = $menu;
        }
        return view('pages/gallery', compact('images'));
    }
}
