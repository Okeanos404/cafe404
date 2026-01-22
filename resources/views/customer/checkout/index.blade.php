<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - CAFE 404</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="min-h-screen bg-gradient-to-r from-orange-200 via-yellow-100 to-white text-gray-900">
    <div class="max-w-5xl mx-auto p-8">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold"><i class="fa-solid fa-credit-card"></i> Checkout</h1>
                <p class="text-gray-700 mt-2">Total otomatis dihitung, pilih metode pembayaran</p>
            </div>

            <a href="{{ route('customer.cart') }}" class="bg-gray-900 text-white hover:bg-black px-4 py-2 rounded-xl shadow">
                <i class="fa-solid fa-arrow-left"></i> Keranjang
            </a>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-lg mb-6">
            <h2 class="text-xl font-bold mb-4">🧾 Ringkasan Pesanan</h2>

            <ul class="space-y-2">
                @foreach($cart as $item)
                    <li class="flex justify-between">
                        <span>{{ $item['name'] }} x{{ $item['qty'] }}</span>
                        <span class="font-semibold">
                            Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                        </span>
                    </li>
                @endforeach
            </ul>

            <hr class="my-4">

            <div class="flex justify-between text-lg font-bold">
                <span>Total</span>
                <span class="text-orange-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>

        <form method="POST" action="{{ route('checkout.process') }}" class="bg-white p-6 rounded-2xl shadow-lg">
            @csrf

            <h2 class="text-xl font-bold mb-4">💳 Pilih Metode Pembayaran</h2>

            <select name="payment_method" required class="w-full p-3 rounded-xl border mb-5">
                <option value="">-- Pilih Metode Pembayaran --</option>

                <optgroup label="Bank Transfer">
                    <option value="BCA">Bank BCA</option>
                    <option value="MANDIRI">Bank Mandiri</option>
                    <option value="BRI">Bank BRI</option>
                    <option value="BNI">Bank BNI</option>
                </optgroup>

                <optgroup label="Dompet Digital">
                    <option value="DANA">DANA</option>
                    <option value="GOPAY">GO-PAY</option>
                    <option value="SHOPEEPAY">ShopeePay</option>
                </optgroup>

                <optgroup label="QR Code">
                    <option value="QRIS">QRIS</option>
                </optgroup>
            </select>

            <button class="w-full bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl shadow-lg">
                <i class="fa-solid fa-bolt"></i> Proses Pembayaran
            </button>

            <p class="text-xs text-gray-500 mt-3 text-center">
                *Ini masih simulasi pembayaran (status order = pending)
            </p>
        </form>

    </div>
</body>
</html>
