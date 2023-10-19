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
        Schema::create('laporan_bimbingan', function (Blueprint $table) {
            $table->id();
            $table->enum('semester', ['ganjil', 'genap']);
            $table->enum('bidangLayanan', ['pribadi', 'sosial', 'belajar', 'karir']);
            $table->date('tanggalBimbingan');
            $table->text('keluhan');
            $table->text('solusi');
            // FOREIGN KEY - START
            $table->unsignedBigInteger('tahunAjar_id');
            $table->foreign('tahunAjar_id')->references('id')->on('tahun_ajar');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('siswa_id');
            $table->foreign('siswa_id')->references('id')->on('profil_siswa');

        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_bimbingan');
    }
};
