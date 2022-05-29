<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    //
    public function index()
    {
        $messages = Message::where('to_id', '1')->with(['from', 'to'])->paginate(10);
        return view('admin.conversation.index', compact('messages'));
    }
    public function show($id)
    {
        $messages = Message::where('conversation_id', $id)->get();

        return view('admin.conversation.show', compact('messages', 'id'));
    }
    public function store(Request $request)
    {

        $message = new Message();
        $message->message = $request->message;
        $message->from_id = $request->from_id;
        $message->to_id = auth()->id();
        $message->conversation_id = $request->conversation_id;
        $message->save();
        return redirect()->route('admin.conversations.show', $request->conversation_id);
    }
}
