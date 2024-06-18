<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatRoomController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PrivateMessageController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    Route::get('/chat-rooms', [ChatRoomController::class, 'index']);
    Route::post('/chat-rooms', [ChatRoomController::class, 'store']);
    Route::get('/chat-rooms/{id}', [ChatRoomController::class, 'show']);

    Route::post('/messages', [MessageController::class, 'store']);
    Route::get('/chat-rooms/{id}/messages', [MessageController::class, 'index']);
    Route::post('/chat-rooms/{chatRoom}/invite', [ChatRoomController::class, 'invite']);


    Route::get('/private-messages', [PrivateMessageController::class, 'index']);
    Route::post('/private-messages', [PrivateMessageController::class, 'store']);

});