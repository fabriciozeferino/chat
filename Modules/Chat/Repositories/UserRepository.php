<?php

namespace Modules\Chat\Repository;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Modules\Chat\Repositories\MessageRepository;

class UserRepository extends Model
{
    use Notifiable;

    protected $table = 'users';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_verified_at', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * A user can have many messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function message()
    {
        return $this->hasMany(MessageRepository::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function chat()
    {
        return $this->belongsToMany(ChatRepository::class, 'chat', 'user_id', 'child_id');
    }


    /**
     * Return all users to show online or offline
     *
     * @param User $user
     * @return User[]|Collection
     */
    public function users(User $user)
    {
        return $user->all('id', 'name');
    }
}