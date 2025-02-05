<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Jurusan;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    // Menampilkan daftar soal
    public function index()
    {
        $soals = Soal::with(['jurusan', 'jawaban_ya', 'jawaban_tidak'])->get();
        //  dd($soals->toArray()); // Debugging

        return view('soals.index', compact('soals'));
    }

    // Menampilkan form untuk membuat soal baru
    public function create()
    {
        $jurusans = Jurusan::all();  // Mengambil semua jurusan
        $mataPelajarans = MataPelajaran::all(); // Mendapatkan semua mata pelajaran
        
        return view('soals.create', compact('jurusans','mataPelajarans'));
    }

    // Menyimpan soal baru
    public function store(Request $request)
    {
        $request->validate([
            'jurusan_id' => 'required|exists:jurusans,id',  // Validasi jurusan_id
            'pertanyaan' => 'required|string|max:255',  // Validasi pertanyaan
            'jawaban_ya_id' => 'required|exists:mata_pelajarans,id',  // Validasi jawaban_ya
            'jawaban_tidak_id' => 'required|exists:mata_pelajarans,id',  // Validasi jawaban_tidak
            
        ]);

        Soal::create([
            'jurusan_id' => $request->jurusan_id,
            'pertanyaan' => $request->pertanyaan,
            'jawaban_ya_id' => $request->jawaban_ya_id,
            'jawaban_tidak_id' => $request->jawaban_tidak_id,
        ]);
        // dd($soal);
        
        return redirect()->route('soals.index')->with('success', 'Soal berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit soal
    public function edit($id)
    {
        $soal = Soal::findOrFail($id);  // Mencari soal berdasarkan ID
        $jurusans = Jurusan::all();  // Mengambil semua jurusan
        $mataPelajarans = MataPelajaran::where('jurusan_id', $soal->jurusan_id)->get(); // Ambil mata pelajaran yang terkait dengan jurusan
        return view('soals.edit', compact('soal', 'jurusans', 'mataPelajarans'));
    }

    // Memperbarui soal yang ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'jurusan_id' => 'required|exists:jurusans,id',  // Validasi jurusan_id
            'pertanyaan' => 'required|string|max:255',  // Validasi pertanyaan
        ]);

        $soal = Soal::findOrFail($id);  // Mencari soal berdasarkan ID
        $soal->update([
            'jurusan_id' => $request->jurusan_id,
            'pertanyaan' => $request->pertanyaan,
        ]);

        return redirect()->route('soals.index')->with('success', 'Soal berhasil diperbarui!');
    }

    // Menghapus soal
    public function destroy($id)
    {
        $soal = Soal::findOrFail($id);  // Mencari soal berdasarkan ID
        $soal->delete();

        return redirect()->route('soals.index')->with('success', 'Soal berhasil dihapus!');
    }
    // Tambahkan method untuk mengambil mata pelajaran berdasarkan jurusan
    public function getMataPelajaran($jurusanId)
    {
        $mataPelajaran = MataPelajaran::where('jurusan_id', $jurusanId)->get();
        return response()->json($mataPelajaran);
    }
}

