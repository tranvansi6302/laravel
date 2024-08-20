@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <h1 class="my-5 text-center">Danh sách bài viết</h1>
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <form action="{{ route('posts.delete-any') }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa')">
        <button class="btn btn-danger btn-sm px-5 mb-4" type="submit">Xóa</button>

        <table class="table">
            <thead>
                <tr>
                    <th width="5%">
                        <input type="checkbox" name="checkAll">
                    </th>
                    <th width="5%">STT</th>
                    <th>Tiêu đề</th>
                    <th>Trạn thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($allPosts as $key => $post)
                    <tr>
                        <td>
                            <input type="checkbox" name="delete[]" value="{{ $post->id }}">
                        </td>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $post->title }}</td>
                        <td>
                            @if ($post->trashed())
                                <button class="btn btn-sm btn-danger">Đã xóa</button>
                            @else
                                <button class="btn btn-sm btn-success">Chưa xóa</button>
                            @endif
                        </td>
                        <td>
                            @if ($post->trashed())
                                    <a href="{{ route('posts.restore',$post) }}" class="btn btn-sm btn-success">Khôi phục</a>
                                    <a href="{{ route('posts.force-delete',$post) }}" class="btn btn-sm btn-danger">Xóa vĩnh viễn</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Không có dữ liệu</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @csrf
    </form>
@endsection
