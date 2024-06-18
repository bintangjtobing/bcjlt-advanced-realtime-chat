<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index($chatRoomId)
    {
        $messages = Message::where('chat_room_id', $chatRoomId)->with('user')->get();
        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $request->validate([
            'chat_room_id' => 'required|exists:chat_rooms,id',
            'content' => 'required|string',
        ]);

        $message = Message::create([
            'user_id' => $request->user()->id,
            'chat_room_id' => $request->chat_room_id,
            'content' => $request->content,
        ]);

        return response()->json($message);
    }
}