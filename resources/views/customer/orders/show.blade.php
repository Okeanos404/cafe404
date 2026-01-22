<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Pesanan - CAFE 404</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="min-h-screen bg-gradient-to-r from-orange-200 via-yellow-100 to-white text-gray-900">

    <div class="max-w-5xl mx-auto p-6 md:p-10">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-6 mb-8">
            <div>
                <h1 class="text-4xl font-bold flex items-center gap-3">
                    <i class="fa-solid fa-receipt"></i>
                    Detail Pesanan
                </h1>
                <p class="text-gray-700 mt-2">
                    Lihat detail item yang kamu pesan
                </p>
            </div>

            <a href="{{ route('customer.orders') }}"
               class="bg-gray-900 text-white hover:bg-black px-4 py-2 rounded-xl shadow transition flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </a>
        </div>

        <!-- Info Order -->
        <div class="bg-white p-6 rounded-2xl shadow-lg mb-6">
            <div class="grid md:grid-cols-3 gap-6 items-center">

                <div>
                    <p class="text-gray-500 text-sm">Kode Order</p>
                    <p class="text-2xl font-bold mt-1">{{ $order->order_code }}</p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Metode Pembayaran</p>
                    <p class="font-semibold mt-1">{{ $order->payment_method }}</p>
                </div>

                <div class="md:text-right">
                    <p class="text-gray-500 text-sm">Status</p>

                    <div class="mt-2 inline-flex">
                        @if($order->status == 'pending')
                            <span class="bg-yellow-400 px-4 py-1.5 rounded-full text-black font-semibold text-sm">
                                PENDING
                            </span>
                        @elseif($order->status == 'paid')
                            <span class="bg-green-600 px-4 py-1.5 rounded-full text-white font-semibold text-sm">
                                PAID
                            </span>
                        @else
                            <span class="bg-red-600 px-4 py-1.5 rounded-full text-white font-semibold text-sm">
                                CANCELLED
                            </span>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <!-- Table Items -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-4">Produk</th>
                        <th class="p-4">Harga</th>
                        <th class="p-4">Qty</th>
                        <th class="p-4">Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($order->items as $item)
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="p-4 font-semibold">
                                {{ $item->product->name ?? 'Produk dihapus' }}
                            </td>
                            <td class="p-4">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </td>
                            <td class="p-4">
                                {{ $item->qty }}
                            </td>
                            <td class="p-4 font-bold text-orange-600">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr class="bg-gray-100">
                        <td class="p-4 font-bold" colspan="3">TOTAL</td>
                        <td class="p-4 font-bold text-orange-600">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>

</body>
</html>
