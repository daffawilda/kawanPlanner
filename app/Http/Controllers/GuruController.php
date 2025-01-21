<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jurusan;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /** 
     * index
     * 
     * @return void
     */
    public function index():view
    {
        // Menampilkan semua data guru
        // $gurus = Guru::with('jurusan')->get(); // Mengambil data guru beserta data jurusan
        // $jurusans = Jurusan::all(); // Mengambil semua data jurusan untuk dropdown
        // return view('guru', compact('gurus', 'jurusans'));

        $gurus = Guru::with('jurusan')->get();
        $jurusans = Jurusan::all();
        if ($gurus->isEmpty()) {
            dd('Tidak ada guru yang ditemukan');
        }
        return view('guru', compact('gurus', 'jurusans'));
        

    }
    /**
     * create
     * 
     * @return view
     */
    public function create():view
    {
        // Menampilkan form untuk menambah guru
        $jurusans = Jurusan::all(); // Mengambil semua data jurusan untuk dropdown
        return view('guru', compact('jurusans'));
    }
    /**
     * store
     * 
     * @param mixed $request
     * @return redirectresponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'jurusan_id' => 'required|exists:jurusans,id',
            'email' => 'nullable|email',
            'nip' => 'nullable|string|max:20',
            'telepon' => 'required|string|max:20',
        ]);

        // Menyimpan data guru
        Guru::create([
            'nama' => $request->nama,
            'jurusan_id' => $request->jurusan_id,
            'email' => $request->email,
            'nip' => $request->nip,
            'telepon' => $request->telepon,
        ]);

        return redirect()->route('guru.index')->with('success', 'Guru berhasil ditambahkan!');
    }
    /**
     * show
     * 
     * @param mixed $id
     * @return view
     */
    public function show(Guru $guru):view
    {
        // Menampilkan detail data guru
        $guru = Guru::findOrFail($guru->id);
        return view('guru.show', compact('gurus')); 
    }
    /**
     * edit
     * 
     * @param mixed $guru
     * @return view
     */
    public function edit(Guru $guru)
    {
        // Menampilkan form untuk mengedit data guru
        $jurusans = Jurusan::all(); // Mengambil semua data jurusan untuk dropdown
        return view('guru', compact('guru','gurus' ,'jurusans'));
    }

    public function update(Request $request, Guru $guru): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'jurusan_id' => 'required|exists:jurusans,id',
            'email' => 'nullable|email',
            'nip' => 'nullable|string|max:20',
            'telepon' => 'required|string|max:20',
        ]);
        // Memperbarui data guru
        $guru->update([
            'nama' => $request->nama,
            'jurusan_id' => $request->jurusan_id,
            'email' => $request->email,
            'nip' => $request->nip,
            'telepon' => $request->telepon,
        ]);

        return redirect()->route('guru.index')->with('success', 'Guru berhasil diperbarui!');
    }

    public function destroy(Guru $guru)
    {
        // Menghapus data guru
        $guru->delete();
        return redirect()->route('guru.index')->with('success', 'Guru berhasil dihapus!');
    }
}
