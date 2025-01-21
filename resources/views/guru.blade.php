<x-layoutAdmin>
    <h1 class="text-xl font-bold mb-4">{{ isset($guru) ? 'Edit' : 'Tambah' }} Guru</h1>

    <!-- Menampilkan pesan sukses -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Bagian Formulir Tambah/Edit Guru -->
    <h2 class="text-lg font-semibold mb-2">{{ isset($guru) ? 'Edit' : 'Tambah' }} Guru</h2>
    <form action="{{ isset($guru) ? route('guru.update', $guru->id) : route('guru.store') }}" method="POST">
        @csrf
        @if(isset($guru))
            @method('PUT')
        @endif
        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Guru</label>
            <input type="text" name="nama" id="nama" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" 
                   value="{{ old('nama', $guru->nama ?? '') }}" required>
        </div>

        <div class="mb-4">
            <label for="jurusan_id" class="block text-sm font-medium text-gray-700">Jurusan</label>
            <select name="jurusan_id" id="jurusan_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                <option value="" disabled selected>Pilih Jurusan</option>
                @foreach ($jurusans as $jurusan)
                    <option value="{{ $jurusan->id }}" {{ (old('jurusan_id', $guru->jurusan_id ?? '') == $jurusan->id) ? 'selected' : '' }}>
                        {{ $jurusan->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" 
                   value="{{ old('email', $guru->email ?? '') }}">
        </div>

        <div class="mb-4">
            <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
            <input type="text" name="nip" id="nip" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" 
                   value="{{ old('nip', $guru->nip ?? '') }}">
        </div>

        <div class="mb-4">
            <label for="telepon" class="block text-sm font-medium text-gray-700">Telepon</label>
            <input type="text" name="telepon" id="telepon" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" 
                   value="{{ old('telepon', $guru->telepon ?? '') }}" required>
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                {{ isset($guru) ? 'Update Guru' : 'Tambah Guru' }}
            </button>
        </div>
    </form>

    <!-- Bagian Tabel Daftar Guru -->
    <h2 class="text-lg font-semibold mt-8 mb-4">Daftar Guru</h2>
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">No</th>
                <th class="border border-gray-300 px-4 py-2">Nama Guru</th>
                <th class="border border-gray-300 px-4 py-2">Jurusan</th>
                <th class="border border-gray-300 px-4 py-2">Email</th>
                <th class="border border-gray-300 px-4 py-2">NIP</th>
                <th class="border border-gray-300 px-4 py-2">Telepon</th>
                <th class="border border-gray-300 px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gurus as $index => $g)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $g->nama }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $g->jurusan->nama ?? 'No Jurusan' }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $g->email }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $g->nip }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $g->telepon }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    <a href="{{ route('guru.edit', $g->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                    <form action="{{ route('guru.destroy', $g->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        
        </tbody>
    </table>
</x-layoutAdmin>
