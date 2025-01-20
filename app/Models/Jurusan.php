<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'deskripsi'];
    
    // Relasi dengan model Guru
    public function gurus()
    {
        return $this->hasMany(Guru::class);
    }

}
