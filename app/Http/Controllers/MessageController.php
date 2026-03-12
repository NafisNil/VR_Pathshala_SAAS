<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    //
    public function index()
    {
        $messages = Message::latest()->get();
        return view('backend.messages.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required|max:100',
            'message' => 'required',
        ]);

        Message::create($request->all());

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
