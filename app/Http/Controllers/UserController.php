<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function showProfile () {
        return view('pages/profile');
    }

    public function editProfile() {
        return view('pages/edit-profile');
    }

    public function updateProfile(Request $request) {
        $rules = [
            'name'=>'required|max:40',
            'email'=>'required|email',
            'image.*' => 'mimes:jpeg,jpg,png,gif|max:2048'
        ];
        $customMessages = [
            'required' => 'A mezőt kötelező kitölteni.',
            'max' => 'Meghaladtad a maximális karakterhosszt (:max).',
            'email' => 'Valós email címet adj meg',
            'mimes' => 'Csak képeket (jpg, png, jpeg, gif) lehet feltölteni',
            'image.max' => 'Képfeltöltés nem sikerült, a kép maximális mérete 2MB'
        ];
        $this->validate($request, $rules, $customMessages);

        if ($request->email !== Auth::user()->email) {
            $isEmailExists = User::where('email', $request->email)->first();
            if ($isEmailExists) {
                return redirect()->back()->with('error', 'A megadott email cím már létezik a rendszerünkben, kérünk válassz másikat.');
            }
        }

        $user = User::where('id', Auth::user()->id)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'A módosítani kívánt profil már nem létezik az adatbázisunkban');
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;

        if (!$request->image) {
            $user->save();
            return redirect('profile')->with('success', 'Sikeresen mentettük a módosítást az adatbázisban.');
        }
        
        if (Auth::user()->avatar_uri) {
            $previous_image_path = base_path() . '/public/images/' . Auth::user()->avatar_uri;
            if(file_exists($previous_image_path)){
                unlink($previous_image_path);
            }
        }

        $extension = $request->image->extension();
        $new_image_name = Str::uuid()->toString() . '.' . $extension;
        $destination = base_path() . '/public/images/users/';
        $request->image->move($destination ,$new_image_name);

        $user->avatar_uri = 'users/' . $new_image_name;
        $user->save();

        return redirect('profile')->with('success', 'Sikeresen mentettük a módosítást az adatbázisban.');
    }
}
