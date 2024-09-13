<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // เพิ่มคอลัมน์ personality_id
            $table->unsignedBigInteger('personality_id')->nullable();

            // ตั้งค่า foreign key ให้เชื่อมกับ personality_types
            $table->foreign('personality_id')->references('id')->on('personality_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // ลบ foreign key และคอลัมน์ personality_id
            $table->dropForeign(['personality_id']);
            $table->dropColumn('personality_id');
        });
    }
};
