<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $fillable = [
        'pertanyaan', 
        'jurusan_id',
        'jawaban_ya_id', 
        'jawaban_tidak_id'
    ];

    // Relasi dengan Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }
  
    // Relasi dengan MataPelajaran untuk jawaban_ya
    public function jawaban_ya()
    {
        return $this->belongsTo(MataPelajaran::class, 'jawaban_ya_id');
    }

    // Relasi dengan MataPelajaran untuk jawaban_tidak
    public function jawaban_tidak()
    {
        return $this->belongsTo(MataPelajaran::class, 'jawaban_tidak_id');
    }
}
