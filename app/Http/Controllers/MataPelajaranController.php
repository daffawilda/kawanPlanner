<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use App\Models\Jurusan;
use App\Models\Guru;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index(): View
    {
        $mataPelajarans = MataPelajaran::all();
        $gurus = Guru::all();
        $jurusans = Jurusan::all();
        return view('mataPelajaran.index', compact('mataPelajarans', 'gurus', 'jurusans'));
    }

    public function create(): View
    {
        $jurusans = Jurusan::all();
        $gurus = Guru::all();
        return view('mataPelajaran.create', compact('jurusans', 'gurus'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jurusan_id' => 'required|exists:jurusans,id',
            'guru_id' => 'required|exists:gurus,id|in:' . implode(',', Guru::where('jurusan_id', $request->input('jurusan_id'))->pluck('id')->toArray())
        ]);

        MataPelajaran::create([
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'jurusan_id' => $request->input('jurusan_id'),
            'guru_id' => $request->input('guru_id'),
        ]);

        return redirect()->route('mataPelajaran.index')->with('success', 'Mata Pelajaran berhasil ditambahkan!');
    }

    public function show(string $id): View
    {
        $mataPelajaran = MataPelajaran::with(['jurusan', 'guru'])->findOrFail($id);
        return view('mataPelajaran.show', compact('mataPelajaran'));
    }

    public function edit(string $id): View
    {
        $mataPelajaran = MataPelajaran::findOrFail($id);
        $jurusans = Jurusan::all();
        // Menampilkan guru sesuai dengan jurusan yang dipilih
        $gurus = Guru::where('jurusan_id', $mataPelajaran->jurusan_id)->get();
        return view('mataPelajaran.edit', compact('mataPelajaran', 'jurusans', 'gurus'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jurusan_id' => 'required|exists:jurusans,id',
            'guru_id' => 'required|exists:gurus,id|in:' . implode(',', Guru::where('jurusan_id', $request->input('jurusan_id'))->pluck('id')->toArray())
        ]);

        $mataPelajaran = MataPelajaran::findOrFail($id);
        $mataPelajaran->update([
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'jurusan_id' => $request->input('jurusan_id'),
            'guru_id' => $request->input('guru_id'),
        ]);

        return redirect()->route('mataPelajaran.index')->with('success', 'Mata Pelajaran berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        MataPelajaran::findOrFail($id)->delete();
        return redirect()->route('mataPelajaran.index')->with('success', 'Mata Pelajaran berhasil dihapus!');
    }

    // Method untuk mendapatkan guru berdasarkan jurusan_id
    public function getGurus($jurusanId)
    {
        // Mengambil guru berdasarkan jurusan_id
        $gurus = Guru::where('jurusan_id', $jurusanId)->get();

        // Mengirim data guru sebagai JSON
        return response()->json($gurus);
    }
}
