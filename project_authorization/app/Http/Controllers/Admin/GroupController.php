<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        // Nếu đăng nhập bằng tài khoản ban đầu thì hiển thị tất cả
        if (Auth::user()->user_id == 0) {
            $list = Group::all(['*']);
            // Nếu dùng tài khoản khác thì chỉ hiện các tài khoản do tài khoản đó tạo
        } else {
            $list = Group::where('user_id', $userId)->get();
        }
        return view('admin.groups.list', compact('list'));
    }

    public function getAdd()
    {
        return view('admin.groups.add');
    }

    public function handleAdd(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());
        if ($validator->fails()) {
            toast('Vui lòng kiểm tra lại dữ liệu nhập vào', 'warning');
        }
        $validator->validate();
        $group = new Group();
        $group->name = $request->name;
        $group->user_id = Auth::user()->id;
        $group->save();
        toast('Thêm dữ liệu thành công', 'success');
        return redirect()->route('admin.groups.index');
    }

    public function getEdit(Request $request, Group $group)
    {
        $this->authorize('update', $group);

        $request->session()->put('groupId', $group->id);
        return view('admin.groups.edit', compact('group'));
    }

    public function handleUpdate(Request $request)
    {
        if (session('groupId')) {
            $groupId = session('groupId');
        }
        $group = Group::find($groupId);
        $this->authorize('update', $group);
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());
        if ($validator->fails()) {
            toast('Vui lòng kiểm tra lại dữ liệu nhập vào', 'warning');
        }
        $validator->validate();

        if (!empty($group)) {
            $group->name = $request->name;
            $group->save();
            toast('Cập nhật dữ liệu thành công', 'success');
        } else {
            toast('Nhóm không tồn tại', 'warning');
        }
        return redirect()->route('admin.groups.index');
    }

    public function handleDelete(Group $group)
    {
        $this->authorize('delete', $group);

        // Kiểm tra ràng buộc nếu trong nhóm không còn người dùng mới tiến hành xóa
        if ($group->user->count() == 0) {
            Group::destroy($group->id);
            toast('Xóa dữ liệu thành công', 'success');
        } else {
            toast('Vẫn còn người dùng trong nhóm', 'warning');
        }
        return redirect()->route('admin.groups.index');
    }

    public function getPermission(Group $group)
    {
        $this->authorize('permission', $group);
        $modules = Module::all(['*']);
        $roleJson = $group->permission;
        if (!empty($roleJson)) {
            $roleArray = json_decode($roleJson, true);
        } else {
            $roleArray = [];
        }
        $roleListArray = [
            'view' => 'Xem',
            'add' => 'Thêm',
            'edit' => 'Sửa',
            'delete' => 'Xóa',
        ];
        return view('admin.groups.permission', compact('group', 'modules', 'roleListArray', 'roleArray'));
    }

    public function handlePermission(Request $request, Group $group)
    {
        $this->authorize('permission', $group);
        if ($request->all()) {
            $roleArray = $request->role;
        } else {
            $roleArray = [];
        }
        $roleJson = json_encode($roleArray);
        $group->permission = $roleJson;
        $group->save();
        toast('Phân quyền thành công', 'success');
        return back();
    }
    public function rules()
    {
        $ruleName = ['required', 'unique:groups,name'];
        if (session('groupId')) {
            $groupId = session('groupId');
            $ruleName = ['required', 'unique:groups,name,' . $groupId];
        }
        return [
            'name' => $ruleName,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên nhóm bắt buộc phải nhập',
            'name.unique' => 'Tên nhóm đã tồn tại trong hệ thống',
        ];
    }
}
