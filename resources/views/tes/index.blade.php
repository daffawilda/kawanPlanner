<x-layout>
    <div class="py-16 px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">
                Pilih Jurusan untuk Tes
            </h1>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($jurusans as $jurusan)
                    <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                        <h2 class="text-xl font-bold text-indigo-600 mb-4">
                            {{ $jurusan->nama }}
                        </h2>
                        <a href="{{ route('tes.show', $jurusan->id) }}" class="text-blue-500 hover:underline">
                            Mulai Tes
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
