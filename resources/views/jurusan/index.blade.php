<x-layoutAdmin>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <h1 class="text-2xl font-semibold text-gray-900">Daftar Jurusan</h1>

            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mt-6 mb-6">
                <a href="{{ route('jurusan.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Tambah Jurusan
                </a>
            </div>

            <!-- Tabel untuk layar besar -->
            <div class="hidden md:block shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Jurusan
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deskripsi
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($jurusans as $index => $jurusan)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $jurusan->nama }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $jurusan->deskripsi }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('jurusan.edit', $jurusan->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                    <form action="{{ route('jurusan.destroy', $jurusan->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Accordion untuk layar kecil -->
            <div class="md:hidden space-y-4 transition-all duration-300 ease-in-out">
                @foreach ($jurusans as $index => $jurusan)
                    <div x-data="{ open: false }" class="bg-white shadow overflow-hidden rounded-lg">
                        <div class="px-4 py-5 sm:px-6 flex justify-between items-center cursor-pointer" @click="open = !open">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">{{ $jurusan->nama }}</h3>
                                <p class="text-sm text-gray-500">No: {{ $index + 1 }}</p>
                            </div>
                            <svg :class="{'transform rotate-180': open}" class="w-5 h-5 text-gray-500 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        <div x-show="open" x-collapse class="px-4 py-5 sm:px-6 border-t border-gray-200 transition-all duration-300 ease-in-out">
                            <p class="text-sm text-gray-900"><strong>Deskripsi:</strong> {{ $jurusan->deskripsi }}</p>
                            <div class="mt-4 space-x-2">
                                <a href="{{ route('jurusan.edit', $jurusan->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('jurusan.destroy', $jurusan->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.plugin(Collapse);
        });
    </script>
</x-layoutAdmin>