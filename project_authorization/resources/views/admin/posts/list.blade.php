<x-admin-layout>
    @section('title', 'Danh sách bài viết')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách bài viết</h1>
    </div>
    @can('posts.add')
        <a href="{{ route('admin.posts.add') }}" class="btn btn-primary mb-4 px-4">
            <i class="fa fa-plus"></i>
            Thêm mới
        </a>
    @endcan
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th>Tiêu đề</th>
                <th width="20%">Người đăng</th>
                @can('posts.delete')
                    <th width="8%">Xóa</th>
                @endcan
                @can('posts.edit')
                    <th width="8%">Sửa</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @forelse ($list as $key=> $post)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->createBy->name }}</td>
                    @can('posts.delete')
                        <td>
                            <a onclick="showConfirm(event,'Bạn có chắc muốn xóa bài viết này')"
                                class="btn btn-danger btn-sm px-3" href="{{ route('admin.posts.delete', $post) }}">
                                <i class="fa fa-trash mr-2"></i>
                                Xóa
                            </a>
                        </td>
                    @endcan
                    @can('posts.edit')
                        <td>
                            <a class="btn btn-success btn-sm px-3" href="{{ route('admin.posts.getEdit', $post) }}">
                                <i class="fa fa-edit mr-2"></i>
                                Sửa
                            </a>
                        </td>
                    @endcan
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center bg-warning">Không có dữ liệu</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-admin-layout>
