<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        // Ambil semua data guru dengan relasi ke jurusan
        $gurus = Guru::with('jurusan')->get();
        $jurusans = Jurusan::all(); // Data jurusan untuk dropdown
        return view('guru', compact('gurus', 'jurusans'));
    }


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'jurusan_id' => 'required|exists:jurusans,id',
            'email' => 'required|email|unique:gurus,email',
            'telepon' => 'nullable|string|max:15',
        ]);

        // Simpan data guru ke database
        Guru::create($request->all());

        return redirect()->back()->with('success', 'Guru berhasil ditambahkan!');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jurusan_id' => 'required|exists:jurusans,id',
            'email' => 'required|email|unique:gurus,email,' . $id,
            'telepon' => 'nullable|string|max:15',
        ]);
    
        $guru = Guru::findOrFail($id);
        $guru->update($request->all());
    
        return redirect()->route('guru.index')->with('success', 'Guru berhasil diperbarui!');
    }
    public function destroy($id)
    {
        Guru::destroy($id);

        return redirect()->route('guru.index')->with('success', 'Guru berhasil dihapus.');
    }
}

