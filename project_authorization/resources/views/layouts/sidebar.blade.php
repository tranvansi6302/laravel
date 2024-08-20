        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">TVS Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tổng quan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Quản lý
            </div>

            {{-- Bài viết --}}

            @can('posts')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_posts"
                        aria-expanded="true" aria-controls="collapse_posts">
                        <i class="fas fa-newspaper"></i>
                        <span>Bài viết</span>
                    </a>
                    <div id="collapse_posts" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('admin.posts.index') }}">Danh sách</a>
                            @can('posts.add')
                                <a class="collapse-item" href="{{ route('admin.posts.add') }}">Thêm mới</a>
                            @endcan
                        </div>
                    </div>
                </li>
            @endcan

            {{-- Nhóm người dùng  --}}
            @can('groups')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_groups"
                        aria-expanded="true" aria-controls="collapse_groups">
                        <i class="fas fa-users"></i>
                        <span>Nhóm người dùng</span>
                    </a>
                    <div id="collapse_groups" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('admin.groups.index') }}">Danh sách</a>
                           @can('groups.add')
                           <a class="collapse-item" href="{{ route('admin.groups.add') }}">Thêm mới</a>
                           @endcan
                        </div>
                    </div>
                </li>
            @endcan
            {{-- Người dùng --}}
            @can('users')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_users"
                        aria-expanded="true" aria-controls="collapse_users">
                        <i class="fas fa-user"></i>
                        <span>Người dùng</span>
                    </a>
                    <div id="collapse_users" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('admin.users.index') }}">Danh sách</a>
                            @can('users.add')
                                <a class="collapse-item" href="{{ route('admin.users.add') }}">Thêm mới</a>
                            @endcan
                        </div>
                    </div>
                </li>
            @endcan
        </ul>
        <!-- End of Sidebar -->
