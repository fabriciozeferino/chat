<?php

namespace Modules\Chat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Chat\Http\Requests\CreateMessageRequest;
use Modules\Chat\Services\MessageService;

class MessageController extends Controller
{
    /**
     * @var
     */
    private $message;

    public function __construct(MessageService $message)
    {
        $this->middleware('auth');

        $this->message = $message;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('chat::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('chat::create');
    }

    /**
     * Persist message to database
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateMessageRequest $request)
    {
        $this->message->create($request);
    }

    /**
     * Show the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function getMessages()
    {
        $messages = $this->message->getAllMessages();

        return response()->json($messages);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('chat::edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
