<?php


namespace Modules\Chat\Services;


use Modules\Chat\Repository\ChatRepository;


class ChatService
{
    /**
     * @var ChatRepository
     */
    private $chat;


    /**
     * ChatService constructor.
     *
     * @param ChatRepository $chat
     */
    public function __construct(ChatRepository $chat)
    {
        $this->chat = $chat;
    }

    /**
     * @return array
     */
    public function show($chat_id)
    {
        return $this->chat->show($chat_id);
    }

    /**
     * @param $user_id
     * @return ChatRepository
     */
    public function all($user_id)
    {
        return $this->chat->allChatUserHasAccess($user_id);
    }
}