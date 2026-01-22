<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders - CAFE 404</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="min-h-screen bg-gradient-to-r from-gray-900 via-gray-800 to-black text-white">
    <div class="max-w-6xl mx-auto p-8">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold"><i class="fa-solid fa-clipboard-list"></i> Data Pesanan</h1>
                <p class="text-gray-300 mt-2">Semua pesanan customer CAFE 404</p>
            </div>

            <a href="{{ route('admin.dashboard') }}"
               class="bg-white/10 hover:bg-white/20 px-4 py-2 rounded-xl">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-600/80 p-4 rounded-xl mb-4 shadow">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white/10 rounded-2xl shadow-xl overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-white/10">
                    <tr>
                        <th class="p-4">Order Code</th>
                        <th class="p-4">Customer</th>
                        <th class="p-4">Total</th>
                        <th class="p-4">Payment</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $o)
                        <tr class="border-b border-white/10 hover:bg-white/5">
                            <td class="p-4 font-semibold">{{ $o->order_code }}</td>
                            <td class="p-4">{{ $o->user->name ?? '-' }}</td>
                            <td class="p-4">Rp {{ number_format($o->total_price, 0, ',', '.') }}</td>
                            <td class="p-4">{{ $o->payment_method }}</td>
                            <td class="p-4">
                                @if($o->status == 'pending')
                                    <span class="bg-yellow-400 text-black px-3 py-1 rounded-full text-sm">PENDING</span>
                                @elseif($o->status == 'paid')
                                    <span class="bg-green-600 px-3 py-1 rounded-full text-sm">PAID</span>
                                @else
                                    <span class="bg-red-600 px-3 py-1 rounded-full text-sm">CANCELLED</span>
                                @endif
                            </td>
                            <td class="p-4">
                                <a href="{{ route('admin.orders.show', $o->id) }}"
                                   class="bg-blue-600 hover:bg-blue-700 px-3 py-2 rounded-xl">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>

    </div>
</body>
</html>
