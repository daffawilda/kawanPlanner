<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $table = 'jurusans';
    protected $fillable = ['nama', 'deskripsi'];
    
    // Relasi dengan model Guru
    public function gurus()
    {
        return $this->hasMany(Guru::class);
    }
    public function mataPelajarans()
    {
        return $this->hasMany(MataPelajaran::class);
    }
    public function soals()
    {
        return $this->hasMany(Soal::class);
    }


}
