<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProfilSiswa extends Model
{
    use HasFactory;

    protected $table ='profil_siswa';
    protected $primaryKey = 'id'; //Ini buat ngasih tau PrimaryKey nya namanya apa
    protected $fillable =['id','namaSiswa', 'tahunMasuk','tahunLulus','jurusan','tgl_lahir','fotoSiswa','ulangPassword','user_id'];
    // Mendeklarasikan Relasi
    public function userFromSiswa() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function prestasiSiswas(): HasMany {
        return $this->hasMany(PrestasiSiswa::class,'siswa_id');
    } 

}
