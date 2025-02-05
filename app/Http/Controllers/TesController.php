<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\GeminiService;


class TesController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::all();
        // Menampilkan halaman tes
        return view('tes.index', compact('jurusans'));
    }
    // Menampilkan halaman soal sesuai jurusan yang dipilih
    public function showTes($jurusanId)
    {
        // Ambil data jurusan berdasarkan ID
        $jurusan = Jurusan::findOrFail($jurusanId);

        // Ambil soal yang terkait dengan jurusan
        $soals = Soal::where('jurusan_id', $jurusanId)->get();

        // Kirim data jurusan dan soal ke view
        return view('tes.show', compact('jurusan', 'soals'));
    }

    // Menyimpan jawaban tes dan menghitung hasilnya
    public function storeTes(Request $request, GeminiService $geminiService)
    {
        // Validasi input jawaban
        $data = $request->validate([
            'soals' => 'required|array',
            'soals.*.jawaban' => 'required|in:ya,tidak',
        ]);

        // Ambil data jurusan yang dipilih
        $jurusan = Jurusan::find($request->input('jurusan_id'));
        // Ambil soal berdasarkan ID yang dikirimkan
        $soals = Soal::whereIn('id', array_keys($data['soals']))->get();
        $mapelCount = [];

        // Proses untuk menghitung mata pelajaran yang dipilih berdasarkan jawaban
        foreach ($soals as $soal) {
            $jawaban = $data['soals'][$soal->id]['jawaban'];
            $mapel = ($jawaban == 'ya') ? $soal->jawaban_ya : $soal->jawaban_tidak;

            // Hitung jumlah pemilihan setiap mata pelajaran
            if (isset($mapelCount[$mapel->nama])) {
                $mapelCount[$mapel->nama]++;
            } else {
                $mapelCount[$mapel->nama] = 1;
            }
        }

        // Menghitung persentase untuk setiap mata pelajaran
        $total = array_sum($mapelCount);
        foreach ($mapelCount as $mataPelajaran => $count) {
            $mapelCount[$mataPelajaran] = ($count / $total) * 100;
        }
        arsort($mapelCount);

        // **Pastikan `$alasan` dideklarasikan sebelum digunakan**
        // Gunakan GeminiService untuk membuat alasan pemilihan mata pelajaran
        $alasan = [];
        foreach ($mapelCount as $mataPelajaran => $percentage) {
            $alasan[$mataPelajaran] = $geminiService->generateReason($mataPelajaran, $percentage);
        }
        
      
        // Kirim data hasil tes ke view hasil
        return view('tes.hasil', compact('jurusan', 'mapelCount','alasan'));
    }

    public function showHasil(Request $request, GeminiService $geminiService)
    {
    // Mengambil data jawaban pengguna dan jurusan yang dipilih
    $jurusanId = $request->input('jurusan_id');
    $soals = Soal::where('jurusan_id', $jurusanId)->get();

    $mapelCount = [];
    
    // Menghitung jumlah jawaban "Ya" dan "Tidak" untuk setiap mata pelajaran
   foreach ($soals as $soal) {
        $jawaban = ($request->input('jawaban_' . $soal->id) == 'ya') ? $soal->jawaban_ya : $soal->jawaban_tidak;
        $mapelCount[$jawaban->nama] = isset($mapelCount[$jawaban->nama]) ? $mapelCount[$jawaban->nama] + 1 : 1;
    }

    // Menghitung persentase untuk setiap mata pelajaran
    $totalJawaban = array_sum($mapelCount);
    foreach ($mapelCount as $mataPelajaran => $count) {
        $mapelCount[$mataPelajaran] = ($count / $totalJawaban) * 100;
    }

    // Urutkan berdasarkan persentase tertinggi
    arsort($mapelCount);

    // **Pastikan `$alasan` dideklarasikan sebelum digunakan**
    // Gunakan GeminiService untuk membuat alasan pemilihan mata pelajaran
    $alasan = [];
    foreach ($mapelCount as $mataPelajaran => $percentage) {
        $alasan[$mataPelajaran] = $geminiService->generateReason($mataPelajaran, $percentage);
    }
    dd($alasan);
    // Mengambil jurusan untuk ditampilkan di hasil
    $jurusan = Jurusan::find($jurusanId);

    // **Pastikan `$alasan` dikirim ke view**
    return view('tes.hasil', compact('jurusan', 'mapelCount', 'alasan'));
}


}
