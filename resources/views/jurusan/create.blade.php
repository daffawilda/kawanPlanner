<x-layoutAdmin>
    <h1 class="text-xl font-bold mb-4">Tambah Jurusan</h1>

    @if($errors->any())
        <div class="bg-red-500 text-white p-2 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jurusan.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Jurusan</label>
            <input type="text" name="nama" id="nama" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Jurusan</button>
    </form>
</x-layoutAdmin>