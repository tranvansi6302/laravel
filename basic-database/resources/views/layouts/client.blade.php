<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/clients/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/clients/css/all.min.css') }}">
    <title>@yield('title')</title>
</head>

<body>
    @include('clients.blocks.header')
    <main class="d-flex container-fluid mt-4">
        {{-- Muốn tùy chỉnh sidebar mỗi trang mỗi sidebar khác --}}
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <aside>
                        @section('sidebar')
                            @include('clients.blocks.sidebar')
                        @show
                    </aside>
                </div>
                <div class="col-9">
                    <div class="content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('clients.blocks.footer')
    <script src="{{ asset('assets/clients/js/bootstrap.min.js') }}"></script>
</body>

</html>
{{-- 
     Với @stack sẽ thêm mới khác với @section là thay thế
     Khi gọi dùng @push sẽ đẩy nội dung mới vào @stack lên trên, Dùng @prepend sẽ đẩy nội dung mới vào @stack xuống dưới --}}