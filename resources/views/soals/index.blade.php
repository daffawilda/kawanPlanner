<x-layoutAdmin>
    <div class="container mx-auto px-4 sm:px-8 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Daftar Soal</h2>
            <div class="flex space-x-4">
                <a href="{{ route('soals.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300">
                    Tambah Soal
                </a>
                <form action="{{ route('soals.destroyAll') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus SEMUA soal?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-300">
                        Hapus Semua Soal
                    </button>
                </form>
            </div>
        </div>

        <!-- Menampilkan pesan sukses -->
        @if(session('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Daftar Soal per Jurusan -->
        @foreach($jurusans as $jurusan)
            @php
                $soalJurusan = $soals->where('jurusan_id', $jurusan->id);
            @endphp

            @if($soalJurusan->count() > 0)
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-blue-600 mb-4">{{ $jurusan->nama }}</h3>
                    <div class="shadow overflow-x-scroll md:overflow-x-auto border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Pertanyaan
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jawaban Ya
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jawaban Tidak
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($soalJurusan->values() as $index => $soal)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ $soal->pertanyaan }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ optional($soal->jawaban_ya)->nama ?? 'Tidak ada' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ optional($soal->jawaban_tidak)->nama ?? 'Tidak ada' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('soals.edit', $soal->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                            <form action="{{ route('soals.destroy', $soal->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus soal ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</x-layoutAdmin>