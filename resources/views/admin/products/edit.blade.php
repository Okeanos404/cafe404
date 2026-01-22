<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - CAFE 404</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="min-h-screen bg-gradient-to-r from-gray-900 via-gray-800 to-black text-white">

    <div class="max-w-4xl mx-auto p-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold"><i class="fa-solid fa-pen"></i> Edit Produk</h1>
                <p class="text-gray-300 mt-1">Update data produk</p>
            </div>

            <a href="/admin/products" class="bg-white/10 hover:bg-white/20 px-4 py-2 rounded-xl">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-600/80 p-4 rounded-xl mb-4">
                <b>Oops!</b> ada error:
                <ul class="list-disc ml-6 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/admin/products/{{ $product->id }}" method="POST" class="bg-white/10 p-6 rounded-2xl shadow-xl">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-2">Kategori</label>
                <select name="category_id" class="w-full p-3 rounded-xl text-black">
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ $product->category_id == $c->id ? 'selected' : '' }}>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-2">Nama Produk</label>
                <input type="text" name="name" class="w-full p-3 rounded-xl text-black"
                       value="{{ $product->name }}">
            </div>

            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block mb-2">Harga (Rp)</label>
                    <input type="number" name="price" class="w-full p-3 rounded-xl text-black"
                           value="{{ $product->price }}">
                </div>
                <div>
                    <label class="block mb-2">Stok</label>
                    <input type="number" name="stock" class="w-full p-3 rounded-xl text-black"
                           value="{{ $product->stock }}">
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-2">Deskripsi</label>
                <textarea name="description" class="w-full p-3 rounded-xl text-black" rows="3">{{ $product->description }}</textarea>
            </div>

            <div class="mb-6 flex items-center gap-2">
                <input type="checkbox" name="is_active" {{ $product->is_active ? 'checked' : '' }}>
                <label>Aktifkan produk</label>
            </div>

            <button class="bg-blue-600 hover:bg-blue-700 px-5 py-3 rounded-xl shadow-lg w-full">
                <i class="fa-solid fa-floppy-disk"></i> Update Produk
            </button>
        </form>
    </div>

</body>
</html>
