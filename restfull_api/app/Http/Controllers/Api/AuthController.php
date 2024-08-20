<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Client;
use Laravel\Passport\TokenRepository;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $checkLogin =  Auth::attempt([
            'email' => $email,
            'password' => $password
        ]);
        if ($checkLogin) {
            $user = Auth::user();
            // $token = $user->createToken('auth_token')->plainTextToken;


            // Passport
            // $tokenResult = $user->createToken('auth_api');
            // Thiết lập expire
            // $token = $tokenResult->token;
            // $token->expire_at = Carbon::now()->addMinutes(60);

            // Trả về access token
            // $accessToken = $tokenResult->accessToken;
            // Trả về expire
            // $expires = Carbon::parse($token->expire_at)->toDateTimeString();


            // $response = [
            //     'status' => 200,
            //     'token' => $accessToken,
            //     'expires' => $expires
            // ];

            $client = Client::where('password_client', 1)->first();
            if ($client) {
                $clientSecret = $client->secret;
                $clientId = $client->id;
                $response = Http::asForm()->post('http://127.0.0.1:8001/oauth/token', [
                    'grant_type' => 'password',
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                    'username' => $email,
                    'password' => $password,
                    'scope' => '',
                ]);
            }
        }
        //  else {
        //     $response = [
        //         'status' => 401,
        //         'title' => 'Unauthorized'
        //     ];
        // }
        return $response;
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $status = $user->token()->revoke();
        $respose = [
            'status' => 200,
            'title' => 'Logout'
        ];

        return $respose;
    }

    public function getToken(Request $request)
    {
        $user = User::find(1);
        // $tokens = $user->tokens;
        // foreach ($tokens as $token) {
        //     echo $token;
        // }
        // Xóa tất cả
        // $user->tokens()->delete();

        // Xóa theo điều kiện
        // $user->tokens()->where('id', 6)->delete();

        // Xóa token hiện tại

        // $request->user()->currentAccessToken()->delete();
        return $request->user()->currentAccessToken();
    }

    public function refreshToken(Request $request)
    {
        // if ($request->header('authorization')) {
        //     $hashToken = $request->header('authorization');
        //     $hashToken = str_replace('Bearer', '', $hashToken);
        //     $hashToken = trim($hashToken);
        //     $token = PersonalAccessToken::findToken($hashToken);
        //     if ($token) {
        //         $tokenCreated = $token->created_at;
        //         $expire = Carbon::parse($tokenCreated)->addMinute(config('sanctum.expiration'));
        //         if (Carbon::now() >= $expire) {
        //             $userId = $token->tokenable_id;
        //             $user = User::find($userId);
        //             $user->tokens()->delete();

        //             $newToken =  $user->createToken('auth_token')->plainTextToken;
        //             $response = [
        //                 'status' => 200,
        //                 'token' => $newToken
        //             ];
        //         } else {
        //             $response = [
        //                 'status' => 200,
        //                 'title' => 'Unexpired'
        //             ];
        //         }
        //     } else {
        //         $response = [
        //             'status' => 401,
        //             'title' => 'Unauthorized'
        //         ];
        //     }
        //     return $response;
        // }

        // passport
        $client = Client::where('password_client', 1)->first();
        if ($client) {
            $clientSecret = $client->secret;
            $clientId = $client->id;
            $refreshToken = $request->refresh;
            $response = Http::asForm()->post('http://127.0.0.1:8001/oauth/token', [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'scope' => '',
            ]);
            return $response;
        }
    }
}
