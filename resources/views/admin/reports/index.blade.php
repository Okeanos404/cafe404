<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan - CAFE 404</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="min-h-screen bg-gradient-to-r from-gray-900 via-gray-800 to-black text-white">

<div class="max-w-6xl mx-auto p-8">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold">📊 Laporan Penjualan</h1>
            <p class="text-gray-300 mt-1">Ringkasan transaksi CAFE 404</p>
        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="bg-white/10 hover:bg-white/20 px-4 py-2 rounded-xl">
            ⬅ Dashboard
        </a>
    </div>

    <!-- Filter -->
    <form method="GET" class="bg-white/10 p-6 rounded-2xl mb-8 flex flex-wrap gap-4">
        <div>
            <label class="text-sm text-gray-300">Dari Tanggal</label>
            <input type="date" name="start_date" value="{{ $startDate }}"
                   class="block mt-1 p-2 rounded-xl text-black">
        </div>

        <div>
            <label class="text-sm text-gray-300">Sampai Tanggal</label>
            <input type="date" name="end_date" value="{{ $endDate }}"
                   class="block mt-1 p-2 rounded-xl text-black">
        </div>

        <div class="flex items-end gap-2">
            <button class="bg-green-600 hover:bg-green-700 px-5 py-2 rounded-xl">
                Filter
            </button>

            <a href="{{ route('admin.reports') }}"
               class="bg-gray-500 hover:bg-gray-600 px-5 py-2 rounded-xl">
                Reset
            </a>
        </div>
    </form>

    <!-- Ringkasan -->
    <div class="grid md:grid-cols-2 gap-6 mb-10">
        <div class="bg-white/10 p-6 rounded-2xl shadow">
            <p class="text-gray-300">Total Pendapatan</p>
            <h2 class="text-3xl font-bold text-green-400 mt-2">
                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
            </h2>
        </div>

        <div class="bg-white/10 p-6 rounded-2xl shadow">
            <p class="text-gray-300">Total Transaksi</p>
            <h2 class="text-3xl font-bold text-blue-400 mt-2">
                {{ $totalOrders }} Order
            </h2>
        </div>
    </div>

    <!-- Chart -->
    <div class="bg-white p-6 rounded-2xl shadow-lg text-black">
        <h2 class="text-xl font-bold mb-4">Grafik Penjualan</h2>
        <canvas id="salesChart" height="100"></canvas>
    </div>

</div>

<script>
const ctx = document.getElementById('salesChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($chartLabels),
        datasets: [{
            label: 'Pendapatan',
            data: @json($chartValues),
            borderColor: '#16a34a',
            backgroundColor: 'rgba(22,163,74,0.2)',
            tension: 0.4,
            fill: true
        }]
    }
});
</script>

</body>
</html>
