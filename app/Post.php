<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    //
    protected $fillable = ['title', 'content', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id')->withDefault(['name' => 'dennis']);
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

    public function topics()
    {
        return $this->belongsToMany('App\Topic', 'posts_topics');
    }

    public function postTopics()
    {
        return $this->hasMany('App\PostsTopics');
    }

    public function scopeAuthorBy(Builder $query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    public function scopeTopicNotBy(Builder $query, $topic_id)
    {
        return $query->doesntHave('postTopics', 'and', function ($q) use ($topic_id) {
            $q->where("topic_id", $topic_id);
        });
    }
}
