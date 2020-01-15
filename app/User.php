<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'level', 'country_code', 'phone', 'email', 'password', 'provider', 'provider_user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function friends()
    {
       return $this->belongsToMany('App\User','friend_user','user_id','friend_id')->withTimestamps();;
    }

    public function addFriend($frnId)
    {
        $this->friends()->sync($frnId,false);
    }

    public function removeFriend($frnId)
    {
        $this->friends()->detach($frnId);
    }

    public function isFriend($userId)
    {
        return $this->friends()
            ->where('friend_id', $userId)
            ->exists();
    }
}
