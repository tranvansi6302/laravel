<x-admin-layout>
    @section('title', 'Danh sách nhóm')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách nhóm</h1>
    </div>
    @can('groups.add')
        <a href="{{ route('admin.groups.add') }}" class="btn btn-primary mb-4 px-4">
            <i class="fa fa-plus"></i>
            Thêm mới
        </a>
    @endcan
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th>Tên nhóm</th>
                <th width="25%">Người đăng</th>
                @can('groups.permission')
                    <th width="12%">Phân quyền</th>
                @endcan
                @can('groups.delete')
                    <th width="8%">Sửa</th>
                @endcan
                @can('groups.delete')
                    <th width="8%">Xóa</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @forelse ($list as $key => $group)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $group->name }}</td>
                    <td>{{ $group->createBy->name ?? false }}</td>
                    @can('groups.permission')
                        <td>
                            <a class="btn btn-primary btn-sm px-3"
                                href="{{ route('admin.groups.getPermission', $group) }}">Phân quyền</a>
                        </td>
                    @endcan
                    @can('groups.edit')
                        <td>
                            <a class="btn btn-success btn-sm px-3" href="{{ route('admin.groups.getEdit', $group) }}">
                                <i class="fa fa-edit mr-2"></i>
                                Sửa
                            </a>
                        </td>
                    @endcan
                    @can('groups.delete')
                        <td>
                            <a onclick="showConfirm(event,'Bạn có chắc muốn xóa nhóm này')"
                                class="btn btn-danger btn-sm px-3" href="{{ route('admin.groups.delete', $group) }}">
                                <i class="fa fa-trash mr-2"></i>
                                Xóa
                            </a>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center bg-warning">Không có dữ liệu</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-admin-layout>
