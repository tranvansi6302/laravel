<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\TokenRepository;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/{product}', [ProductController::class, 'detail'])->name('detail');
    Route::post('/', [ProductController::class, 'create'])->name('create');
    Route::put('/{product}', [ProductController::class, 'update'])->name('update_put');
    Route::patch('/{product}', [ProductController::class, 'update'])->name('update_patch');
    Route::delete('/{product}', [ProductController::class, 'delete'])->name('delete');
});
// sanctum: auth:sanctum, passport: auth:api
Route::prefix('users')->name('users.')->middleware('auth:api')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/{user}', [UserController::class, 'detail'])->name('detail');
});


Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::get('token', [AuthController::class, 'getToken'])->middleware('auth:sanctum');
// Không có middleware('auth:sanctum') vì có trong số trường hợp hết hạn sẽ bị chặn không cho vào
Route::post('refresh-token', [AuthController::class, 'refreshToken']);

Route::get('passport-token', function () {
    // $user = User::find(1);
    // $tokenResult = $user->createToken('auth_api');

    // // Thiết lập expire
    // $token = $tokenResult->token;
    // $token->expire_at = Carbon::now()->addMinutes(60);

    // // Trả về access token
    // $accessToken = $tokenResult->accessToken;

    // // Trả về expire
    // $expires = Carbon::parse($token->expire_at)->toDateTimeString();

    // $response = [
    //     'access_token' => $accessToken,
    //     'expires' => $expires
    // ];
    // return $response;

});
