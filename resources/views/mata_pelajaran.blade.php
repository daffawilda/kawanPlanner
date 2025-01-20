<x-layoutAdmin>
    <h1 class="text-xl font-bold mb-4">Daftar Mata Pelajaran</h1>
    
    <!-- Tabel Mata Pelajaran -->
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">No</th>
                <th class="border border-gray-300 px-4 py-2">Nama Mata Pelajaran</th>
                <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                <th class="border border-gray-300 px-4 py-2">Guru</th>
                <th class="border border-gray-300 px-4 py-2">Jurusan</th>
                <th class="border border-gray-300 px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mataPelajarans as $index => $mataPelajaran)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $mataPelajaran->nama }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $mataPelajaran->deskripsi }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $mataPelajaran->guru->nama }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $mataPelajaran->jurusan->nama }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('mata_pelajaran.edit', $mataPelajaran->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                        
                        <form action="{{ route('mata_pelajaran.destroy', $mataPelajaran->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus mata pelajaran ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layoutAdmin>
