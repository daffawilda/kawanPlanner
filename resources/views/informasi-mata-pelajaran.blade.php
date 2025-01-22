<x-layout>
    <div class="py-16 px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Title -->
            <h1 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">
                Informasi Jurusan dan Mata Pelajaran
            </h1>
            
            <!-- Cards Container -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($jurusans as $jurusan)
                    <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                        <!-- Jurusan Name -->
                        <h2 class="text-xl font-bold text-indigo-600 mb-4">
                            {{ $jurusan->nama }}
                        </h2>
                        
                        <!-- Mata Pelajaran List -->
                        <ul class="space-y-2">
                            @forelse ($jurusan->mataPelajarans as $mataPelajaran)
                                <li>
                                    <a href="{{ route('mataPelajaran.show', $mataPelajaran->id) }}"
                                        class="text-indigo-500 hover:underline">
                                        {{ $mataPelajaran->nama }}
                                    </a>
                                </li>
                            @empty
                                <li class="text-gray-500">Belum ada mata pelajaran tersedia.</li>
                            @endforelse
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
