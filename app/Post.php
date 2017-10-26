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

    public function zan()
    {
        return $this->hasMany('User\Zan');
    }

}
