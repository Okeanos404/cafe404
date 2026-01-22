<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Order Admin - CAFE 404</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="min-h-screen bg-gradient-to-r from-gray-900 via-gray-800 to-black text-white">
    <div class="max-w-6xl mx-auto p-8">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold"><i class="fa-solid fa-receipt"></i> Detail Order</h1>
                <p class="text-gray-300 mt-2">{{ $order->order_code }}</p>
            </div>

            <a href="{{ route('admin.orders') }}"
               class="bg-white/10 hover:bg-white/20 px-4 py-2 rounded-xl">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-600/80 p-4 rounded-xl mb-4 shadow">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white/10 p-6 rounded-2xl shadow-xl">
                <h2 class="font-bold text-lg mb-2">👤 Customer</h2>
                <p><b>Nama:</b> {{ $order->user->name ?? '-' }}</p>
                <p><b>Email:</b> {{ $order->user->email ?? '-' }}</p>
            </div>

            <div class="bg-white/10 p-6 rounded-2xl shadow-xl">
                <h2 class="font-bold text-lg mb-2">💳 Info Pembayaran</h2>
                <p><b>Metode:</b> {{ $order->payment_method }}</p>
                <p><b>Total:</b> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>

                <form method="POST" action="{{ route('admin.orders.status', $order->id) }}" class="mt-4">
                    @csrf
                    <label class="block mb-2 font-semibold">Update Status</label>

                    <div class="flex gap-2">
                        <select name="status" class="text-black p-2 rounded-xl w-full">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>PENDING</option>
                            <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>PAID</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>CANCELLED</option>
                        </select>

                        <button class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded-xl">
                            <i class="fa-solid fa-floppy-disk"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-white/10 rounded-2xl shadow-xl overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-white/10">
                    <tr>
                        <th class="p-4">Produk</th>
                        <th class="p-4">Harga</th>
                        <th class="p-4">Qty</th>
                        <th class="p-4">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr class="border-b border-white/10">
                            <td class="p-4 font-semibold">{{ $item->product->name ?? 'Produk dihapus' }}</td>
                            <td class="p-4">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="p-4">{{ $item->qty }}</td>
                            <td class="p-4 font-bold text-yellow-300">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>
