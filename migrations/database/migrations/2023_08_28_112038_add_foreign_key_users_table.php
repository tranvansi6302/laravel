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
        Schema::table('users', function (Blueprint $table) {
            // Trường hợp muốn vô hiệu hóa khóa ngoại
            // Schema::enableForeignKeyConstraints();
            // Schema::disableForeignKeyConstraints();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tentable_tentruong_foreign
            $table->dropForeign('users_group_id_foreign');
        });
    }
};
