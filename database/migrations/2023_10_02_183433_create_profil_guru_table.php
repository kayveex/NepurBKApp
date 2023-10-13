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
        Schema::create('profil_guru', function (Blueprint $table) {
            $table->id('id_guru');
            $table->string('namaGuruBK', 45);
            $table->string('alamat', 45);
            $table->string('nomorWA', 32);
            $table->text('fotoGuruBK');

            // Foreign Key Section - START
            $table->unsignedBigInteger('id');
            $table->foreign('id')->references('id')->on('users');
            // END
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_guru');
    }
};
