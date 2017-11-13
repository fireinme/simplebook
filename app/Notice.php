<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    //
    protected $fillable = ['title', 'content'];

    public function Users()
    {
        return $this->belongsToMany('App\User', 'users_notices', 'notice_id', 'user_id
        ');
    }
}
