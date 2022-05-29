<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'type' => 'required',
        ]);
        if ($validator->fails()) {

            return response()->json(['errors' => true, 'message' => $validator->errors()], 200);
        }

        $converstion = Conversation::create(['name' => auth()->user()->name . $request->post('type'), 'type' => $request->post('type')]);
        if ($converstion) {
            return response()->json(['errors' => false, 'message' => $converstion], 200);
        } else {
            return response()->json(['errors' => true, 'message' => 'هناك خطا ما'], 404);
        }
    }
    public function show($id)
    {

        $messages = Message::where('conversation_id', $id)->where('from_id', auth()->id())->orwhere('to_id', auth()->id())->get();
        if ($messages) {
            return response()->json(['errors' => false, 'message' => $messages], 200);
        } else {
            return response()->json(['errors' => false, 'message' => 'هناك خطا ما'], 404);
        }
    }
    public function store_chat(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'to_id' => 'required|exists:users,id',
            'message' => 'required',
            'conversation_id' => 'required',
        ]);
        if ($validator->fails()) {

            return response()->json(['errors' => true, 'message' => $validator->errors()], 200);
        }

        $message = Message::create([
            'message' => $request->post('message'),
            'from_id' => auth()->id(),
            'to_id' => $request->post('to_id'),
            'conversation_id' => $request->post('conversation_id'),
        ]);
        if($message){
            return response()->json(['errors' => false, 'message' => $message], 200);
        }else{
            return response()->json(['errors' => true, 'message' => 'هناك خطا ما'], 404);
        }
    }
    //
}
