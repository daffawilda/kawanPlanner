// View: index.blade.php
<x-layoutAdmin>
    <h1 class="text-xl font-bold mb-4">Daftar Guru</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('guru.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Guru</a>

    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">No</th>
                <th class="border border-gray-300 px-4 py-2">Nama</th>
                <th class="border border-gray-300 px-4 py-2">NIP</th>
                <th class="border border-gray-300 px-4 py-2">Email</th>
                <th class="border border-gray-300 px-4 py-2">No HP</th>
                <th class="border border-gray-300 px-4 py-2">Jurusan</th>
                <th class="border border-gray-300 px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gurus as $index => $guru)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $guru->nama }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $guru->nip }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $guru->email }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $guru->no_tlp }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $guru->jurusan->nama }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('guru.edit', $guru->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                        <form action="{{ route('guru.destroy', $guru->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus guru ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layoutAdmin>