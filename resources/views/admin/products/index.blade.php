<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Admin - CAFE 404</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="min-h-screen bg-gradient-to-r from-gray-900 via-gray-800 to-black text-white">

    <div class="max-w-6xl mx-auto p-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold"><i class="fa-solid fa-boxes-stacked"></i> Kelola Produk</h1>
                <p class="text-gray-300 mt-1">Tambah, edit, dan hapus produk CAFE 404</p>
            </div>

            <div class="flex gap-3">
                <a href="/admin/dashboard" class="bg-white/10 hover:bg-white/20 px-4 py-2 rounded-xl">
                    <i class="fa-solid fa-house"></i> Dashboard
                </a>

                <a href="/admin/products/create" class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded-xl shadow-lg">
                    <i class="fa-solid fa-plus"></i> Tambah Produk
                </a>
            </div>
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
                        <th class="p-4">No</th>
                        <th class="p-4">Nama</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Harga</th>
                        <th class="p-4">Stok</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $index => $p)
                        <tr class="border-b border-white/10 hover:bg-white/5">
                            <td class="p-4">{{ $products->firstItem() + $index }}</td>
                            <td class="p-4 font-semibold">{{ $p->name }}</td>
                            <td class="p-4">{{ $p->category->name ?? '-' }}</td>
                            <td class="p-4">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                            <td class="p-4">{{ $p->stock }}</td>
                            <td class="p-4">
                                @if($p->is_active)
                                    <span class="bg-green-600 px-3 py-1 rounded-full text-sm">Aktif</span>
                                @else
                                    <span class="bg-gray-500 px-3 py-1 rounded-full text-sm">Nonaktif</span>
                                @endif
                            </td>
                            <td class="p-4 flex gap-2">
                                <a href="/admin/products/{{ $p->id }}/edit"
                                   class="bg-blue-600 hover:bg-blue-700 px-3 py-2 rounded-xl">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <form action="/admin/products/{{ $p->id }}" method="POST"
                                      onsubmit="return confirm('Yakin hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 hover:bg-red-700 px-3 py-2 rounded-xl">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>

</body>
</html>
