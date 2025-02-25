<header class="absolute inset-x-0 top-0 z-50 bg-gradient-to-r from-gray-800 to-blue-900">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
      <!-- Logo -->
      <div class="flex lg:flex-1">
        <a href="/" class="flex items-center space-x-2">
          <span class="text-lg font-bold text-gray-100">Kawan Planner</span>
          <img src="{{ url('images/logoSMK.png') }}" alt="Gambar" class="w-8 h-8">
          
        </a>
      </div>
  
      <!-- Desktop Menu -->
      <div class="hidden lg:flex lg:gap-x-12">
        <a href="/" class="text-sm font-semibold text-gray-200 hover:text-indigo-600 transition">Home</a>
        <a href="{{ route('tes.index') }}" class="text-sm font-semibold text-gray-200 hover:text-indigo-600 transition">Tes Minat Bakat</a>
        <a href="{{ route('informasi.mataPelajaran') }}" class="text-sm font-semibold text-gray-200 hover:text-indigo-600 transition">Informasi Mata Pelajaran</a>
      </div>
  
      <!-- Mobile Menu Button -->
      <div class="lg:hidden">
        <button id="mobile-menu-button" class="text-gray-200 focus:outline-none">
          <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
          </svg>
        </button>
      </div>
    </nav>
  
    <!-- Mobile Menu (Hidden by Default) -->
    <div id="mobile-menu" class="hidden lg:hidden fixed inset-0 z-50 bg-gradient-to-r from-blue-900 to-gray-800 p-6 shadow-lg">
      <div class="flex items-center justify-between">
        <a href="/" class="flex items-center space-x-2">
          <span class="text-lg font-bold text-gray-100">Kawan Planner</span>
        </a>
        <button id="close-menu" class="text-gray-200">
          <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="mt-6 space-y-4">
        <a href="/" class="block text-lg font-semibold text-gray-200 hover:text-indigo-600 transition">Home</a>
        <a href="{{ route('tes.index') }}" class="block text-lg font-semibold text-gray-200 hover:text-indigo-600 transition">Tes Minat Bakat</a>
        <a href="{{ route('informasi.mataPelajaran') }}" class="block text-lg font-semibold text-gray-200 hover:text-indigo-600 transition">Informasi Mata Pelajaran</a>
      </div>
    </div>
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
  document.getElementById('mobile-menu').classList.remove('hidden');
});

document.getElementById('close-menu').addEventListener('click', function() {
  document.getElementById('mobile-menu').classList.add('hidden');
});
    </script>
  </header>