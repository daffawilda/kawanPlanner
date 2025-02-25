<x-layout>
    <div class=" px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center transform hover:scale-105 transition-transform duration-300">
                Pilih Jurusan untuk Tes
            </h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($jurusans as $jurusan)
                    <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200 transform hover:scale-105 transition-transform duration-300 hover:shadow-2xl">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">
                            {{ $jurusan->nama }}
                        </h2>
                        <p class="text-gray-600 mb-4">
                            {{ $jurusan->deskripsi ?? 'tidak ada deskripsi tentang ' }}{{ $jurusan->nama }}
                        </p>
                        <a href="{{ route('tes.show', $jurusan->id) }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors duration-300">
                            Mulai Tes
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>