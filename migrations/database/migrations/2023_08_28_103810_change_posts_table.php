<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /**
         * Trường hợp muốn xóa bỏ default, comment thì tạo migration mới và truyền tham số vào có thể là null hoặc false sau đó gọi tới ->change();
         * Nhưng sẽ bị lỗi duplicate -> phải thông qua packet composer require doctrine/dbal
         * Thay đổi thuộc tính ->string('name)->change();
         * Thay đổi tên cột $table->renameColumn('old','new');
         * Xóa cột $table->dropColumn(['col1','col2','col3']
         */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
