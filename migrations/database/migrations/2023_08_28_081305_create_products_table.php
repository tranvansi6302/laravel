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
        Schema::create('products', function (Blueprint $table) {
            // $table->id(); // bigint, auto increment primary key, field=>id
            // Có thể tùy biến tên trường
            $table->increments(('id'));
            $table->string('name', 100); // varchar => tên trường, độ dài
            $table->text('description')->nullable(); // text và được phép null
            $table->timestamps(); // created_at và updated_at => timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
