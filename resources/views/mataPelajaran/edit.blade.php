<x-layoutAdmin>
    <h1 class="text-xl font-bold mb-4">Edit Mata Pelajaran</h1>

    @if($errors->any())
        <div class="bg-red-500 text-white p-2 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mataPelajaran.update', $mataPelajaran->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Mata Pelajaran</label>
            <input type="text" name="nama" id="nama" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('nama', $mataPelajaran->nama) }}" required>
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">{{ old('deskripsi', $mataPelajaran->deskripsi) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="jurusan_id" class="block text-sm font-medium text-gray-700">Jurusan</label>
            <select name="jurusan_id" id="jurusan_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                @foreach ($jurusans as $jurusan)
                    <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $mataPelajaran->jurusan_id) == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="guru_id" class="block text-sm font-medium text-gray-700">Guru</label>
            <select name="guru_id" id="guru_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                <!-- Opsi guru akan di-update lewat AJAX -->
                @foreach ($gurus as $guru)
                    <option value="{{ $guru->id }}" {{ old('guru_id', $mataPelajaran->guru_id) == $guru->id ? 'selected' : '' }}>{{ $guru->nama }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Mata Pelajaran</button>
    </form>

    <script>
        // Mengambil data guru berdasarkan jurusan yang dipilih
        document.getElementById('jurusan_id').addEventListener('change', function() {
            var jurusanId = this.value;

            fetch(`/get-gurus/${jurusanId}`)
                .then(response => response.json())
                .then(data => {
                    var guruSelect = document.getElementById('guru_id');
                    guruSelect.innerHTML = ''; // Clear current options

                    // Menambahkan opsi guru berdasarkan data yang didapatkan
                    data.forEach(function(guru) {
                        var option = document.createElement('option');
                        option.value = guru.id;
                        option.textContent = guru.nama;
                        guruSelect.appendChild(option);
                    });

                    // Memilih kembali guru yang sudah dipilih sebelumnya
                    @if(old('guru_id', $mataPelajaran->guru_id))
                        document.getElementById('guru_id').value = "{{ old('guru_id', $mataPelajaran->guru_id) }}";
                    @endif
                })
                .catch(error => {
                    console.error('Error fetching gurus:', error);
                });
        });

        // Memicu event change agar dropdown guru diupdate saat halaman dimuat
        document.getElementById('jurusan_id').dispatchEvent(new Event('change'));
    </script>
</x-layoutAdmin>
