<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';
    public function getAllUser($filters = [], $keyword = null, $sortArr = [], $perPage = 0)
    {
        $users = DB::table($this->table)
            ->select('users.*', 'groups.name AS group_name')
            ->join('groups', 'users.group_id', '=', 'groups.id');

        $orderBy = 'users.create_at';
        $orderType = 'desc';
        if (!empty($sortArr)) {
            if (!empty($sortArr['sortBy']) && !empty($sortArr['sortType'])) {
                $orderBy = trim($sortArr['sortBy']);
                $orderType = trim($sortArr['sortType']);
            }
        }
        $users = $users->orderBy($orderBy, $orderType);

        if (!empty($filters)) {
            $users = $users->where($filters);
        }
        // Vì search là trường hợp đặt biệt bên trong có or
        if (!empty($keyword)) {
            $users = $users->where(function ($query) use ($keyword) {
                $query->orWhere('fullname', 'like', '%' . $keyword . '%');
            });
        }

        // Phân trang thay thế get
        if (!empty($perPage)) {
            $users = $users->paginate($perPage);  // perPage bản ghi trên một trang
        } else {
            $users = $users->get();
        }

        return $users;
    }

    public function addUser($data = [])
    {
        return DB::table($this->table)->insert($data);
    }

    public function updateUser($data = [], $id = 0)
    {
        return DB::table($this->table)->where('id', $id)->update($data);
    }
    public function deleteUser($id)
    {
        return DB::table($this->table)->where('id', $id)->delete();
    }

    public function detailUser($id = 0)
    {
        return DB::table($this->table)->where('id', $id)->first();
    }
}
