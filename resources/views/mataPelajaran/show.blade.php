<x-layout>
    <div class=" py-16 px-6 lg:px-8 relative isolate">
        <div class="max-w-4xl mx-auto my-11">      
            <!-- Detail Container -->
            <div class="bg-gradient-to-r from-indigo-50 to-white shadow-lg rounded-lg p-8 border border-gray-200">
                <!-- Mata Pelajaran Name -->
                <h2 class="text-2xl font-bold text-indigo-600 mb-4">
                    {{ $mataPelajaran->nama }}
                </h2>
                
                <!-- Deskripsi -->
                <p class="text-gray-700 text-base mb-6 leading-relaxed">
                    {{ $mataPelajaran->deskripsi ?? 'Deskripsi tidak tersedia.' }}
                </p>

                <!-- Jurusan Section -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Jurusan:</h3>
                    <p class="text-gray-700">
                        {{ $mataPelajaran->jurusan->nama ?? 'Tidak ada jurusan.' }}
                    </p>
                </div>

                <!-- Guru Section -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Guru Pengajar:</h3>
                    <p class="text-gray-700">
                        {{ $mataPelajaran->guru->nama ?? 'Tidak ada guru.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
