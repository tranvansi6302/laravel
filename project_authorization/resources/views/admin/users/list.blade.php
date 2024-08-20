<x-admin-layout>
    @section('title', 'Danh sách người dùng')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách người dùng</h1>
    </div>
    @can('users.add')
        <a href="{{ route('admin.users.add') }}" class="btn btn-primary mb-4 px-4">
            <i class="fa fa-plus"></i>
            Thêm mới
        </a>
    @endcan
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th width="25%">Họ Tên</th>
                <th>Email</th>
                <th width="15%">Nhóm</th>
                @can('users.edit')
                    <th width="8%">Sửa</th>
                @endcan
                @can('users.delete')
                    <th width="8%">Xóa</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @forelse ($list as $key => $user)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->group->name }}</td>
                    @can('users.edit')
                        <td>
                            <a href="{{ route('admin.users.getEdit', $user) }}" class="btn btn-success btn-sm px-3">
                                <i class="fa fa-edit"></i>
                                Sửa
                            </a>
                        </td>
                    @endcan
                    @can('users.delete')
                        <td>
                            @if (Auth::user()->id != $user->id)
                                <a onclick="showConfirm(event,'Bạn có chắc muốn xóa người dùng này')"
                                    href="{{ route('admin.users.delete', $user) }}" class="btn btn-danger btn-sm px-3">
                                    <i class="fa fa-trash"></i>
                                    Xóa
                                </a>
                            @endif
                        </td>
                    @endcan
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center bg-warning">Không có dữ liệu</td>
                </tr>
            @endforelse

        </tbody>
    </table>
</x-admin-layout>
