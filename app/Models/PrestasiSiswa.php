<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PrestasiSiswa extends Model
{
    use HasFactory;

    protected $table ='prestasi_siswa';
    protected $primaryKey = 'id'; //Ini buat ngasih tau PrimaryKey nya namanya apa
    protected $fillable =['tahunPencapaian', 'bidangPrestasi','deskripsi','tingkatPrestasi','posisiJuara','buktiPrestasi','siswa_id'];
    // Mendeklrasikan Relasi
    public function profilSiswa() {
        return $this->belongsTo(ProfilSiswa::class, 'siswa_id');
    }


}
