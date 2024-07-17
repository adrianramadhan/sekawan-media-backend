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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('kendaraan_id')->constrained('kendaraan');
            $table->foreignId('driver_id')->constrained('drivers');
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            $table->text('tujuan');
            $table->enum('status', ['menunggu', 'disetujui_level1', 'disetujui_level2', 'ditolak', 'selesai']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
