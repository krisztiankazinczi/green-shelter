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

    public function readContactMessage ($id) {
        $message = ContactForm::where('id', $id)->first();
        if (!$message) {
            return redirect()->back();
        }
        $message->read = true;
        $message->save();
        return redirect()->back();
    }

    public function completeContactMessage ($id) {
        $message = ContactForm::where('id', $id)->first();
        if (!$message) {
            return redirect()->back()->with('error', 'Ez az üzenet nem létezik az adatbázisban.');
        }
        $message->completed = true;
        $message->save();
        return redirect()->back()->with('success', 'Sikeresen teljesítetted a kérést');
    }

    public function revertCompleteContactMessage ($id) {
        $message = ContactForm::where('id', $id)->first();
        if (!$message) {
            return redirect()->back()->with('error', 'Ez az üzenet nem létezik az adatbázisban.');
        }
        $message->completed = false;
        $message->save();
        return redirect()->back()->with('success', 'Visszavontad a teljesítést');
    }
}
