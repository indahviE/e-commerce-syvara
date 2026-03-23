<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - GlowSkin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Poppins', sans-serif; }
        .product-card:hover { transform: translateY(-4px); box-shadow: 0 8px 16px rgba(236, 72, 153, 0.1); }
        .product-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease; }
        .product-card:hover .product-img img { transform: scale(1.05); }
    </style>
</head>
<body class="bg-gray-50">
    <x-navbar></x-navbar>

    <!-- Alert Success -->
    <div class="max-w-7xl mx-auto px-4 py-3">
        @if (session('success'))
        <div class="flex items-start gap-4 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg alert-box">
            <i class="fas fa-check-circle text-green-600 text-xl flex-shrink-0 mt-0.5"></i>
            <div><h3 class="font-bold text-green-900 text-sm">Sukses!</h3><p class="text-green-700 text-sm mt-1">{{ session('success') }}</p></div>
            <button class="text-green-600 ml-auto" onclick="this.closest('.alert-box').remove()"><i class="fas fa-times"></i></button>
        </div>
        @endif
    </div>

    <section class="max-w-7xl mx-auto px-4 py-8">
        @if ($products->count() > 0)

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-gray-900 text-lg">Kelola Produk</h3>
                <a href="/product/create" class="inline-flex items-center px-6 py-2 bg-pink-600 text-white rounded-lg font-semibold hover:bg-pink-700 transition">
                    <i class="fas fa-plus mr-2"></i> Tambah Produk
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2 font-semibold text-gray-700">Produk</th>
                            <th class="text-left py-2 font-semibold text-gray-700">Gambar</th>
                            <th class="text-left py-2 font-semibold text-gray-700">Deskripsi</th>
                            <th class="text-left py-2 font-semibold text-gray-700">Harga</th>
                            <th class="text-left py-2 font-semibold text-gray-700">Stok</th>
                            <th class="text-center py-2 font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $data)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 text-gray-900 font-medium">{{ $data->name }}</td>
                            <td class="py-3">
                                <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->name }}" class="w-16 h-16 object-cover">
                            </td>
                            <td class="py-3 text-gray-700 text-sm max-w-xs">
                                {{ Str::limit($data->description, 30, '...') }}
                            </td>
                            <td class="py-3 text-pink-600 font-semibold">Rp {{ number_format($data->price, 0, ',', '.') }}</td>
                            <td class="py-3 text-gray-700">{{ $data->stock }}</td>
                            <td class="py-3 text-center">
                                <div class="flex gap-2 justify-center">
                                    <a href="/product/update/{{ $data->id }}" class="px-3 py-1 bg-yellow-50 text-yellow-600 rounded text-xs font-semibold hover:bg-yellow-100 transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('product_delete', $data->id) }}" method="POST" class="inline" onclick="return confirm('Yakin hapus?')">
                                        @csrf
                                        <button class="px-3 py-1 bg-red-50 text-red-600 rounded text-xs font-semibold hover:bg-red-100 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="text-center py-20 bg-white rounded-lg border border-gray-200">
            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-2xl font-bold text-gray-700 mb-2">Belum Ada Produk</h3>
            <p class="text-gray-500 mb-8">Mulai tambahkan produk untuk memulai bisnis Anda</p>
            <a href="/product/create" class="inline-block px-8 py-3 bg-pink-600 text-white rounded-lg font-bold hover:bg-pink-700 transition">
                <i class="fas fa-plus mr-2"></i> Buat Produk Pertama
            </a>
        </div>
        @endif
    </section>

    <x-footer></x-footer>
</body>
</html>
