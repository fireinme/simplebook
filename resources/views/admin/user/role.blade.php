@extends('admin.layouts.main')
@section('content')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">角色列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{route('user.role.store',$user)}}"
                              method="POST">
                            {{csrf_field()}}
                            @foreach($roles as $role)
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="roles[]"
                                                   @if($myRoles->contains($role))
                                                   checked
                                                   @endif
                                                   value="{{$role->id}}">

                                            {{$role->name}}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                        @include('layouts.error')


                    </div>
                </div>
            </div>
        </div>
    </section>

@stop