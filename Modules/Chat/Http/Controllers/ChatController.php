<?php

namespace Modules\Chat\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Chat\Services\ChatService;


class ChatController extends Controller
{
    /**
     * @var
     */
    private $user_id;


    /**
     * @var ChatService
     */
    private $chatService;

    /**
     * ChatController constructor.
     * @param ChatService $chatService
     */
    public function __construct(ChatService $chatService)
    {
        $this->middleware(function ($request, $next) {

            $this->user_id = Auth::id();

            return $next($request);
        });

        $this->chatService = $chatService;
    }

    /**
     * Show chats
     *
     * @return View
     */
    public function index()
    {
        return view('chat::index');
    }

    /**
     * Show a list of chat that the user has access
     *
     * @return ChatService
     */
    public function all()
    {
        return response()->json($this->chatService->all($this->user_id));
    }


    /**
     * @param $chat_id
     * @return ChatService
     */
    public function show($chat_id)
    {
        return response()->json($this->chatService->show($chat_id));
    }




    /**
     * Persist message to database
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
//    public function store(CreateMessageRequest $request)
//    {
//        $this->messageService->create($request);
//
//    }





}