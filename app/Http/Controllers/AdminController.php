<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adoption;

class AdminController extends Controller
{
    public function index() {
        return view('pages/admin');
    }

    public function adoptions($type) {
        if ($type != 'requested' && $type != 'adopted' && $type != 'rejected') {
            return redirect('home')->with('error', 'Nem megfelelő típus');
        }
        $requests = Adoption::with('animal', 'user')->where('status', $type)->get();
        return view('pages/admin', compact('requests'));
    }

    public function createSpecies() {
        return view('pages/admin');
    }
}
