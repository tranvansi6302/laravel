@extends('layouts.main')
@section('title')
    {{ $title }}
@endsection
@section('content')
    @php
        if (session('msg')) {
            toast(session('msg'), session('msg_type'), 'top-center');
        }
    @endphp
    <h3 class="mb-4 mt-5 text-uppercase text-secondary text-center">Danh Sách Người Dùng
        <i class="fa-light fa-list-dropdown ms-2"></i>
    </h3>
    <div class="d-flex justify-content-end">
        <a href="{{ route('users.add') }}" class="btn btn-outline-success">Thêm Mới Người
            <i class="fa fa-plus ms-1"></i>
        </a>
    </div>
    <form class="mb-4" action="" method="GET">
        <div class="d-flex align-items-end gap-4">
            <div class="w-25">
                <label class="form-label d-flex align-items-center gap-2 text-primary-emphasis fw-medium" for="">
                    Trạng Thái
                    <i class="fa-solid fa-user-check"></i>
                </label>
                <select name="status" class="form-select shadow">
                    <option value="0">Tất cả trạng thái</option>
                    <option {{ request()->status == 'active' ? 'selected' : false }} value="active">Kích hoạt</option>
                    <option {{ request()->status == 'inactive' ? 'selected' : false }} value="inactive">Chưa kích hoạt
                    </option>
                </select>
            </div>
            <div class="w-25">
                <label class="form-label d-flex align-items-center gap-2 text-primary-emphasis fw-medium" for="">
                    Nhóm Người Dùng
                    <i class="fa-duotone fa-users"></i>
                </label>
                <select name="group_id" class="form-select shadow">
                    <option value="">Tất cả nhóm người dùng</option>
                    @if (!empty($allGroup))
                        @foreach ($allGroup as $group)
                            <option {{ request()->group_id == $group->id ? 'selected' : false }}
                                value="{{ $group->id }}">
                                {{ $group->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="w-50 d-flex align-items-center gap-2">
                <input value="{{ request()->keyword }}" name="keyword" class="form-control shadow" type="text"
                    placeholder="Nhập nội dung cần tìm...">
                <button class="btn btn-primary flex-shrink-0 shadow d-flex align-items-baseline gap-2">Tìm kiếm
                    <i class="fa-regular fa-magnifying-glass"></i>
                </button>
            </div>
        </div>

    </form>

    <table class="table">
        <thead class="table-success">
            <tr>
                <th width="5%">STT</th>
                <th>
                    <a class="text-dark text-decoration-none" href="?sort-by=fullname&sort-type={{ $sortType }}">Họ Và
                        Tên
                        @if (request()->input('sort-by') == 'fullname' && $sortType == 'desc')
                            <i class="fa-regular fa-arrow-down-triangle-square"></i>
                        @else
                            <i class="fa-regular fa-arrow-up-triangle-square"></i>
                        @endif
                    </a>
                </th>
                <th width="26%">
                    <a class="text-dark text-decoration-none" href="?sort-by=email&sort-type={{ $sortType }}">
                        Địa chỉ Email
                        @if (request()->input('sort-by') == 'email' && $sortType == 'desc')
                            <i class="fa-regular fa-arrow-down-triangle-square"></i>
                        @else
                            <i class="fa-regular fa-arrow-up-triangle-square"></i>
                        @endif
                    </a>
                </th>
                <th width="15%">
                    <a class="text-dark text-decoration-none" href="?sort-by=create_at&sort-type={{ $sortType }}">Ngày
                        Tạo
                        @if (request()->input('sort-by') == 'create_at' && $sortType == 'desc')
                            <i class="fa-regular fa-arrow-down-triangle-square"></i>
                        @else
                            <i class="fa-regular fa-arrow-up-triangle-square"></i>
                        @endif
                    </a>
                </th>
                <th width="10%">Nhóm</th>
                <th width="10%">Trạng Thái</th>
                <th class="text-center" width="15%">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($allUser as $key=> $user)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $user->fullname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->create_at }}</td>
                    <td>{{ $user->group_name }}</td>
                    <td>
                        @if ($user->status == 0)
                            <button class="btn btn-warning btn-sm">Chưa kích hoạt</button>
                        @else
                            <button class="btn btn-success btn-sm">Đã kích hoạt</button>
                        @endif
                    </td>

                    <td class="d-flex align-items-center gap-3 justify-content-center">
                        <a class="btn btn-sm btn-danger flex-shrink-0"
                            onclick="showConfirm(event,'Bạn có chắc chắn muốn xóa người dùng này')"
                            href="{{ route('users.delete', ['id' => $user->id]) }}">
                            Xóa
                            <i class="fa-light fa-user-minus ms-1"></i>
                        </a>
                        <a class="btn btn-sm btn-warning flex-shrink-0"
                            href="{{ route('users.edit', ['id' => $user->id]) }}">
                            Sửa
                            <i class="fa-regular fa-user-pen ms-1"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center py-4" colspan="7">Không có dữ liệu</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-end mt-5">
        {{ $allUser->appends(request()->query())->links() }}
    </div>
@endsection
