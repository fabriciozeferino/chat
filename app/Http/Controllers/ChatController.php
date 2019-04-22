<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use App\Events\MessageSent;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return View
     */
    public function index()
    {
        return view('chat');
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
        $messages = Message::with('user')->get();

        return response()->json($messages);
    }


    /**
     * Persist message to database
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(Request $request)
    {
        $user = auth()->user();

        $message = $user->messages()->create([
            'message' => $request['message'],
        ]);

        broadcast(new MessageSent($user, $message))->toOthers();

        return response()->json( 'Message Sent!', 201);
    }
}
