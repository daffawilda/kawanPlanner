<x-layoutAdmin>
    <h1 class="text-xl font-bold mb-4">Daftar Mata Pelajaran</h1>

    <!-- Menampilkan pesan sukses -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol Tambah Mata Pelajaran -->
    <a href="{{ route('mataPelajaran.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Mata Pelajaran</a>
    <!-- Tabel Daftar Mata Pelajaran -->
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">No</th>
                <th class="border border-gray-300 px-4 py-2">Nama Mata Pelajaran</th>
                <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                <th class="border border-gray-300 px-4 py-2">Jurusan</th>
                <th class="border border-gray-300 px-4 py-2">Guru</th>
                <th class="border border-gray-300 px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mataPelajarans as $index => $mataPelajaran)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $mataPelajaran->nama }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $mataPelajaran->deskripsi ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $mataPelajaran->jurusan->nama }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $mataPelajaran->guru->nama }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('mataPelajaran.edit', $mataPelajaran->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                        <form action="{{ route('mataPelajaran.destroy', $mataPelajaran->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus mata pelajaran ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="border border-gray-300 px-4 py-2 text-center">Tidak ada data mata pelajaran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-layoutAdmin>
