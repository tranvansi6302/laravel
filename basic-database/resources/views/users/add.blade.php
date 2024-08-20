@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <section class="d-flex justify-content-center w-100">
        <div class="w-50">
            <h2 class="text-secondary mb-3">Thêm Users</h2>
            @if ($errors->any())
                <div class="alert alert-danger">Vui lòng kiểm tra lại dữ liệu nhập vào</div>
            @endif
            <form action="{{ route('users.add') }}" method="POST">
                @csrf
                <div class="">
                    <label class="form-label text-secondary fw-medium" for="fullname">Họ Và Tên</label>
                    <input value="{{ old('fullname') }}" name="fullname" id="fullname"
                        class="form-control text-secondary shadow @error('fullname') is-invalid @enderror" type="text"
                        placeholder="Họ và tên...">
                    @error('fullname')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-2">
                    <label class="form-label text-secondary fw-medium" for="email">Địa chỉ Email</label>
                    <input value="{{ old('email') }}" name="email" id="email"
                        class="form-control text-secondary shadow  @error('email') is-invalid @enderror" type="text"
                        placeholder="Email...">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="d-flex align-items-center gap-3 mt-4">
                    <button class="btn btn-success" type="submit">Thêm người dùng</button>
                    <a href="{{ route('users.index') }}" class="btn btn-warning" type="submit">Quay lại</a>
                </div>
            </form>
        </div>
    </section>
@endsection
