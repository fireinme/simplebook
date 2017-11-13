<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany('App\Post');

    }

    public function fans()
    {
        return $this->belongsToMany('App\User', 'fans', 'star_id', 'fan_id');
    }

    public function stars()
    {
        return $this->belongsToMany('App\User', 'fans', 'fan_id', 'star_id');
    }


    public function is_star($star_id)
    {
        return $this->stars()
            ->where('star_id', $star_id)->count();

    }

    public function notices()
    {
        return $this->belongsToMany('App\Notice', 'users_notices', 'user_id', 'notice_id');
    }

    public function sendNotice(Notice $notice)
    {
        return $this->notices()->attach($notice->id);
    }
}