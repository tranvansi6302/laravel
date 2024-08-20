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
        // Cập nhật thêm cột permission
        Schema::table('groups', function (Blueprint $table) {
            $table->text('permission')->nullable();
            $table->text('desciption')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    // Thêm vào để khi rollback nó sẽ xóa cho chúng ta
    public function down(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn('permission');
        });
    }
};
