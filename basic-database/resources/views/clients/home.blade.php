@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection
@section('sidebar')
    {{-- Muốn lấy luôn sidebar gốc từ masterlayout @parent --}}
    @parent
    {{-- Custom sidebar --}}
    <button class="btn btn-primary w-100 mt-2">Custom Home Sidebar</button>
@endsection
@section('content')
    <h1>Home Page</h1>
    {{-- @datetime('2022-12-22 12:12:12') --}}
    {{-- @env('local')
        <p>Môi trường DEV</p>
    @endenv --}}
    {{-- Cách gọi thông thường --}}
    <x-alert-message type='success' content='{{ $message }}' />
    {{-- Cách gọi với components --}}
    <x-alert-message type='success' :content="$message"/>


    <p class="w-100">
        <img width="100%" src="https://images2.thanhnien.vn/thumb_w/640/528068263637045248/2023/8/17/36851201311007551542185188660518616609121160n-16922689640741834939283.png" alt="">
        <a class="btn btn-primary mt-3" href="{{ route('download').'?image=https://images2.thanhnien.vn/thumb_w/640/528068263637045248/2023/8/17/36851201311007551542185188660518616609121160n-16922689640741834939283.png'}}">Down Image</a>
    </p>

@endsection
