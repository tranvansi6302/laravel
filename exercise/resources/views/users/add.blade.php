@extends('layouts.main')
@section('title')
    {{ $title }}
@endsection
@section('content')
@php
    if($errors->has('msg') && $errors->has('msg_type')){
        toast($errors->first('msg'),$errors->first('msg_type'), 'top-center');
    }
@endphp
    <section class="d-flex justify-content-center mt-5">
        <div style="width: 500px;">
            <h2 class="text-secondary text-uppercase mb-3">Thêm người dùng 
                <i class="fa-sharp fa-solid fa-users-medical ms-1"></i>
            </h2>
            <form id="validation" class="needs-validation" action="{{ route('users.add') }}" method="POST" novalidate>
                <div class="mt-3">
                    <label for="fullname"
                        class="form-label fw-medium text-primary-emphasis d-flex align-items-baseline gap-2">
                        <i class="fa-sharp fa-light fa-user fw-medium"></i>
                        Họ Và Tên
                    </label>
                    <div class="input-group has-validation">
                        <input value="{{ old('fullname') }}" name="fullname" type="text"
                            class="form-control py-2 shadow @error('fullname') is-invalid @enderror" id="fullname"
                            aria-describedby="inputGroupPrepend" placeholder="Nhập họ và tên...">
                        @error('fullname')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mt-2">
                    <label for="email"
                        class="form-label fst-italic fw-medium text-primary-emphasis d-flex align-items-baseline gap-2">
                        <i class="fa-sharp fa-light fa-envelope fw-medium"></i>
                        Địa Chỉ Email
                    </label>
                    <div class="input-group has-validation">
                        <input value="{{ old('email') }}" name="email" type="text"
                            class="form-control py-2 shadow @error('email') is-invalid @enderror" id="email"
                            aria-describedby="inputGroupPrepend" placeholder="Nhập địa chỉ email...">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mt-2">
                    <label class="form-label fst-italic fw-medium text-primary-emphasis d-flex align-items-baseline gap-2"
                        for="">
                        Nhóm Người Dùng
                        <i class="fa-duotone fa-users"></i>
                    </label>
                    <div class="input-group has-validation">
                        <select name="group_id" class="form-select shadow @error('group_id') is-invalid @enderror">
                            <option value="">Chọn nhóm</option>
                            @if (!empty($allGroup))
                                @foreach ($allGroup as $group)
                                    <option {{ old('group_id') == $group->id ? 'selected' : false }}
                                        value="{{ $group->id }}">
                                        {{ $group->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('group_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mt-2">
                    <label class="form-label fst-italic fw-medium text-primary-emphasis d-flex align-items-baseline gap-2"
                        for="">
                        Trạng Thái
                        <i class="fa-solid fa-user-check"></i>
                    </label>
                    <select name="status" class="form-select shadow">
                        <option {{ old('status') == 0 ? 'selected' : false }} value="0">Chưa kích hoạt</option>
                        <option {{ old('status') == 1 ? 'selected' : false }} value="1">Kích hoạt</option>

                    </select>
                </div>
                <div class="mt-4">
                    <a class="btn btn-primary px-3 ms-2" href="{{ route('users.index') }}">Quay Lại
                        <i class="fa-light fa-arrow-rotate-left ms-1"></i>
                    </a>
                    <button type="submit" class="btn btn-success px-4">
                        Thêm Mới
                        <i class="fa-solid fa-paper-plane ms-1"></i>
                    </button>
                </div>
                @csrf
            </form>
        </div>
    </section>
@endsection
