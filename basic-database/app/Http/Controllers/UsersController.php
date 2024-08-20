<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Phone;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    private $users;
    public function __construct()
    {
        $this->users = new Users();
    }

    public function index()
    {
        // Giống PDO PHP thuần
        // $allUsers = DB::select("SELECT * FROM users WHERE id>?",[1]);
        // $allUsers = DB::select("SELECT * FROM users WHERE email=:email", ['email' => 'sitranvan@gmail.com']);
        $title = 'Danh sách';
        $allUsers = $this->users->getAllUsers();
        return view('users.list', compact('title', 'allUsers'));
    }

    public function getAdd()
    {
        $title = 'Thêm người dùng';
        return view('users.add', compact('title'));
    }

    public function handleAdd(Request $request)
    {
        $request->validate([
            'fullname' => ['required', 'min:4'],
            'email' => ['required', 'email', 'unique:users']
        ], [
            'fullname.required' => 'Họ và tên bắt buộc phải nhập',
            'fullname.min' => 'Họ và tên phải từ :min kí tự',
            'email.required' => 'Địa chỉ email bắt buộc phải nhập',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'email.unique' => 'Địa chỉ email đã tồn tại'
        ]);
        // Thêm người dùng
        $dataInsert = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];
        $this->users->addUser($dataInsert);
        return redirect()->route('users.index')->with('msg', 'Thêm người dùng thành công');
    }

    // Cập nhật
    public function getEdit(Request $request, $id = 0)
    {
        $title = 'Sửa người dùng';
        if (!empty($id)) {
            // Kiểm tra id có tồn tại trong cơ sở dữ liệu
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail[0])) {
                $userDetail = $userDetail[0];
                // Lưu lại id vào session tránh các vấn đề liên quan đến bảo mật
                $request->session()->put('id', $id);
            } else {
                return redirect()->route('users.index')->with('msg', 'Người dùng không tồn tại');
            }
        } else {
            return redirect()->route('users.index')->with('msg', 'Liên kết không tồn tại');
        }
        return view('users.edit', compact('title', 'userDetail'));
    }

    public function handleUpdate(Request $request)
    {
        $id = session('id');
        if (empty($id)) {
            return back()->with('msg', 'Liên kết không tồn tại');
        }
        $request->validate([
            'fullname' => ['required', 'min:4'],
            'email' => ['required', 'email', 'unique:users,email,' . $id]
        ], [
            'fullname.required' => 'Họ và tên bắt buộc phải nhập',
            'fullname.min' => 'Họ và tên phải từ :min kí tự',
            'email.required' => 'Địa chỉ email bắt buộc phải nhập',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'email.unique' => 'Địa chỉ email đã tồn tại'
        ]);
        // Sửa người dùng
        $dataUpdate = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];
        $this->users->updateUser($dataUpdate, $id);
        return back()->with('msg', 'Sửa người dùng thành công');
    }

    public function handleDelete($id = 0)
    {
        $msg = '';
        if (!empty($id)) {
            // Kiểm tra id có tồn tại trong cơ sở dữ liệu
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail[0])) {
                $this->users->deleteUser($id);
                $msg = 'Xóa người dùng thành công';
            } else {
                $msg = 'Người dùng không tồn tại';
            }
        } else {
            $msg = 'Liên kết không tồn tại';
        }
        return redirect()->route('users.index')->with('msg', $msg);
    }

    public function learnQueryBuilder()
    {
        $this->users->queryBuilder();
    }

    public function relationship()
    {
        // $phone = Users::find(19)->phone;
        // $idPhone = $phone->id;
        // $phoneNumber = $phone->phone;

        // $phone = Users::find(19)->phone;
        // dd($phone);

        // Từ phone truy vấn ra user
        // $user = Phone::where('phone', '0333333333333')->first()->user;
        // dd($user);


        // TODO 1-n
        // $users = Group::find(1)->users;
        //  Muốn truy vấn tiếp thì gọi phương thức 
        $users = Group::find(1)->users()->where('id', '>', 45)->get();
        if ($users->count() > 0) {
            foreach ($users as $item) {
                echo $item->fullname . '<br>';
            }
        }
        //  từ user tìm ra group
        $group = Users::find(49)->group;
        dd($group);
    }
}
