@include('layouts._head')
<div class="container">
    <div class="blog-header">
    </div>
    <div class="row">

        @yield('content')
        @include('layouts._side')
    </div><!-- /.row -->
</div><!-- /.container -->

@include('layouts._foot')