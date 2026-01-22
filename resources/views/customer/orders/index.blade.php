<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - CAFE 404</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="min-h-screen bg-gradient-to-r from-orange-200 via-yellow-100 to-white text-gray-900">
    <div class="max-w-6xl mx-auto p-8">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold"><i class="fa-solid fa-receipt"></i> Riwayat Pesanan</h1>
                <p class="text-gray-700 mt-2">Semua pesanan kamu di CAFE 404</p>
            </div>

            <a href="{{ route('customer.dashboard') }}"
               class="bg-gray-900 text-white hover:bg-black px-4 py-2 rounded-xl shadow">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-600/80 text-white p-4 rounded-xl mb-4 shadow">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        @if($orders->count() == 0)
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <p>Kamu belum punya pesanan 😄</p>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-4">Kode</th>
                            <th class="p-4">Total</th>
                            <th class="p-4">Pembayaran</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $o)
                            <tr class="border-t">
                                <td class="p-4 font-semibold">
                                    <a href="{{ route('customer.orders.show', $o->id) }}" class="text-blue-600 hover:underline">
                                        {{ $o->order_code }}
                                    </a>
                                </td>

                                <td class="p-4 font-bold text-orange-600">
                                    Rp {{ number_format($o->total_price, 0, ',', '.') }}
                                </td>
                                <td class="p-4">{{ $o->payment_method }}</td>
                                <td class="p-4">
                                    <span class="bg-yellow-400 text-black px-3 py-1 rounded-full text-sm">
                                        {{ strtoupper($o->status) }}
                                    </span>
                                </td>
                                <td class="p-4 text-gray-600">{{ $o->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @endif

    </div>
</body>
</html>
