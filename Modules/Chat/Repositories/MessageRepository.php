<?php

namespace Modules\Chat\Repositories;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Modules\Chat\Repository\ChatRepository;
use Modules\Chat\Repository\UserRepository;


class MessageRepository extends Model
{
    use Notifiable;

    protected $table = 'messages';

    protected $fillable = ['message'];

    protected $appends = ['selfMessage'];

    protected $hidden = ['updated_at'];


    /**
     * @return bool
     */
    public function getSelfMessageAttribute()
    {
        return $this->user_id === auth()->user()->id;
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    /*protected $casts = [
        'created_at' => 'datetime:d/m/Y | H:i',
        'updated_at' => 'datetime:d/m/Y | H:i',
    ];*/


    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(UserRepository::class);
    }

    /**
     * @return BelongsTo
     */
    public function chat()
    {
        return $this->belongsTo(ChatRepository::class);
    }


    /**
     * @return MessageRepository
     */
    public function getAllMessages()
    {
        return $this->with('user')->get();
    }

    /**
     * @param $chat_id
     * @return mixed
     */
    public function getMessagesByChatId($chat_id)
    {
        return $this->where('chat_id', $chat_id)->paginate(2);
    }
}