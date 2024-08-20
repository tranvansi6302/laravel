<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    // Xóa mềm thêm trường deleted_at kiểu timestamp và use SoftDeletes
    // Khi đã thực hiện 2 bước trên thì khi xóa thông thường nó sẽ được chuyển vào thùng rác và deleted_at sẽ lưu lại
    use SoftDeletes;
    // Nếu table không đặt đúng quy ước thì khai báo protected $table
    protected $table = 'posts';
    // Cấu hình khóa chính (mặc định laravel quy định trường id là khóa chính tuy nhiên ta có thể thay đổi)
    protected $primaryKey = 'id';
    // Khóa chính không phải auto increment và không thuộc kiểu số thì ta có thể khai báo thêm
    public $incrementing = false;
    protected $keyType = 'string';

    // Cấu hình timestamp, mặc định laravel sẽ ngầm hiểu table có sẵn 2 trường created_at và updated_at nếu không có sẽ lỗi
    // Nếu muốn bỏ ràng buộc này
    // public $timestamps = false;

    // trường hợp muốn đổi 2 tên trường mặc định
    // const CREATED_AT = 'ten moi';

    // Cấu hình giá trị mặc định
    // protected $attrubutes = [
    //     'status' => 0
    // ];

    // TODO insert update ràng buộc
    protected $fillable = ['title', 'content', 'status'];
}
