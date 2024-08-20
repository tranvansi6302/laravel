<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ValidationController;
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

// Validation
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('validation', [ValidationController::class, 'getValidation'])->name('validation');
Route::post('validation-v1', [ValidationController::class, 'handleValidationV1']);
Route::post('validation-v2', [ValidationController::class, 'handleValidationV2']);
Route::post('validation', [ValidationController::class, 'handleValidationV3']);

// CRUD
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UsersController::class, 'index'])->name('index');
    Route::get('add', [UsersController::class, 'displayAdd'])->name('add');
    Route::post('add', [UsersController::class, 'handleAddUser']);
    Route::get('edit/{id}', [UsersController::class, 'displayEdit'])->name('edit');
    Route::post('update', [UsersController::class, 'handleUpdateUser'])->name('update');
    Route::get('delete/{id}', [UsersController::class, 'handleDeleteUser'])->name('delete');
});
