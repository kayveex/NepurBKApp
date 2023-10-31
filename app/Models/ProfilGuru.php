<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilGuru extends Model
{
    use HasFactory;

    protected $table ='profil_guru';
    protected $primaryKey = 'id'; //Ini buat ngasih tau PrimaryKey nya namanya apa
    protected $fillable =['id','namaGuruBK', 'alamat','nomorWA','fotoGuruBK','ulangPassword','user_id'];
    // Mendeklrasikan Relasi 
    public function userFromGuru() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
