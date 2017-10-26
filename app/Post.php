<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['title', 'content'];

    public function user()
    {
        return $this->belongsTo('App\User')->withDefault(User::find(1));
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function zan($user_id)
    {
        return $this->hasOne('App\Zan')->where('user_id', $user_id);
    }

    public function zans()
    {
        return $this->hasOne('App\Zan');
    }
}
