<?php

namespace App\Http\Controllers;
use App\Models\Guru;
use App\Models\Jurusan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $gurus = Guru::all();
        $jurusan = Jurusan::all();
        return view('guru.index', compact('gurus', 'jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        $jurusans = Jurusan::all(); // Mengambil semua data jurusan
        return view('guru.create',compact('jurusans'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:gurus',
            'no_tlp' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:gurus',
            'jurusan_id' => 'required|exists:jurusans,id',

        ]);

        Guru::create([
            'nama' => $request->input('nama'),
            'nip' => $request->input('nip'),
            'no_tlp' => $request->input('no_tlp'),
            'email' => $request->input('email'),
            'jurusan_id' => $request->input('jurusan_id'),
        ]);

        return redirect()->route('guru.index')->with('success', 'Guru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):view
    {
        $gurus = Guru::findOrFail($id);
        return view('guru.show', compact('gurus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id):view
    {
        $gurus = Guru::findOrFail($id);
        $jurusans = Jurusan::all();
        return view('guru.edit', compact('gurus', 'jurusans')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'no_tlp' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'jurusan_id' => 'required|exists:jurusans,id',
        ]);

        $gurus = Guru::findOrFail($id);
        $gurus->update([
            'nama' => $request->input('nama'),
            'nip' => $request->input('nip'),
            'no_tlp' => $request->input('no_tlp'),
            'email' => $request->input('email'),
            'jurusan_id' => $request->input('jurusan_id'),
        ]);
        return redirect()->route('guru.index')->with('success', 'Guru berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Guru::findOrFail($id)->delete();
        return redirect()->route('guru.index')->with('success', 'Guru berhasil dihapus!');
    }

}
