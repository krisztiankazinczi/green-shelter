<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;
use App\Models\Animal;
use Jenssegers\Date\Date;



class MessageController extends Controller
{
    public function index ($type) {
        Date::setLocale('hu');
        $agent = new \Jenssegers\Agent\Agent;
        $isDesktop = $agent->isDesktop();
        $messages = null;
        if ($type == 'inbox') {
            $messages = Message::with('from', 'to')
                ->where('to_id', Auth::user()->id)
                ->where('archived', false)
                ->where('inTrash', false)
                ->orderBy('created_at', 'DESC')
                ->get();
        }
        if ($type == 'sent') {
            $messages = Message::with('from', 'to')
                ->where('from_id', Auth::user()->id)
                ->where('archived', false)
                ->where('inTrash', false)
                ->orderBy('created_at', 'DESC')
                ->get();
        }
        if ($type == 'archived') {
            $messages = Message::with('from', 'to')->where(function ($query) {
                $query->where('from_id', Auth::user()->id)
                    ->orWhere('to_id', Auth::user()->id);
            })->where('archived', true)
            ->where('inTrash', false)
            ->orderBy('created_at', 'DESC')
            ->get();
        }
        if ($type == 'trash') {
            $messages = Message::with('from', 'to')->where(function ($query) {
                $query->where('from_id', Auth::user()->id)
                    ->orWhere('to_id', Auth::user()->id);
            })->where('archived', false)
            ->where('inTrash', true)
            ->orderBy('created_at', 'DESC')
            ->get();
        }

        return view('pages.messages', compact('messages', 'isDesktop'));
    }

    public function showMessage ($type, $id) {
        Date::setLocale('hu');
        $message = Message::with('from', 'to', 'animal', 'animal.menu')->where('id', $id)->first();
        if (!$message) {
            return redirect()->route('home')->with('error', 'Az ??zenet nem l??tezik az adatb??zisban');
        }

        return view('pages.message', compact('message'));
    }

    public function archiveMessage ($id) {
        $message = Message::where('id', $id)->first();
        if (!$message) {
            return redirect()->route('home')->with('error', 'Az ??zenet nem l??tezik az adatb??zisban');
        }
        $message->archived = true;
        $message->save();
        return redirect()->route('show.messages', ['type' => 'inbox'])->with('success', 'Az ??zenet archiv??lva.');
    }

    public function revertArchiveMessage ($id) {
        $message = Message::where('id', $id)->first();
        if (!$message) {
            return redirect()->route('home')->with('error', 'Az ??zenet nem l??tezik az adatb??zisban');
        }
        $message->archived = false;
        $message->save();
        return redirect()->route('show.messages', ['type' => 'inbox'])->with('success', 'Sikeresen ??thelyezted a bej??v?? ??zenetekhez.');
    }

    public function trashMessage($id) {
        $message = Message::where('id', $id)->first();
        if (!$message) {
            return redirect()->route('home')->with('error', 'Az ??zenet nem l??tezik az adatb??zisban');
        }
        $message->inTrash = true;
        $message->save();
        return redirect()->route('show.messages', ['type' => 'inbox'])->with('success', 'Az ??zenetet ??thelyezt??k a kuk??ba.');
    }

    public function revertTrashMessage ($id) {
        $message = Message::where('id', $id)->first();
        if (!$message) {
            return redirect()->back()->with('error', 'Ez az ??zenet nem l??tezik az adatb??zisban.');
        }
        $message->inTrash = false;
        $message->save();
        return redirect()->route('show.messages', ['type' => 'inbox'])->with('success', 'Sikeresen ??thelyezted a bej??v?? ??zenetekhez.');
    }

    public function readMessage($id) {
        $message = Message::where('id', $id)->first();
        if (!$message) {
            return redirect()->back();
        }
        $message->read = true;
        $message->save();
        return redirect()->back();
    }

    public function sendMessage(Request $request) {
        $rules = [
            'from_id'=>'required',
            'to_id'=>'required',
            'animal_id'=>'required',
            'subject'=>'required|min:5|max:150',
            'message'=>'required',
        ];
        $customMessages = [
            'required' => 'A mez??t k??telez?? kit??lteni.',
            'max' => 'Meghaladtad a maxim??lis karakterhosszt (:max).',
            'min' => 'Nem ??rted el a minim??lis karakterhosszt (:min).',
        ];
        $this->validate($request, $rules, $customMessages);

        $from = User::where('id', $request->from_id)->first();
        $to = User::where('id', $request->to_id)->first();
        $animal = Animal::where('id', $request->animal_id)->first();

        if (!$from || !$to || !$animal) {
            return redirect()->back()->with('error', 'Adatb??zis hiba, k??r??nk pr??b??ld meg k??s??bb');
        }

        Message::create([
            'from_id' => $request->from_id,
            'to_id' => $request->to_id,
            'animal_id' => $request->animal_id,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', '??zenet sikeresen elk??ldve');

    }
}
