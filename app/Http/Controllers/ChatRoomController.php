<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{
    public function index()
    {
        $chatRooms = ChatRoom::all();
        return response()->json($chatRooms);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:chat_rooms',
        ]);

        $chatRoom = ChatRoom::create([
            'name' => $request->name,
        ]);

        return response()->json($chatRoom);
    }

    public function show($id)
    {
        $chatRoom = ChatRoom::with('users')->findOrFail($id);
        return response()->json($chatRoom);
    }

    public function invite(Request $request, $chatRoomId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $chatRoom = ChatRoom::findOrFail($chatRoomId);

        // Check if the user is already in the chat room
        if ($chatRoom->users()->where('user_id', $request->user_id)->exists()) {
            return response()->json(['message' => 'User already in the chat room'], 400);
        }

        // Add user to chat room with inviter information
        $chatRoom->users()->attach($request->user_id, [
            'joined_at' => now(),
            'invited_by' => $request->user()->id,
        ]);

        return response()->json(['message' => 'User invited to chat room successfully']);
    }
}