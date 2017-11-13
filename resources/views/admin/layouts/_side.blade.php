<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            @can('admin')
                <li class="treeview active">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>系统管理</span>
                        <span class="pull-right-container"></span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('admin.user')}}"><i class="fa fa-circle-o"></i> 用户管理</a></li>
                        <li><a href="{{route('role.index')}}"><i class="fa fa-circle-o"></i> 角色管理</a></li>
                        <li><a href="{{route('per.index')}}"><i class="fa fa-circle-o"></i> 权限管理</a></li>
                        s
                    </ul>
                </li>
            @endcan
            @can('post')
                <li class="active treeview">
                    <a href="{{route('admin.posts')}}">
                        <i class="fa fa-dashboard"></i> <span>文章管理</span>
                    </a>
                </li>
                <li class="active treeview">
                    <a href="{{route('topic.index')}}">
                        <i class="fa fa-dashboard"></i> <span>专题管理</span>
                    </a>
                </li>
                <li class="active treeview">
                    <a href="{{route('notice.index')}}">
                        <i class="fa fa-dashboard"></i> <span>通知管理</span>
                    </a>
                </li>
            @endcan
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
