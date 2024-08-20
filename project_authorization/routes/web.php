<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])
    ->middleware('guest')
    ->name('home');
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Đã gửi liên kết xác minh!');
})
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::prefix('posts')->name('posts.')->middleware('can:posts')->group(function () {
            Route::get('/', [PostController::class, 'index'])->name('index');
            Route::get('/add', [PostController::class, 'getAdd'])->name('getAdd')->can('posts.add');
            Route::post('/add', [PostController::class, 'handleAdd'])->name('add')->can('posts.add');
            // ->can('posts.edit') check có quyền vào hay không, còn trong controller check theo từng tài nguyên cụ thể
            Route::get('/edit/{post}', [PostController::class, 'getEdit'])->name('getEdit')->can('posts.edit');
            Route::post('/update', [PostController::class, 'handleUpdate'])->name('update')->can('posts.edit');
            Route::get('/delete/{post}', [PostController::class, 'handleDelete'])->name('delete')->can('posts.delete');
        });
        Route::prefix('groups')->name('groups.')->middleware('can:groups')->group(function () {
            Route::get('/', [GroupController::class, 'index'])->name('index');
            Route::get('/add', [GroupController::class, 'getAdd'])->name('getAdd')->can('groups.add');
            Route::post('/add', [GroupController::class, 'handleAdd'])->name('add')->can('groups.add');
            // ->can('groups.edit') check có quyền vào hay không, còn trong controller check theo từng tài nguyên cụ thể
            Route::get('/edit/{group}', [GroupController::class, 'getEdit'])->name('getEdit')->can('groups.edit');
            Route::post('/update', [GroupController::class, 'handleUpdate'])->name('update')->can('groups.edit');
            Route::get('/delete/{group}', [GroupController::class, 'handleDelete'])->name('delete')->can('groups.delete');
            Route::get('/permisssion/{group}', [GroupController::class, 'getPermission'])->name('getPermission')->can('groups.permission');
            Route::post('/permisssion/{group}', [GroupController::class, 'handlePermission'])->name('permission')->can('groups.permission');
        });

        Route::prefix('users')->name('users.')->middleware('can:users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/add', [UserController::class, 'getAdd'])->name('getAdd')->can('users.add');
            Route::post('/add', [UserController::class, 'handleAdd'])->name('add')->can('users.add');
            // ->can('users.edit') check có quyền vào hay không, còn trong controller check theo từng tài nguyên cụ thể
            Route::get('/edit/{user}', [UserController::class, 'getEdit'])->name('getEdit')->can('users.edit');
            Route::post('/update', [UserController::class, 'handleUpdate'])->name('update')->can('users.edit');
            Route::get('/delete/{user}', [UserController::class, 'handleDelete'])->name('delete')->can('users.delete');
        });
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
