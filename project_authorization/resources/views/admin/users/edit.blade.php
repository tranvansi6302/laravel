<x-admin-layout>
    @section('title', 'Sửa người dùng')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sửa người dùng</h1>
    </div>

    <div class="row">

        <div class="col-lg-6 col-md-12">
            <form action="{{ route('admin.users.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Họ Tên</label>
                    <input value="{{ old('name') ?? $user->name }}" type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" placeholder="Nhập họ tên...">
                    <x-validate-error :errors="$errors->get('name')" />

                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input value="{{ old('email') ?? $user->email }}" type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="Nhập địa chỉ email...">
                    <x-validate-error :errors="$errors->get('email')" />

                </div>
               
                <div class="form-group">
                    <label for="group">Nhóm</label>
                    <select class="custom-select @error('group_id') is-invalid @enderror" id="group"
                        name="group_id">
                        <option value="">Chọn nhóm</option>
                        @forelse ($groups as $group)
                            <option {{ old('group_id')==$group->id || $user->group_id==$group->id ?'selected':false }} value="{{ $group->id }}">{{ $group->name }}</option>
                        @empty
                            <option value="">Không có dữ liệu</option>
                        @endforelse
                    </select>
                    <x-validate-error :errors="$errors->get('group_id')" />

                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-4 mr-2">Xác Nhận</button>
                    <a class="btn btn-success px-4" href="{{ route('admin.users.index') }}">Quay Lại</a>
                </div>
            </form>
        </div>
    </div>

</x-admin-layout>
