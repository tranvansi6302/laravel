@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <h1>Thêm sản phẩm</h1>
    <form action="" method="POST">
        <div class="mt-4">
            <label class="form-label" for="">Tên sản phẩm</label>
            <input class="form-control" type="text" name="product_name" placeholder="Enter your name...">
        </div>
        <button class="btn btn-success px-5 mt-4">Submit</button>
        @csrf
        @method('PUT')
    </form>
@endsection
