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
        Schema::create('reminders', function (Blueprint $table) {
            $table->id(); // Primary key
              $table->unsignedBigInteger('user_id');
            $table->string('jenis_tagihan'); // Contoh: Listrik, Air, Internet
            $table->unsignedBigInteger('nominal'); // Nominal tagihan (dalam angka)
            $table->date('jatuh_tempo'); // Tanggal jatuh tempo pembayaran
            $table->enum('status', ['Lunas', 'Belum Lunas']); // Status pembayaran
            $table->timestamps(); // created_at & updated_at
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};