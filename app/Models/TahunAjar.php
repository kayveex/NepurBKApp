<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjar extends Model
{
    use HasFactory;

    protected $table ='tahun_ajar';
    protected $primaryKey = 'id'; //Ini buat ngasih tau PrimaryKey nya namanya apa
    protected $fillable =['tahun_ajar_siswa'];
    // Mendeklarasikan Relasi
    public function laporanBimbingan() {
        return $this->hasMany(LaporanBimbingan::class,'tahunAjar_id','id');
    }
}
