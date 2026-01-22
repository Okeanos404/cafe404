<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - CAFE 404</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="min-h-screen bg-gradient-to-r from-orange-200 via-yellow-100 to-white text-gray-900">
    <div class="max-w-6xl mx-auto p-8">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold"><i class="fa-solid fa-cart-shopping"></i> Keranjang</h1>
                <p class="text-gray-700 mt-2">Cek pesananmu sebelum checkout</p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('customer.menu') }}" class="bg-gray-900 text-white hover:bg-black px-4 py-2 rounded-xl shadow">
                    <i class="fa-solid fa-store"></i> Menu
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-600/80 text-white p-4 rounded-xl mb-4 shadow">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        @if(count($cart) == 0)
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <p>Keranjang masih kosong 😄</p>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-4">Produk</th>
                            <th class="p-4">Harga</th>
                            <th class="p-4">Qty</th>
                            <th class="p-4">Subtotal</th>
                            <th class="p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp

                        @foreach($cart as $item)
                            @php $subtotal = $item['price'] * $item['qty']; @endphp
                            @php $total += $subtotal; @endphp

                            <tr class="border-t">
                                <td class="p-4 font-semibold">{{ $item['name'] }}</td>
                                <td class="p-4">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>

                                <td class="p-4">
                                    <form method="POST" action="{{ route('cart.update', $item['id']) }}" class="flex gap-2">
                                        @csrf
                                        <input type="number" name="qty" value="{{ $item['qty'] }}" min="1"
                                               class="w-20 p-2 border rounded-lg">

                                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg">
                                            <i class="fa-solid fa-rotate"></i>
                                        </button>
                                    </form>
                                </td>

                                <td class="p-4 font-bold text-orange-600">
                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                </td>

                                <td class="p-4">
                                    <form method="POST" action="{{ route('cart.remove', $item['id']) }}"
                                          onsubmit="return confirm('Hapus item ini?')">
                                        @csrf
                                        <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        <tr class="bg-gray-100">
                            <td class="p-4 font-bold" colspan="3">TOTAL</td>
                            <td class="p-4 font-bold text-orange-600">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </td>
                            <td class="p-4"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between items-center mt-6">
                <form method="POST" action="{{ route('cart.clear') }}">
                    @csrf
                    <button class="bg-gray-200 hover:bg-gray-300 px-5 py-3 rounded-xl shadow">
                        <i class="fa-solid fa-broom"></i> Bersihkan Keranjang
                    </button>
                </form>

                <a href="{{ route('customer.checkout') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl shadow-lg">
                    <i class="fa-solid fa-credit-card"></i> Checkout
                </a>
            </div>
        @endif

    </div>
</body>
</html>
