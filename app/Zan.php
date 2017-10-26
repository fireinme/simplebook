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


}
