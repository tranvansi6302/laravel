<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        // Nếu đăng nhập bằng tài khoản ban đầu thì hiển thị tất cả
        if (Auth::user()->user_id == 0) {
            $list = User::all(['*']);
            // Nếu dùng tài khoản khác thì chỉ hiện các tài khoản do tài khoản đó tạo
        } else {
            $list = User::where('user_id', $userId)->get();
        }
        return view('admin.users.list', compact('list'));
    }

    public function getAdd()
    {
        $groups = Group::all(['*']);
        return view('admin.users.add', compact('groups'));
    }

    public function handleAdd(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), $this->rules($request), $this->messages());
        if ($validator->fails()) {
            toast('Vui lòng kiểm tra lại dữ liệu nhập vào', 'warning');
        }
        $validator->validate();
        // Insert data
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->group_id = $request->group_id;
        $user->user_id = Auth::user()->id;
        $user->save();
        toast('Thêm dữ liệu thành công', 'success');
        return redirect()->route('admin.users.index');
    }

    public function getEdit(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $groups = Group::all(['*']);
        $request->session()->put('userId', $user->id);

        return view('admin.users.edit', compact('user', 'groups'));
    }

    public function handleUpdate(Request $request)
    {
        if (session('userId')) {
            $userId = session('userId');
        }
        $user = User::find($userId);
        $this->authorize('update', $user);
        $validator = Validator::make($request->all(), $this->rules($request), $this->messages());
        if ($validator->fails()) {
            toast('Vui lòng kiểm tra lại dữ liệu nhập vào', 'warning');
        }
        $validator->validate();

        if (!empty($user)) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->group_id = $request->group_id;
            $user->save();
            toast('Cập nhật dữ liệu thành công', 'success');
        } else {
            toast('Người dùng không tồn tại', 'warning');
        }
        $request->session()->remove('userId');
        return redirect()->route('admin.users.index');
    }

    public function handleDelete(User $user)
    {
        $this->authorize('delete', $user);
        if (Auth::user()->id != $user->id) {
            User::destroy($user->id);
            toast('Xóa dữ liệu thành công', 'success');
        } else {
            toast('Không thể xóa người dùng này', 'warning');
        }

        return redirect()->route('admin.users.index');
    }

    public function rules(Request $request)
    {
        $ruleEmail = ['required', 'email', 'unique:users,email'];
        $rulePassword = [];
        if (session('userId')) {
            $userId = session('userId');
            $ruleEmail = ['required', 'email', 'unique:users,email,' . $userId];
        }
        if ($request->routeIs('admin.users.post-add')) {
            $rulePassword = ['required', 'min:6'];
        }

        return [
            'name' => ['required', 'min:5'],
            'email' => $ruleEmail,
            'password' => $rulePassword,
            'group_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên bắt buộc phải nhập',
            'name.min' => 'Tên phải từ 5 ký tự trở lên',
            'email.required' => 'Email bắt buộc phải nhập',
            'email.email' => 'Email không hợp lệ',
            'password.required' => 'Mật khẩu bắt buộc phải nhập',
            'password.min' => 'Mật khẩu phải từ 6 ký tự trở lên',
            'email.unique' => 'Emal đã tồn tại trong hệ thống',
            'group_id.required' => 'Nhóm bắt buộc phải chọn',
        ];
    }
}
