<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showProfile () {
        return view('pages/profile');
    }

    public function editProfile() {
        return view('pages/edit-profile');
    }

    public function updateProfile(Request $request) {
        dd($request);
    }
}
