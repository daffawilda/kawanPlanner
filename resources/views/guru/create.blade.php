<x-layoutAdmin>
    <h1 class="text-xl font-bold mb-4">Tambah Guru</h1>

    <!-- Menampilkan error jika ada -->
    @if($errors->any())
        <div class="bg-red-500 text-white p-2 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('guru.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Guru</label>
            <input type="text" name="nama" id="nama" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required value="{{ old('nama') }}">
        </div>

        <div class="mb-4">
            <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
            <input type="text" name="nip" id="nip" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required value="{{ old('nip') }}">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required value="{{ old('email') }}">
        </div>

        <div class="mb-4">
            <label for="no_tlp" class="block text-sm font-medium text-gray-700">No HP</label>
            <input type="text" name="no_tlp" id="no_tlp" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required value="{{ old('no_tlp') }}">
        </div>

        <div class="mb-4">
            <label for="jurusan_id" class="block text-sm font-medium text-gray-700">Jurusan</label>
            <select name="jurusan_id" id="jurusan_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                <option value="" disabled selected>Pilih Jurusan</option>
                @foreach($jurusans as $jurusan)
                    <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                        {{ $jurusan->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Guru</button>
    </form>
</x-layoutAdmin>
