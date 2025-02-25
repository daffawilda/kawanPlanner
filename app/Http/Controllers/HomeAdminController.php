<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\Soal;
use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    /**
     * Menampilkan jumlah data di halaman homeAdmin.
     */
    public function index()
    {
        $jumlahJurusan = Jurusan::count();
        $jumlahGuru = Guru::count();
        $jumlahMataPelajaran = MataPelajaran::count();
        $jumlahSoal = Soal::count();
        
        return view('homeAdmin', compact('jumlahJurusan', 'jumlahGuru', 'jumlahMataPelajaran', 'jumlahSoal'));
    }
}
