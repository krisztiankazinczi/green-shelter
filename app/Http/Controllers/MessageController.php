<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use Jenssegers\Date\Date;



class MessageController extends Controller
{
    public function index ($type) {
        Date::setLocale('hu');
        $agent = new \Jenssegers\Agent\Agent;
        $isDesktop = $agent->isDesktop();
        $messages = null;
        if ($type == 'inbox') {
            $messages = Message::with('from', 'to')->where('to_id', Auth::user()->id)->where('archived', false)->get();
        }
        if ($type == 'sent') {
            $messages = Message::with('from', 'to')->where('from_id', Auth::user()->id)->where('archived', false)->get();
        }
        if ($type == 'archived') {
            $messages = Message::with('from', 'to')->where(function ($query) {
                $query->where('from_id', Auth::user()->id)
                    ->orWhere('to_id', Auth::user()->id);
            })->where('archived', true)->get();

            // $messages = Message::with('from', 'to')
            // ->where('archived', true)
            // ->orWhere('from_id', Auth::user()->id)
            // ->orWhere('to_id', Auth::user()->id)
            // ->get();
        }

        return view('pages.messages', compact('messages', 'isDesktop'));
    }

    public function showMessage ($type, $id) {
        Date::setLocale('hu');
        $message = Message::with('from', 'to', 'animal')->where('id', $id)->first();
        // return ha nem letezik
        return view('pages.message', compact('message'));
    }

    public function archiveMessage ($id) {
        $message = Message::where('id', $id)->first();
        if (!$message) {
            return redirect()->back()->with('error', 'Ez az üzenet nem létezik az adatbázisban.');
        }
        $message->archived = true;
        $message->save();
        return redirect('messages/inbox')->with('success', 'Az üzenet archiválva.');
    }

    public function revertArchiveMessage ($id) {
        $message = Message::where('id', $id)->first();
        if (!$message) {
            return redirect()->back()->with('error', 'Ez az üzenet nem létezik az adatbázisban.');
        }
        $message->archived = false;
        $message->save();
        return redirect('messages/inbox')->with('success', 'Sikeresen visszavontad az archiválást.');
    }
}
