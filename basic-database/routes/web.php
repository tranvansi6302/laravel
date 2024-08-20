<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RelationshipController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Response;

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
//  TODOS: Client Routes
Route::prefix('categories')->group(function () {
    // Danh sách chuyên mục
    Route::get('/', [CategoriesController::class, 'index'])->name('categories.list');
    // Danh sách chuyên mục (áp dụng show form sửa chuyên mục)
    Route::get('/edit/{id}', [CategoriesController::class, 'getCategory']);
    // Xử lí update chuyên mục
    Route::post('/edit/{id}', [CategoriesController::class, 'updateCategory'])->name('categories.edit');;
    // Hiển thị form add dữ liệu
    Route::get('/add', [CategoriesController::class, 'addCategory'])->name('categories.add');
    //  Xử lí thêm chuyên mục
    Route::post('/add', [CategoriesController::class, 'handleAddCategory']);
    // Xử lí xóa chuyên mục
    Route::delete('/delete/{id}', [CategoriesController::class, 'deleteCategory'])->name('categories.delete');
    Route::get('/upload', [CategoriesController::class, 'getFile']);
    Route::post('/upload', [CategoriesController::class, 'handleFile'])->name('categories.upload');
});

// TODOS: Admin Routes
Route::middleware('auth.admin')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    // TODOS: Routes resource
    Route::resource('products', ProductsController::class)->middleware('auth.admin.products');
});

// TODO: Views
// Render view trực tiếp trong Route
Route::get('/', function () {
    // Fake data
    // $title = 'Học lập trình Laravel';
    // $content = '<br> Học về View trong Laravel';
    // Nên đặt key cùng với dữ liệu
    // $dataView = [
    //     'title' => $title,
    //     'content' => $content
    // ];
    // return view('home', $dataView);
});

// Render view trong Controller
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/them-san-pham', [HomeController::class, 'getAdd']);
// Route::post('/them-san-pham', [HomeController::class, 'handleAdd']);
Route::put('/them-san-pham', [HomeController::class, 'handlePut']);

// TODO: Response

// Tự chuyển về chuỗi json khi truyền mảng
Route::get('demo-response', function () {
    return [
        'name' => 'Laravel',
        'version' => '8x'
    ];
});

// Lớp Response và helpers response -> helpers hổ trợ đầy đủ hơn
Route::get('demo-response', function () {
    // Tham số 1 nội dung, tham số 2 status code
    // $response = new Response('Học Laravel', 200);
    // $content = '<h2>Học Lập Trình</h2>';
    $content = json_encode(['item1', 'item2', 'item3']);
    // Gán thông tin header vào response
    $response = response($content, 200)->header('Content-Type', 'application/json');
    return $response;
});

// Gan cookie vào response
Route::get('demo-response', function () {
    // Đơn vị phút
    $response = (new Response())->cookie('laravel', 'Traning Laravel', 30);
    return $response;
});

Route::get('demo-response-2', function (Request $request) {
    return $request->cookie('laravel');
});

// Gán view trong response -> chỉ dùng được helpers
Route::get('demo-response-3', function () {
    // return view('clients.response');
    $response = response()
        ->view('clients.response', ['title' => 'Học Response'])
        ->header('Content-Type', 'application/json')
        ->header('API-Key', '123456');
    return $response;
});

// Trả về response dạng json có thể thêm được header, status code -> dùng hàm helpers
Route::get('demo-response-4', function () {
    $contentArr = [
        'name' => 'Laravel',
        'version' => '8x'
    ];
    return response()->json($contentArr, 201);
});

// Helpers chuyển hướng redirect
Route::get('demo-response-5', function () {
    return view('clients.response');
})->name('demo');

Route::post('demo-response-5', function (Request $request) {
    if (!empty($request->username)) {
        // return redirect('demo-response-5');
        // return redirect()->route('demo');
        // Nếu có tham số thì truyền vào đối số thứ 2 là một mảng
        // return redirect(route('demo'));

        // Trở về trang trước đó muốn lấy dữ liệu trước đó khi submit form -> withInput
        return back()->withInput()->with('message', 'Thành công');
    }
    // sử dụng với with khi muốn gửi thông báo sang dùng back hoặc redirect điều được
    return redirect(route('demo'))->with('message', 'Vui lòng nhập dữ liệu');
});

// Down ảnh
Route::get('download-img', [HomeController::class, 'downloadImg'])->name('download');

// Database
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UsersController::class, 'index'])->name('index');
    Route::get('/learn-relationship', [UsersController::class, 'relationship'])->name('learn-relationship');
    Route::get('add', [UsersController::class, 'getAdd'])->name('add');
    Route::post('add', [UsersController::class, 'handleAdd']);
    Route::get('edit/{id}', [UsersController::class, 'getEdit'])->name('edit');
    Route::post('update', [UsersController::class, 'handleUpdate'])->name('update');
    Route::get('delete/{id}', [UsersController::class, 'handleDelete'])->name('delete');
    Route::get('query-builder', [UsersController::class, 'learnQueryBuilder'])->name('query-builder');
});

// ORM
Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('/', [PostsController::class, 'index'])->name('index');
    Route::get('add', [PostsController::class, 'add'])->name('add');
    Route::get('update/{id}', [PostsController::class, 'update'])->name('update');
    Route::get('delete/{id}', [PostsController::class, 'delete'])->name('delete');
    Route::post('/delete-any', [PostsController::class, 'handleDeleteAny'])->name('delete-any');
    Route::get('/restore/{id}', [PostsController::class, 'restore'])->name('restore');
    Route::get('/force-delete/{id}', [PostsController::class, 'handleForceDelete'])->name('force-delete');
});

// relationship
Route::get('relationship', [RelationshipController::class, 'index']);
