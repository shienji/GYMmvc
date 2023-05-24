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
            $table->increments('user_id');
            $table->string('user_email')->nullable();
            $table->string('user_nama')->nullable();
            $table->text('user_password')->nullable();
            $table->text('user_nik')->nullable();
            $table->date('user_tgllahir')->nullable();
            $table->string('user_nohp')->nullable();
            $table->string('user_alamat')->nullable();
            $table->string('user_role')->nullable();
            $table->string('user_status')->nullable()->default('Process');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
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
