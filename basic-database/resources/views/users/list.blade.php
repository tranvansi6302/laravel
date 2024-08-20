@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <h2 class="text-secondary">Danh sách Users</h2>
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <a class="btn btn-primary my-3 d-inline-flex align-items-center gap-2" href="{{ route('users.add') }}">
        Thêm người dùng
        <i class="fa fa-plus fs-6"></i>
    </a>
    <table class="table">
        <thead>
            <tr>
                <th width="10%">STT</th>
                <th>Họ Và Tên</th>
                <th>Địa chỉ email</th>
                <th width="20%">Thời gian</th>
                <th width="5%">Xóa</th>
                <th width="5%">Sửa</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($allUsers as $key => $user)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $user->fullname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->create_at }}</td>
                    <td>
                        <a onclick="return confirm('Bạn có muốn xóa ?')" href="{{ route('users.delete',['id'=> $user->id]) }}" class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('users.edit',['id'=> $user->id]) }}" class="btn btn-success btn-sm">
                            <i class="fa-solid fa-user-pen"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="4">Không có dữ liệu</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
