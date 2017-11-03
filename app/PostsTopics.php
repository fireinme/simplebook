<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostsTopics extends Model
{
    //
    protected $fillable = ['post_id', 'topic_id'];
}
