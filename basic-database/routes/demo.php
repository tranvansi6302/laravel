<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*
Route::get('/', function () {
    return 'Home Page';
});

Route::get('login', function () {
    return view('form');
});

Route::post('login', function () {
    return 'Phương thức POST của path login';
});

Route::put('login', function () {
    return 'Phương thức PUT của path login';
});
Route::delete('login', function () {
    return 'Phương thức DELETE của path login';
});

Route::match(['get', 'post'], 'login', function () {
    return $_SERVER['REQUEST_METHOD'];
});

Route::any('login', function (Request $request) {
   return $request->method();
});
Route::get('show', function () {
    return view('form');
});

Route::redirect('login', 'show');

Route::view('show', 'form');

Route::prefix('admin')->group(function() {
    Route::get('login', function () {
        return 'Đây là phương thức GET của path login';
    })->name('admin.show');
    Route::get('show', function () {
        return view('form');
    });
    Route::prefix('products')->group(function() {
        Route::get('/', function () {
            return 'Danh sách sản phẩm';
        });
        Route::get('add', function () {
            return 'Thêm sản phẩm';
        });
        Route::get('delete', function () {
            return 'Xoa sản phẩm';
        });
        Route::get('edit', function () {
            return 'Sửa sản phẩm';
        });
    });
});

Route::get('users/{id?}', function ($id='') {
    return 'Id user: '.$id;
}); 

Route::get('news/{slug?}-{id?}', function ($slug=null, $id=null) {
    $content = '';
    $content .= 'Slug: ' . $slug . '<br>';
    $content .= 'id: ' . $id;
    return $content;
})->where([
    'slug' => '[a-z\-]+',
    'id' => '[0-9]+'
])->name('news');

Route::get('hello', function () {
    return 'Hello';
})->name('h');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return 'Home Page';
});
*/

