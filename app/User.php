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
        return $this->belongsToMany('App\User', 'fans', 'star_id', 'id');
    }

    public function stars()
    {
        return $this->belongsToMany('App\User', 'fans', 'fan_id', 'id');
    }

    public function fan($fan_id)
    {
        return $this->belongsToMany('App\User', 'fans', 'star_id', 'id')
            ->where('fan_id', $fan_id);

    }

    public function star($star_id)
    {
        return $this->belongsToMany('App\User', 'fans', 'fan_id', 'id')
            ->where('star_id', $star_id);

    }
}