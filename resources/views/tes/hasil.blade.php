<x-layout>
    <div class="container mx-auto p-6 m-10">
        <h1 class="text-2xl font-bold mb-4">Hasil Tes Minat Bakat - {{ $jurusan->nama }}</h1>

        <div class="bg-gray-100 p-4 rounded-md">
            <h2 class="text-lg font-semibold">Persentase Mata Pelajaran yang Direkomendasikan:</h2>
            <ul class="mt-2">
                @foreach($mapelCount as $mataPelajaran => $percentage)
                <li class="mb-2">
                    <div class="font-semibold">{{ $mataPelajaran }} - {{ number_format($percentage, 2) }}%</div>
                    <p class="text-sm text-gray-600">{{ $alasan[$mataPelajaran] ?? 'Alasan tidak tersedia.' }}</p>
                    <div class="w-full bg-gray-300 h-4 rounded-md mt-1">
                        <div class="bg-blue-500 h-4 rounded-md" style="width: {{ $percentage }}%;"></div>
                    </div>
                </li>
            @endforeach
            </ul>
        </div>

        <a href="{{ route('tes.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Coba Lagi
        </a>
    </div>
</x-layout>
