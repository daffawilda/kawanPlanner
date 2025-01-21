<?php
namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\View\View;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index():view
    {
        // Ambil data jurusan dari database
        $jurusans = Jurusan::all();
        // Kirim data jurusan dan daftar jurusan ke tampilan
        return view('jurusan', compact('jurusans'));
    }

    /**
     * create
     * 
     * @return view
     */

    public function create():view
    {
    return view('jurusan.create');
    }

    /**
     * store
     * 
     * @param mixed $request
     * @return redirectresponse
     */

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Jurusan::create([
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
        ]);
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil ditambahkan!');
    }
    /**
     * show
     * 
     * @param mixed $id
     * @return view
     */
    public function show(string $id):view{
        $jurusan = Jurusan::findOrFail($id);
        return view('jurusan.show', compact('jurusan'));
    }

    /**
     * edit
     * 
     * @param mixed $id
     * @return view
     */
    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id); // Jurusan yang sedang di-edit
        $jurusans = Jurusan::all(); // Semua daftar jurusan untuk tabel
        return view('jurusan', compact('jurusan', 'jurusans'));
    }
     

    /**
     * update
     * 
     * @param mixed $request
     * @param mixed $id
     * @return redirectresponse
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $jurusan = Jurusan::findOrFail($id);
        $jurusan->update([
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
        ]);
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil diperbarui!');
    }
    
    public function destroy($id)
    {
        Jurusan::findOrFail($id)->delete();
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus!');
    }
}
