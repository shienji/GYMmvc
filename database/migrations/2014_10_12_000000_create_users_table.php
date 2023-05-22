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
        Schema::create('user', function (Blueprint $table) {
            $table->integer('user_id')->primary();
            $table->string('user_nama')->nullable();
            $table->text('user_password')->nullable();
            $table->string('user_role')->nullable();
            $table->text('user_nik')->nullable();
            $table->date('user_tgllahir')->nullable();
            $table->string('user_nohp')->nullable();
            $table->string('user_email')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
