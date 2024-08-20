# Là thành phần cần thiết và không thể thiếu khi làm việc với các framework, nó giúp định tuyến các url path tương ứng với các Controller, Action, View, Command Line tương ứng hoặc với bắt kỳ công việc nào (trong phạm vi của framework đó)

## Các loại route trong laravel
- Route web: Khai báo trong routes/web.php
- Route api: Khai báo trong routes/api.php
- Route console: Khai báo trong routes/console.php
- Route channel: Khai báo trong routes/channel.php

## Các phương thức khai báo route/web
- Route::get($path, $callback): Nhận request với phương thức GET
- Route::post($path, $callback): Nhận request với phương thức POST
- Route::put($path, $callback): Nhận request với phương thức PUT
- Route::patch($path, $callback): Nhận request với phương thức PATCH
- Route::delete($path, $callback): Nhận request với phương thức DELETE
- Route::options($path, $callback): Nhận request với phương thức OPTIONS
- Route::match($methods,$path, $callback): Nhận request với nhiều phương thức trong mảng $methods
- Route::any($uri, $callback): Nhận request với tất cả các phương thức
- Route::redirect($path, $redirect, $status):  Nhận request sau đó chuyển hướng
- Route::view($path, $viewName, $data): Nhận request sau đó render view
- Route::prefix('path-prefix') -> group($callback): Nhóm các route với các prefix xác định
- Route::get('path/parameter', $callback): Lấy tham số tự động trên url
- Route::get('path/parameter', $callback) -> where('parameter', $pattern): Ràng buộc tham số với biểu thức chính quy
- Route::get($path, $callback) -> name('name_route'): Đặt tên cho route để thuận lợi cho việc đặt tên sau này
- route($name, $params): Hàm tạo url từ tên route
- Route::middleware($name) -> group($callback): Thiết lập middleware cho route (Áp dụng với group)
- Route::domain('{subdomain}.tvs.vn') -> group($callback): Xử lí request với tên miền phụ (subdomain)
