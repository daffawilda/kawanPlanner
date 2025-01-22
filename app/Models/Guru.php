<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 
        'nip', 
        'email', 
        'no_tlp', 
        'jurusan_id',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
    public function mataPelajarans()
    {
    return $this->hasMany(MataPelajaran::class);
    }
}

