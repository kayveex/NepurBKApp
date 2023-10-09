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
            $table->id('id_laporanBimbingan');
            $table->enum('semester', ['ganjil', 'genap']);
            $table->enum('bidangLayanan', ['pribadi', 'sosial', 'belajar', 'karir']);
            $table->date('tanggalBimbingan');
            $table->text('keluhan');
            $table->text('solusi');
            // FOREIGN KEY - START
            $table->unsignedBigInteger('id_tahunAjar');
            $table->foreign('id_tahunAjar')->references('id_tahunAjar')->on('tahun_ajar');

            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')->references('id_users')->on('users');

        
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
