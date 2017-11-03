<div class="blog-post">
    <h2 class="blog-post-title"><a href="{{Route('posts.show',$post)}}">{{$post->title}}</a></h2>
    <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}} <a
                href="/user/{{$post->user_id}}">{{$post->user->name}}</a>
    </p>
    {{strip_tags(str_limit($post->content,100,'....'))}}
    <p class="blog-post-meta">赞 {{$post->zans_count}}| 评论{{$post->comments_count}}</p>
</div>
<hr>