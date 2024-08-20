<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $users;
    const _PER_PAGE = 5;
    public function __construct()
    {
        $this->users = new Users();
    }
    public function index(Request $request)
    {
        $title = 'Danh sách người dùng';
        $allGroup = getAllGroup();
        $filters = [];
        $keyword = null;
        // Lọc theo status
        if (!empty($request->status)) {
            $status = $request->status == 'active' ? 1 : 0;
            $filters[] = ['users.status', '=', $status];
        }
        // Lọc theo nhóm
        if (!empty($request->group_id)) {
            $groupId = $request->group_id;
            $filters[] = ['users.group_id', '=', $groupId];
        }
        // Tìm kiếm
        if (!empty($request->keyword)) {
            $keyword = $request->keyword;
        }

        // Xử lí sắp xếp
        $sortBy = $request->input('sort-by');
        $allowSort = ['asc', 'desc'];
        $sortType = $request->input('sort-type');
        if (!empty($sortType) && in_array($sortType, $allowSort)) {
            $sortType = $sortType == 'desc' ? 'asc' : 'desc';
        } else {
            $sortType = 'asc';
        }

        $sortArr = [
            'sortBy' => $sortBy,
            'sortType' => $sortType,
        ];

        $allUser = $this->users->getAllUser($filters, $keyword, $sortArr, self::_PER_PAGE);
        return view('users.list', compact('title', 'allUser', 'sortType', 'allGroup'));
    }

    public function displayAdd()
    {
        $title = 'Thêm người dùng';
        $allGroup = getAllGroup();
        return view('users.add', compact('title', 'allGroup'));
    }

    public function handleAddUser(UsersRequest $request)
    {
        $dataInsert = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'status' => $request->status,
        ];
        $statusInsert = $this->users->addUser($dataInsert);
        if ($statusInsert) {
            toast('Thêm người dùng thành công', 'success', 'top-center');
        } else {
            toast('Thêm thất bại, thử lại sau', 'error', 'top-center');
        }
        return redirect()->route('users.index');
    }

    public function displayEdit(Request $request, $id)
    {
        $title = 'Sửa người dùng';
        $allGroup = getAllGroup();
        if (!empty($id)) {
            $userDetail = $this->users->detailUser($id);
            if (!empty($userDetail)) {
                $request->session()->put('id', $id);
            } else {
                return redirect()
                    ->route('users.index')
                    ->with([
                        'msg' => 'Người dùng không tồn tại trong hệ thống',
                        'msg_type' => 'error',
                    ]);
            }
        } else {
            return redirect()
                ->route('users.index')
                ->with([
                    'msg' => 'Liên kết không tồn tại',
                    'msg_type' => 'error',
                ]);
        }
        return view('users.edit', compact('title', 'allGroup', 'userDetail'));
    }
    public function handleUpdateUser(UsersRequest $request)
    {
        $id = session('id');
        $dataUpdate = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'status' => $request->status,
        ];
        $updateStatus = $this->users->updateUser($dataUpdate, $id);
        if ($updateStatus) {
            $msg = 'Cập nhật người dùng thành công';
            $msg_type = 'success';
        } else {
            $msg = 'Đã xảy ra lỗi, vui lòng thử lại sau';
            $msg_type = 'error';
        }
        return redirect()
            ->route('users.index')
            ->with([
                'msg' => $msg,
                'msg_type' => $msg_type,
            ]);
    }
    public function handleDeleteUser($id)
    {
        if (!empty($id)) {
            $userDetail = $this->users->detailUser($id);
            if ($userDetail) {
                $deleteStatus = $this->users->deleteUser($id);
                if ($deleteStatus) {
                    $msg = 'Xóa người dùng thành công';
                    $msg_type = 'success';
                } else {
                    $msg = 'Xóa người dùng thất bại, thử lại sau';
                    $msg_type = 'error';
                }
            } else {
                $msg = 'Người dùng không tồn tại trong hệ thống';
                $msg_type = 'error';
            }
        } else {
            $msg = 'Liên kết không tồn tại';
            $msg_type = 'error';
        }
        return redirect()
            ->route('users.index')
            ->with([
                'msg' => $msg,
                'msg_type' => $msg_type,
            ]);
    }
}
