<x-layoutAdmin>
    <x-slot name="title">Daftar Soal</x-slot>

    <div class="container mx-auto mt-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Daftar Soal</h2>
            <a href="{{ route('soals.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Tambah Soal</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success bg-green-500 text-white px-4 py-2 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">#</th>
                    <th class="px-4 py-2 text-left">Pertanyaan</th>
                    <th class="px-4 py-2 text-left">Jurusan</th>
                    <th class="px-4 py-2 text-left">Jawaban Ya</th>
                    <th class="px-4 py-2 text-left">Jawaban Tidak</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($soals as $soal)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $soal->id }}</td>
                        <td class="px-4 py-2">{{ $soal->pertanyaan }}</td>
                        <td class="px-4 py-2">{{ optional($soal->jurusan)->nama}}</td>
                       {{-- Ini untuk mengecek apakah jawaban_ya ada --}}
                        <td class="px-4 py-2">{{ optional($soal->jawaban_ya)->nama ?? 'tidak ada' }}</td>
                      {{-- Cek apakah jawaban_ya ada --}}
                        <td class="px-4 py-2">{{ optional($soal->jawaban_tidak)->nama ?? 'Tidak ada' }}</td>
                        
                        <td class="px-4 py-2">
                            <a href="{{ route('soals.edit', $soal->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">Edit</a>
                            <form action="{{ route('soals.destroy', $soal->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus soal ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</x-layoutAdmin>
