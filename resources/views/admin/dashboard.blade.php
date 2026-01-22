<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - CAFE 404</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="min-h-screen bg-gradient-to-r from-gray-900 via-gray-800 to-black text-white">

    <div class="max-w-6xl mx-auto p-6 md:p-10">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-6 mb-10">
            <div>
                <h1 class="text-4xl font-bold tracking-wide flex items-center gap-3">
                    <span class="text-3xl">☕</span>
                    <span>Admin Dashboard</span>
                </h1>

                <p class="text-gray-300 mt-2">
                    Selamat datang <span class="font-semibold text-white">{{ auth()->user()->name }}</span>
                    di sistem <span class="font-semibold text-white">CAFE 404</span>
                </p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="bg-red-600 hover:bg-red-700 px-5 py-2 rounded-xl shadow-lg transition flex items-center gap-2"
                >
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </button>
            </form>
        </div>

        <!-- Cards -->
        <div class="grid md:grid-cols-3 gap-6">

            <!-- Kelola Produk -->
            <a href="/admin/products"
               class="block group rounded-2xl bg-white/10 border border-white/10 shadow-xl p-6
                      hover:bg-white/15 hover:border-white/20 transition">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-xl font-semibold flex items-center gap-2">
                            <i class="fa-solid fa-mug-hot text-yellow-400 text-2xl"></i>
                            Kelola Produk
                        </h2>

                        <p class="text-gray-300 mt-2">
                            Tambah / Edit produk coffee, non-coffee, snack.
                        </p>
                    </div>

                    <div class="text-white/70 group-hover:text-white transition">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </a>

            <!-- Kelola Customer (placeholder dulu) -->
            <div class="rounded-2xl bg-white/10 border border-white/10 shadow-xl p-6
                        hover:bg-white/15 hover:border-white/20 transition">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-xl font-semibold flex items-center gap-2">
                            <i class="fa-solid fa-users text-blue-400 text-2xl"></i>
                            Kelola Customer
                        </h2>

                        <p class="text-gray-300 mt-2">
                            Lihat data customer yang terdaftar.
                        </p>
                    </div>

                    <div class="text-white/50">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                </div>

                <p class="text-xs text-gray-400 mt-4">
                    *Fitur ini kita buat di step berikutnya.
                </p>
            </div>

            <!-- Pesanan / Laporan -->
<a href="{{ route('admin.reports') }}"
   class="block group rounded-2xl bg-white/10 border border-white/10 shadow-xl p-6
          hover:bg-white/15 hover:border-white/20 transition">
    <div class="flex items-start justify-between">
        <div>
            <h2 class="text-xl font-semibold flex items-center gap-2">
                <i class="fa-solid fa-chart-line text-green-400 text-2xl"></i>
                Pesanan & Laporan
            </h2>

            <p class="text-gray-300 mt-2">
                Pantau transaksi dan update status order.
            </p>
        </div>

        <div class="text-white/70 group-hover:text-white transition">
            <i class="fa-solid fa-arrow-right"></i>
        </div>
    </div>
</a>


        </div>

    </div>

</body>
</html>
