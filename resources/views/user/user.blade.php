@extends('layouts.main')
@section('content')

    <div class="col-sm-8">
        <blockquote>
            <p>
                <img src="/storage//.jpeg"
                     alt="" class="img-rounded" style="border-radius:500px; height: 40px"> {{$user->name}}
            </p>
            <footer>关注：{{count($stars)}}｜粉丝{{count($fans)}}｜文章：{{count($posts)}}</footer>
        </blockquote>
    </div>
    <div class="col-sm-8 blog-main">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
            </ul>
            <div class="tab-content">
                <!-- /.tab-pane -->

                <div class="tab-pane active" id="tab_1">
                    @foreach($posts as $post )
                        <div class="blog-post" style="margin-top: 30px">
                            <p class=""><a href="{{route('user.index',$post->user)}}">{{$post->user->name}}</a> 6天前</p>
                            <p class=""><a href="{{route('posts.show',$post)}}">{{$post->title}}</a></p>
                            <p>
                            <p>{{$post->content}}</p>
                        </div>
                    @endforeach
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    @foreach($stars as $star )
                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{$star->name}}</p>
                            <p class="">关注：1 | 粉丝：1｜ 文章：0</p>
                            <div>
                                <button class="btn btn-default like-button" like-value="1" like-user="6"
                                        _token="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy" type="button">取消关注
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                    @foreach($fans as $fan )
                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{$fan->name}}</p>
                            <p class="">关注：1 | 粉丝：1｜ 文章：0</p>

                        </div>
                    @endforeach
                </div>
            </div>


        </div>
        <!-- /.tab-content -->
    </div><!-- /.blog-main -->

@stop