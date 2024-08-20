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
        Schema::table('products', function (Blueprint $table) {
            $table->string('sku', 100)->unique(); // tạo field + đánh index unique
            $table->unique('name'); // đánh index unique cho field name trường hơp đánh nhiều dùng array
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // tenbang_tentruong_unique
            $table->dropUnique('products_sku_uniuqe');
            // $table->dropUnique('sku_uniue'); // tự đặt
            $table->dropUnique('products_name_uniuqe');
        });
    }
};
