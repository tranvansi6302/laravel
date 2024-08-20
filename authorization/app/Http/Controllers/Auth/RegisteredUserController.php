<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
            'password_confirmation' => ['required', 'same:password']
        ], [
            'required' => ':attribute bắt buộc phải nhập',
            'string' => ':attribute phải là chuỗi ký tự',
            'max' => ':attribute không được lớn hơn :max ký tự',
            'email' => ':attribute không đúng định dạng',
            'min' => ':attribute phải từ :min ký tự',
            'unique' => ':attribute đã được sử dụng',
            'same' => 'attribute: phải giống mật khẩu'
        ], [
            'name' => 'Họ tên',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'password_confirmation' => 'Nhập lại mật khẩu'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Tự động login
        Auth::login($user);

        return redirect(RouteServiceProvider::ADMIN);
        // return redirect()->route('register')->with('msg', 'Đăng ký tài khoản thành công');
    }
}
