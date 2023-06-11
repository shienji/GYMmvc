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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('transaksi_id');
            $table->integer('user_id')->nullable();
            $table->dateTime('transaksi_daftar')->nullable();
            $table->dateTime('transaksi_expired')->nullable();
            $table->string('transaksi_role')->nullable();
            $table->integer('transaksi_harga')->default(0);
            $table->integer('transaksi_bulan')->default(1);
            $table->string('transaksi_bukti1')->nullable();
            $table->string('transaksi_bukti2')->nullable();
            $table->string('transaksi_bukti3')->nullable();
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
        Schema::dropIfExists('transaksi');
    }
};
