<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Produk - CAFE 404</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="min-h-screen bg-gradient-to-r from-orange-200 via-yellow-100 to-white text-gray-900">

    <div class="max-w-6xl mx-auto p-8">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-4xl font-bold tracking-wide">☕ Menu CAFE 404</h1>
                <p class="text-gray-700 mt-2">
                    Pilih minuman & snack favorit kamu 😄
                </p>
            </div>

            <div class="flex gap-3">
                <a href="/customer/dashboard" class="bg-gray-900 text-white hover:bg-black px-4 py-2 rounded-xl shadow">
                    <i class="fa-solid fa-house"></i> Dashboard
                </a>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="bg-white p-5 rounded-2xl shadow-lg mb-8">
            <form method="GET" action="{{ route('customer.menu') }}" class="flex flex-col md:flex-row gap-3">

                <div class="flex-1">
                    <input type="text"
                           name="search"
                           value="{{ $search }}"
                           placeholder="Cari menu... (contoh: latte, taro, fries)"
                           class="w-full p-3 rounded-xl border">
                </div>

                <div class="md:w-64">
                    <select name="category" class="w-full p-3 rounded-xl border">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->slug }}" {{ $categorySlug == $c->slug ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-3 rounded-xl shadow">
                    <i class="fa-solid fa-filter"></i> Filter
                </button>

                <a href="{{ route('customer.menu') }}"
                   class="bg-gray-200 hover:bg-gray-300 px-5 py-3 rounded-xl shadow text-center">
                    Reset
                </a>
            </form>
        </div>

        <!-- Produk Grid -->
        @if($products->count() == 0)
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <p class="text-gray-700">
                    😢 Produk tidak ditemukan. Coba kata kunci lain.
                </p>
            </div>
        @else
            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @foreach($products as $p)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">

                        <!-- Top Icon -->
                        <div class="p-5 bg-gradient-to-r from-gray-900 to-gray-700 text-white">
                            <div class="flex items-center justify-between">
                                <div class="text-sm opacity-90">
                                    {{ $p->category->name ?? '-' }}
                                </div>

                                <div class="text-2xl">
                                    @if(($p->category->slug ?? '') == 'coffee')
                                        <i class="fa-solid fa-mug-hot"></i>
                                    @elseif(($p->category->slug ?? '') == 'non-coffee')
                                        <i class="fa-solid fa-glass-water"></i>
                                    @else
                                        <i class="fa-solid fa-cookie-bite"></i>
                                    @endif
                                </div>
                            </div>

                            <h2 class="text-lg font-bold mt-2">{{ $p->name }}</h2>
                        </div>

                        <!-- Body -->
                        <div class="p-5">
                            <p class="text-sm text-gray-600 min-h-[48px]">
                                {{ $p->description ?? 'Deskripsi belum tersedia.' }}
                            </p>

                            <div class="mt-4 flex justify-between items-center">
                                <div class="font-bold text-orange-600">
                                    Rp {{ number_format($p->price, 0, ',', '.') }}
                                </div>

                                <div class="text-sm text-gray-500">
                                    Stok: {{ $p->stock }}
                                </div>
                            </div>

                            <!-- Tombol (sementara) -->
                            <form method="POST" action="{{ route('cart.add', $p->id) }}">
                                @csrf
                                <button class="mt-4 w-full bg-gray-900 hover:bg-black text-white px-4 py-3 rounded-xl shadow">
                                    <i class="fa-solid fa-cart-shopping"></i> Tambah ke Keranjang
                                </button>
                            </form>

                            <p class="text-xs text-gray-400 mt-2 text-center">
                                *Fitur keranjang kita buat di step berikutnya
                            </p>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @endif

    </div>

</body>
</html>
