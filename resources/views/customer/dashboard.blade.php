<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - CAFE 404</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="min-h-screen bg-gradient-to-r from-orange-200 via-yellow-100 to-white text-gray-900">

    <div class="max-w-6xl mx-auto p-8">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-4xl font-bold tracking-wide">👋 Customer Dashboard</h1>
                <p class="text-gray-700 mt-2">
                    Halo <b>{{ auth()->user()->name }}</b>, selamat datang di <b>CAFE 404</b>
                </p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-gray-900 text-white hover:bg-black px-5 py-2 rounded-xl shadow-lg">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
           <a href="{{ route('customer.menu') }}" class="block">
                <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition">
                    <i class="fa-solid fa-store text-4xl mb-4 text-orange-500"></i>
                    <h2 class="text-xl font-semibold">Menu Produk</h2>
                    <p class="text-gray-600 mt-2">Lihat coffee, non-coffee, snack favoritmu.</p>
                </div>
            </a>


            <a href="{{ route('customer.cart') }}" class="block">
                <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition">
                    <i class="fa-solid fa-cart-shopping text-4xl mb-4 text-green-500"></i>
                    <h2 class="text-xl font-semibold">Keranjang</h2>
                    <p class="text-gray-600 mt-2">Tambahkan produk dan checkout.</p>
                </div>
            </a>

            <a href="{{ route('customer.orders') }}" class="block">
                <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition">
                    <i class="fa-solid fa-receipt text-4xl mb-4 text-blue-600"></i>
                    <h2 class="text-xl font-semibold">Riwayat Pesanan</h2>
                    <p class="text-gray-600 mt-2">Cek status transaksi kamu.</p>
                </div>
            </a>
        </div>
    </div>

</body>
</html>
