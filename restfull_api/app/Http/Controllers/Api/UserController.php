<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $allUser = User::all();
        if ($allUser->count() > 0) {
            $statusCode = 200;
            $statusText = 'success';
        } else {
            $statusCode =  204;
            $statusText = 'No Data';
        }
        return new UserCollection($allUser, $statusCode, $statusText);
    }

    public function detail($id)
    {
        $user = User::with('posts')->find($id);
        if (!$user) {
            $statusCode = 404;
            $statusText = 'Not Found';
            $data = [];
        } else {
            $statusCode = 200;
            $statusText = 'success';
            $data = new UserResource($user);
        }
        $response = [
            'status' => $statusCode,
            'title' => $statusText,
            'data' => $data
        ];
        return $response;
    }
}
