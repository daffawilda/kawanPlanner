<x-layout>
    <div class="py-16 px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">
                Tes Minat & Bakat untuk Jurusan: {{ $jurusan->nama }}
            </h1>

            <!-- Form untuk memilih jawaban dari soal -->
            <form action="{{ route('tes.store') }}" method="POST">
                @csrf
                <input type="hidden" name="jurusan_id" value="{{ $jurusan->id }}">

                <!-- Menampilkan setiap soal -->
                @foreach ($soals as $soal)
                    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                        <h3 class="text-lg font-semibold">{{ $soal->pertanyaan }}</h3>

                        <div class="mt-4">
                            <!-- Pilihan jawaban 'Ya' -->
                            <label class="inline-flex items-center mr-4">
                                <input type="radio" name="soals[{{ $soal->id }}][jawaban]" value="ya" class="form-radio" required>
                                <span class="ml-2">Ya</span>
                            </label>

                            <!-- Pilihan jawaban 'Tidak' -->
                            <label class="inline-flex items-center">
                                <input type="radio" name="soals[{{ $soal->id }}][jawaban]" value="tidak" class="form-radio" required>
                                <span class="ml-2">Tidak</span>
                            </label>
                        </div>
                    </div>
                @endforeach

                <!-- Tombol untuk mengirim jawaban -->
                <div class="mt-6 text-center">
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Kirim Jawaban
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
