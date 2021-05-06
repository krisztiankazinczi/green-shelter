<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;

class ContactFormController extends Controller
{
    public function index () {
        return view('pages.contact_details');
    }

    public function sendMessage (Request $request) {
        $rules = [
            'name'=>'required|min:5|max:255',
            'email'=>'required|min:5|max:255|email',
            'subject'=>'required|min:5|max:255',
            'message'=>'required',
        ];
        $customMessages = [
            'required' => 'A mezőt kötelező kitölteni.',
            'email' => 'Érvényes email címet adj meg',
            'max' => 'Meghaladtad a maximális karakterhosszt (:max).',
            'min' => 'Nem érted el a minimális karakterhosszt (:min).',
        ];
        $this->validate($request, $rules, $customMessages);

        ContactForm::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Az üzenetet kézbesítve, hamarosan valaki felveszi a kapcsolatot');
    }
}
