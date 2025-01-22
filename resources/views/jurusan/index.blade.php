// View: index.blade.php
<x-layoutAdmin>
    <h1 class="text-xl font-bold mb-4">Daftar Jurusan</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('jurusan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Jurusan</a>

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
                        <a href="{{ route('jurusan.edit', $jurusan->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
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