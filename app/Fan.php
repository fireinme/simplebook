<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Fan extends Pivot
{
    //
    protected $fillable = ['fan_id', 'star_id'];


}
