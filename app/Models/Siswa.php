<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswas';

    protected $fillable = [
        'nisn','alamat','id_kelas','id_angkatan','id_user'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class, 'id_angkatan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
