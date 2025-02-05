<x-layoutAdmin>
    <x-slot name="title">Edit Soal</x-slot>

    <div class="container mx-auto mt-4 px-4 py-6">
        <h2 class="text-2xl font-bold mb-4">Edit Soal</h2>

        <form action="{{ route('soals.update', $soal->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Pilih Jurusan -->
            <div class="mb-4">
                <label for="jurusan_id" class="block text-sm font-medium text-gray-700">Jurusan</label>
                <select id="jurusan_id" name="jurusan_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="" disabled selected>Pilih Jurusan</option>
                    @foreach($jurusans as $jurusan)
                        <option value="{{ $jurusan->id }}" {{ $jurusan->id == $soal->jurusan_id ? 'selected' : '' }}>{{ $jurusan->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Input Pertanyaan Soal -->
            <div class="mb-4">
                <label for="pertanyaan" class="block text-sm font-medium text-gray-700">Pertanyaan</label>
                <textarea id="pertanyaan" name="pertanyaan" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>
            </div>

            <!-- Pilih Mata Pelajaran untuk Jawaban Ya -->
            <div class="mb-4">
                <label for="jawaban_ya_id" class="block text-sm font-medium text-gray-700">Jawaban Ya</label>
                <select id="jawaban_ya_id" name="jawaban_ya_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="">Pilih Mata Pelajaran</option>
                    @foreach($mataPelajarans as $mataPelajaran)
                        <option value="{{ $mataPelajaran->id }}" {{ $mataPelajaran->id == $soal->jawaban_ya_id ? 'selected' : '' }}>{{ $mataPelajaran->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Pilih Mata Pelajaran untuk Jawaban Tidak -->
            <div class="mb-4">
                <label for="jawaban_tidak_id" class="block text-sm font-medium text-gray-700">Jawaban Tidak</label>
                <select id="jawaban_tidak_id" name="jawaban_tidak_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="">Pilih Mata Pelajaran</option>
                    @foreach($mataPelajarans as $mataPelajaran)
                        <option value="{{ $mataPelajaran->id }}" {{ $mataPelajaran->id == $soal->jawaban_tidak_id ? 'selected' : '' }}>{{ $mataPelajaran->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('jurusan_id').addEventListener('change', function() {
            var jurusanId = this.value;  // Mendapatkan ID jurusan yang dipilih

            if (jurusanId) {
                fetch(`/get-mata-pelajaran/${jurusanId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Kosongkan opsi sebelumnya
                        document.getElementById('jawaban_ya_id').innerHTML = '<option value="">Pilih Mata Pelajaran</option>';
                        document.getElementById('jawaban_tidak_id').innerHTML = '<option value="">Pilih Mata Pelajaran</option>';

                        // Isi dropdown dengan mata pelajaran
                        data.forEach(function(mataPelajaran) {
                            var optionYa = document.createElement('option');
                            optionYa.value = mataPelajaran.id;
                            optionYa.textContent = mataPelajaran.nama;
                            document.getElementById('jawaban_ya_id').appendChild(optionYa);

                            var optionTidak = document.createElement('option');
                            optionTidak.value = mataPelajaran.id;
                            optionTidak.textContent = mataPelajaran.nama;
                            document.getElementById('jawaban_tidak_id').appendChild(optionTidak);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching mata pelajaran:', error);
                    });
            }
        });
    </script>

</x-layoutAdmin>
