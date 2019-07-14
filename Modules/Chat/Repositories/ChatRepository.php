<?php


namespace Modules\Chat\Repository;

use Illuminate\Database\Eloquent\Model;
use Modules\Chat\Repositories\MessageRepository;


class ChatRepository extends Model
{
    protected $table = 'chats';


    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function child()
    {
        return $this->hasOne(ChildRepository::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsToMany(UserRepository::class, 'users', 'chat_id', 'user_id');
    }

    public function messages()
    {
        return $this->hasMany(MessageRepository::class, 'chat_id', 'id')->toSql();
    }

    /**
     * @param $user_id
     * @return ChatRepository
     */
    public function allChatUserHasAccess($user_id)
    {
        return $this->where('user_id', $user_id)->get();
    }

    public function show($chat_id)
    {
         return \DB::table('chats')
            ->select([
                'messages.message',
                'messages.created_at',
                'users.name'
            ])
            ->where('chats.child_id', $chat_id)
             ->join('children', 'children.id', 'chats.child_id')
            ->leftJoin('messages', 'messages.chat_id', 'chats.id')
            ->leftJoin('users', 'users.id', 'messages.user_id')
            //->groupBy('chats.child_id')
            ->get();


        // ->simplePaginate(15);

        //return $this->where('id', $chat_id)->first();
    }
}