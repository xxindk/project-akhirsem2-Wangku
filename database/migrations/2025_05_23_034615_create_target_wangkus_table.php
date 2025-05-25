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
        Schema::create('target_wangkus', function (Blueprint $table) {
            $table->id();
              $table->unsignedBigInteger('user_id');
            $table->string('nama_target');
            $table->unsignedBigInteger('jumlah_target');
            $table->unsignedBigInteger('jumlah_terkumpul')->default(0);
            $table->string('gambar')->nullable(); // URL atau path gambar
            $table->text('catatan')->nullable(); // opsional catatan
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target_wangkus');
    }
};
