<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jurusan_id', 
        'email', 
        'telepon', 
        'nip'
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}


