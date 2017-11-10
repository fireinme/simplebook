@extends('admin.layouts.main')
@section('content')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">权限列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{route('role.per.store',$role)}}" method="POST">
                            {{csrf_field()}}
                            @foreach($pers as $per)
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions[]"
                                                   @if($MyPers->contains($per))
                                                   checked
                                                   @endif
                                                   value="{{$per->id}}">
                                            {{$per->name}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">提交</button>
                                </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>
@stop