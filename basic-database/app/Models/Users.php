<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';

    public function phone()
    {
        return $this->hasOne(
            Phone::class,
            'user_id', // cửa phone
            'id' // của user
        );
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function getAllUsers()
    {
        return DB::select('SELECT * FROM ' . $this->table . '');
    }
    public function addUser($data = [])
    {
        DB::insert('INSERT INTO ' . $this->table . '(fullname, email, create_at) VALUES (?,?,?)', $data);
    }

    public function getDetail($id = 0)
    {
        return DB::select('SELECT * FROM ' . $this->table . ' WHERE id=?', [$id]);
    }

    public function updateUser($data, $id)
    {
        $data = array_merge($data, [$id]);
        return DB::update('UPDATE ' . $this->table . ' SET fullname=?,email=?,update_at=?  WHERE id=?', $data);
    }

    public function deleteUser($id)
    {
        return DB::delete('DELETE FROM ' . $this->table . ' WHERE id = ?', [$id]);
    }

    public function queryBuilder()
    {
        // TODO Lấy tất cả bản ghi
        $allUsers = DB::table($this->table)->get();
        // TODO Lấy một bản ghi đầu tiên
        $detail = DB::table($this->table)->first();
        // TODO Select một cột trong bảng 
        $list = DB::table($this->table)->select('id', 'fullname', 'email')
            // TODO Kết hợp and
            // ->where('id', '=', '2')
            // ->where('id', '>', '2')
            // ->where('id', '<', '5')
            // TODO kết hợp or
            // ->where('id', '>', '2')
            // ->orWhere('id', '<', '3')

            // TODO Muốn gom nhóm biểu thức () dùng closure 
            // ->where('id', '2')
            // ->where(function ($query) {
            //     $query->where('id', '<', '5')->orWhere('id', '>', '5');
            // })

            // TODO tìm kiếm
            // ->where('fullname', 'like', '%đỗ%')

            // TODO truy vấn khoảng
            // ->whereBetween('id', [1, 5])
            // TODO truy vấn không khoảng
            // ->whereNotBetween('id', [1, 5])
            // TODO toán tử in
            // ->whereIn('id', [1, 5])
            // TODO toán tử not in
            // ->whereNotIn('id', [1, 5])
            // TODO toán tử null, not null
            // ->whereNull('update_at')

            // TODO truy vấn date
            // ->whereDate('create_at', '2023-08-19')
            // TODO truy vấn theo tháng, day, year 
            // ->whereMonth('create_at', '02')
            // ->whereYear('create_at','2023')
            // TODO so sánh 2 cột có giá trị bằng nhau trả về một giá trị
            // ->whereColumn('create_at', 'update_at')
            ->get();

        // TODO JOIN bảng
        $join = DB::table($this->table)
            ->select('users.*', 'groups.name AS group_name')
            ->join('groups', 'users.group_id', '=', 'groups.id')
            // TODO LEFT JOIN RIGHT JOIN tương tự leftJoin(), rightJoin()
            ->get();


        $sort = DB::table($this->table)
            // TODO Sắp xếp, nhiều cột ->orderBy()->orderBy()
            // ->orderBy('id', 'desc')
            // TODO Sắp xếp ngẫu nhiên
            // ->inRandomOrder()
            ->get();
        // TODO Truy vấn theo nhóm groupBy, having
        $list = DB::table($this->table)
            // TODO đếm các email bị trùng
            ->select(DB::raw('COUNT(id) AS email_count'), 'email')
            ->groupBy('email')
            ->having('email_count', '>=', '1')
            ->get();

        // TODO limit offset
        $list = DB::table($this->table)
            // ->limit(2)
            // ->offset(2)
            // TODO hoặc dùng skip và take
            // ->skip(2)
            // ->take(2)
            ->get();


        // TODO thêm
        // $status = DB::table($this->table)->insert([
        //     'fullname' => 'Nguyen Van A',
        //     'email' => 'vana@gmail.com',
        //     'group_id' => 2,
        //     'create_at' => date('Y-m-d H:i:s')
        // ]);

        // TODO sửa
        // $status = DB::table($this->table)
        // Không có where cập nhật tất cả
        //     ->where('id', 7)
        //     ->update([
        //         'fullname' => 'Nguyen Van B',
        //         'update_at' => date('Y-m-d H:i:s')
        //     ]);

        // TODO xóa
        // DB::table($this->table)
        // Không có where xóa tất cả
        // ->where('id', 7)->delete();


        // TODO đếm số bản ghi
        $count = DB::table($this->table)->where('id', '>', 1)->count();


        // TODO DB raw query giúp đưa câu lệnh SQL vào
        // $list = DB::table($this->table)->select(DB::raw('COUNT(*)'))->get();

        $list = DB::table($this->table)
            // TODO select raw
            // ->selectRaw('fullname as ten')
            // TODO where raw
            // ->whereRaw('id>2')
            // TODO order by raw
            // ->orderByRaw('create_at DESC','update_at ASC)
            // TODO group by raw
            // ->groupByRaw('email','fullname'
            // TODO having draw
            // ->havingRaw('COUNT(id) > ?', [2])
            // TODO subquery
            ->select('email', DB::raw('(SELECT COUNT(id) FROM groups) AS group_count'))
            ->get();

        // TODO ngoài ra còn một số hàm max, min...
        dd($list);
    }
}
