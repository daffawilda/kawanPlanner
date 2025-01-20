<x-layoutAdmin>
    <h1 class="text-xl font-bold mb-4">Daftar Jurusan</h1>

    <!-- Menampilkan pesan sukses jika ada -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulir Tambah/Edit Jurusan -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">{{ isset($jurusan) ? 'Edit' : 'Tambah' }} Jurusan</h2>

        <form action="{{ isset($jurusan) ? route('jurusan.update', $jurusan->id) : route('jurusan.store') }}" method="POST">
            @csrf
            @if(isset($jurusan))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Jurusan</label>
                <input type="text" name="nama" id="nama" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('nama', $jurusan->nama ?? '') }}" required>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">{{ old('deskripsi', $jurusan->deskripsi ?? '') }}</textarea>
            </div>

            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">{{ isset($jurusan) ? 'Update Jurusan' : 'Tambah Jurusan' }}</button>
            </div>
        </form>
    </div>

    <!-- Tabel Daftar Jurusan -->
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">No</th>
                <th class="border border-gray-300 px-4 py-2">Nama Jurusan</th>
                <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                <th class="border border-gray-300 px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jurusans as $index => $jurusan)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $jurusan->nama }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $jurusan->deskripsi }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    <!-- Tombol Edit -->
                    <a href="{{ route('jurusan.index', ['id' => $jurusan->id]) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('jurusan.destroy', $jurusan->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layoutAdmin>
