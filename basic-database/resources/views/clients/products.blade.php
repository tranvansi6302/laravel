@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection
@section('sidebar')
    {{-- Muốn lấy luôn sidebar gốc từ masterlayout @parent --}}
    @parent
    <button class="btn btn-primary w-100 mt-2">Custom Products Sidebar</button>
@endsection
@section('content')
    <h1>Sản phẩm</h1>
@endsection
