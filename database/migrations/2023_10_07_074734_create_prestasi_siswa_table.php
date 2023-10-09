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
        Schema::create('prestasi_siswa', function (Blueprint $table) {
            $table->id('id_prestasi');
            $table->year('tahunPencapaian');
            $table->enum('bidangPrestasi', ['akademik', 'non-akademik']);
            $table->text('deskripsi');
            $table->enum('tingkatPrestasi', ['lokal', 'regional', 'nasional', 'internasional']);
            $table->enum('posisiJuara', ['I', 'II', 'III', 'harapan']);
            $table->string('buktiPrestasi');
            // FOREIGN KEY - START
            $table->unsignedBigInteger('nomorSiswa');
            $table->foreign('nomorSiswa')->references('nomorSiswa')->on('profil_siswa');
            // END
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi_siswa');
    }
};
