<x-layout>

    <main class="relative isolate px-6 lg:px-8" >
        <!-- Main Content -->
        <div class="mx-auto max-w-2xl sm:py-20 lg:py-24 text-center relative z-10">
            <h1 class="text-5xl font-bold tracking-tight text-gray-900 sm:text-7xl">
                Selamat Datang di <span class="text-blue-600">Kawan Planner</span>
            </h1>
            <p class="mt-6 text-lg text-gray-600 sm:text-xl">
                Kami akan membantu Anda menemukan mata pelajaran yang sesuai dengan minat dan bakat Anda.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('tes.index') }}" class="rounded-md bg-blue-600 px-6 py-3 text-lg font-semibold text-white shadow-lg hover:bg-blue-500 transition-all transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
                    Mulai Tes
                </a>
                <a href="{{ route('informasi.mataPelajaran') }}" class="rounded-md bg-white px-6 py-3 text-lg font-semibold text-blue-600 shadow-lg hover:bg-gray-50 transition-all transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
                    Mata Pelajaran →
                </a>
            </div>
        </div>
    </main>
  </x-layout>   