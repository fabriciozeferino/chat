<?php


namespace Modules\Chat\Services;


use Modules\Chat\Events\MessageSent;
use Modules\Chat\Repositories\MessageRepository;

class MessageService
{
    /**
     * @var MessageRepository
     */
    private $message;

    /**
     * MessageService constructor.
     * @param MessageRepository $message
     */
    public function __construct(MessageRepository $message)
    {
        $this->message = $message;
    }

    public function getAllMessagesChat($chat_id)
    {
        $messages = $this->message->find($chat_id);

        return $messages->toArray();
    }



    public function store($data)
    {
        try {
            $user_id = auth()->id();

            $message = $this->message->insert([
                'message' => $data['message'],
                'user_id' => $user_id
            ]);


            broadcast(new MessageSent($user_id, $message))->toOthers();

            return response()->json('Message Sent!', 201);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
        }
    }

    public function getMessagesByChatId($chat_id)
    {
        $this->message->getMessagesByChatId($chat_id);
    }

}
