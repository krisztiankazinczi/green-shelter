<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('pages/admin');
    }

    public function indexWithOption($option) {
        return view('pages/admin', compact('option'));
    }
}
