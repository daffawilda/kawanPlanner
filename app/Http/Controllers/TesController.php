<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use app\Http\Controllers\GeminiService;
use App\Services\GeminiService as ServicesGeminiService;

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
    public function storeTes(Request $request, ServicesGeminiService $geminiService )
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
        $totalJawaban = array_sum($mapelCount);
        
        foreach ($mapelCount as $mataPelajaran => $count) {
            $mapelCount[$mataPelajaran] = ($count / $totalJawaban) * 100;
            $alasan[$mataPelajaran] = $geminiService->generateReason($mataPelajaran, $mapelCount[$mataPelajaran]);

        }
        arsort($mapelCount);

        // **Pastikan `$alasan` dideklarasikan sebelum digunakan**
        // Gunakan GeminiService untuk membuat alasan pemilihan mata pelajaran
       
        
        
      
        // Kirim data hasil tes ke view hasil
        return view('tes.hasil', compact('jurusan', 'mapelCount','alasan'));
    }

    
public function showHasil(Request $request, ServicesGeminiService $geminiService)
{
    $jurusanId = $request->input('jurusan_id');
    $soals = Soal::where('jurusan_id', $jurusanId)->get();

    $mapelCount = [];
    
    foreach ($soals as $soal) {
        if ($request->input('jawaban_' . $soal->id) == 'ya') {
            $jawaban = $soal->jawaban_ya;
        } else {
            $jawaban = $soal->jawaban_tidak;
        }
        $mapelCount[$jawaban->nama] = isset($mapelCount[$jawaban->nama]) ? $mapelCount[$jawaban->nama] + 1 : 1;
    }

    $totalJawaban = array_sum($mapelCount);
    $alasan = [];
    foreach ($mapelCount as $mataPelajaran => $count) {
        $mapelCount[$mataPelajaran] = ($count / $totalJawaban) * 100;
        $alasan[$mataPelajaran] = $geminiService->generateReason($mataPelajaran, $mapelCount[$mataPelajaran]);
        // $alasan = $geminiService->generateReason($mataPelajaran, $mapelCount[$mataPelajaran]);
        // dd($alasan);
    }
    
    // Mengambil alasan dari AI
 

    $jurusan = Jurusan::find($jurusanId);

    return view('tes.hasil', compact('jurusan', 'mapelCount', 'alasan'));
}
}
