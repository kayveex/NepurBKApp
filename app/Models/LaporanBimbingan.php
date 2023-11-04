<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBimbingan extends Model
{
    use HasFactory;
    protected $table = 'laporan_bimbingan';
    protected $primaryKey = 'id';
    protected $fillable =['kelas','semester','bidangLayanan','tanggalBimbingan','keluhan','solusi','tahunAjar_id','user_id','siswa_id'];
    // Mendeklarasikan Relasi
    public function tahunAjar() {
        return $this->belongsTo(TahunAjar::class, 'tahunAjar_id');
    }

    public function userAuthor() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function fromProfilSiswa()  {
        return $this->belongsTo(ProfilSiswa::class,'siswa_id');
    }
}
