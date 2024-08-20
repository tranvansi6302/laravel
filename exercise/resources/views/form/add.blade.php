@extends('layouts.main')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <section class="d-flex justify-content-center mt-5">
        <div style="width: 500px;">
            <h2 class="text-secondary text-uppercase mb-3">Validation
                <i class="fa-regular fa-octagon-check"></i>
            </h2>
            {{-- @if ($errors->any())
                <div class="alert alert-danger" style="padding: 12px 20px">
                    <i class="fa-sharp fa-solid fa-triangle-exclamation me-1"></i>
                    {{ $errorMessage }}
                </div>
            @endif --}}
            @error('msg')
                <div class="alert alert-danger" style="padding: 12px 20px">
                    <i class="fa-sharp fa-solid fa-triangle-exclamation me-1"></i>
                    {{ $message }}
                </div>
            @enderror
            <form id="validation" class="needs-validation" action="{{ route('validation') }}" method="POST" novalidate>
                <div class="mt-3">
                    <label for="username"
                        class="form-label fw-medium text-primary-emphasis d-flex align-items-baseline gap-2">
                        <i class="fa-sharp fa-light fa-user fw-medium"></i>
                        Username
                    </label>
                    <div class="input-group has-validation">
                        <input value="{{ old('username') }}" name="username" type="text"
                            class="form-control py-2 shadow @error('username') is-invalid @enderror" id="username"
                            aria-describedby="inputGroupPrepend" placeholder="Enter your username">
                        @error('username')
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
                        Email address
                    </label>
                    <div class="input-group has-validation">
                        <input value="{{ old('email') }}" name="email" type="text"
                            class="form-control py-2 shadow @error('email') is-invalid @enderror" id="email"
                            aria-describedby="inputGroupPrepend" placeholder="Enter your email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-success px-4">
                        Validation
                        <i class="fa-solid fa-paper-plane ms-1"></i>
                    </button>
                </div>
                @csrf
            </form>
        </div>
    </section>
@endsection
