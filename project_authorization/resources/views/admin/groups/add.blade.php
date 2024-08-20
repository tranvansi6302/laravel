<x-admin-layout>
    @section('title', 'Thêm nhóm')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm nhóm</h1>
    </div>

    <div class="row">

        <div class="col-lg-6 col-md-12">
            <form action="{{ route('admin.groups.add') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Tên nhóm</label>
                    <input value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" placeholder="Nhập tên nhóm...">
                    <x-validate-error :errors="$errors->get('name')" />
                </div>
               
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-4 mr-2">Xác Nhận</button>
                    <a class="btn btn-success px-4" href="{{ route('admin.groups.index') }}">Quay Lại</a>
                </div>
            </form>
        </div>
    </div>

</x-admin-layout>
