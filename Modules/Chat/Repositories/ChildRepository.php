<?php

namespace Modules\Chat\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Modules\Chat\Repository\MessageRepository;

class ChildRepository extends Model
{
    protected $table = 'children';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function chat()
    {
        return $this->hasOne(ChatRepository::class);
    }
}