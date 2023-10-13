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
        Schema::create('profil_siswa', function (Blueprint $table) {
            $table->id('nomorSiswa');
            $table->string('namaSiswa');
            $table->integer('tahunMasuk');
            $table->integer('tahunLulus');
            // START - EDIT SESUAI SEKOLAH !
            $table->enum('jurusan',['TKJ','DPIB', 'TITL', 'TKRO','TPM', 'T.ELIN', 'TSM', 'TAV', 'IOP']);
            // END
            $table->date('tgl_lahir');
            $table->string('fotoSiswa');
            // Foreign Key Section - START
            $table->unsignedBigInteger('id');
            $table->foreign('id')->references('id')->on('users');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_siswa');
    }
};
