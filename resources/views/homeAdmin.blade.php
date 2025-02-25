<x-layoutAdmin>
    <!-- Main Content -->
    <div class="p-4">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard Admin</h1>

        <!-- Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">Total Jurusan</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $jumlahJurusan }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">Total Guru</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $jumlahGuru }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">Total Mata Pelajaran</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $jumlahMataPelajaran }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">Total Soal</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $jumlahSoal }}</p>
            </div>
        </div>

        <!-- Grafik -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Grafik</h3>
                <canvas id="chart"></canvas>
            </div>
        </div>
    </div>

    <!-- Script untuk Grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data dari Controller
        const labels = ['Jurusan', 'Guru','Mata Pelajaran','Soal' ];
        const data = [{{ $jumlahJurusan }}, {{ $jumlahGuru }}, {{ $jumlahMataPelajaran }},'{{ $jumlahSoal }}'];

        // Grafik Jurusan & Guru
        const ctx1 = document.getElementById('chart').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Grafik',
                    data: data,
                    backgroundColor: ['red', 'yellow', 'green', 'blue'],
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });

       
    </script>
</x-layoutAdmin>
