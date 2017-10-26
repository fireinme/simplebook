<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zan extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\user');
    }

    public function zan($user)
    {
        return $this->hasOne('App\Zan')->where('user_id', $user->id);
    }

    public function zans()
    {
        return $this->hasOne('App\Zan');
    }
}
