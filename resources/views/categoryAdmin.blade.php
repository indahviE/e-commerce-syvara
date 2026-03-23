<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori - GlowSkin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Poppins', sans-serif; }
        tbody tr:hover { background-color: #fdf2f8; }
    </style>
</head>
<body class="bg-gray-50">
    <x-navbar></x-navbar>

    <!-- Header -->
    <section class="py-6 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="bg-pink-500 rounded-2xl border border-white p-8 shadow-sm">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-4xl font-bold mb-2 text-white">Kategori Produk</h1>
                        <p class="text-pink-100">Kelola kategori skincare Anda</p>
                    </div>
                    <a href="/category/create" class="inline-flex items-center px-8 py-4 bg-white text-pink-500 rounded-xl font-bold hover:bg-gray-100 transition">
                        <i class="fas fa-plus mr-3"></i> Tambah Kategori
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- alert sukes yh-->
    <div class="max-w-7xl mx-auto px-4 py-3">
        @if (session('success'))
        <div class="flex items-start gap-4 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg alert-box">
            <i class="fas fa-check-circle text-green-600 text-xl"></i>
            <div><h3 class="font-bold text-green-900 text-sm">Sukses!</h3><p class="text-green-700 text-sm mt-1">{{ session('success') }}</p></div>
            <button class="text-green-600 ml-auto" onclick="this.closest('.alert-box').remove()"><i class="fas fa-times"></i></button>
        </div>
        @endif
    </div>
    <div class="max-w-7xl mx-auto px-4 py-3">
        @if (session('error'))
        <div class="flex items-start gap-4 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg alert-box">
            <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
            <div><h3 class="font-bold text-red-900 text-sm">Terjadi Kesalahan!</h3><p class="text-red-700 text-sm mt-1">{{ session('error') }}</p></div>
            <button class="text-red-600 ml-auto" onclick="this.closest('.alert-box').remove()"><i class="fas fa-times"></i></button>
        </div>
        @endif
    </div>

    <!-- Table -->
    <section class="py-4 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-2xl shadow overflow-hidden">
                @if ($category->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-pink-100 border-b">
                                <th class="px-6 py-4 text-left text-sm font-bold text-pink-900">No</th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-pink-900">Nama Kategori</th>
                                <th class="px-6 py-4 text-center text-sm font-bold text-pink-900">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($category as $data)
                            <tr class="transition">
                                <td class="px-6 py-4 text-gray-700 font-semibold"><span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-pink-100 text-pink-600 text-sm font-bold">{{ $loop->iteration }}</span></td>
                                <td class="px-6 py-4"><div class="flex items-center gap-3"><div class="w-10 h-10 rounded-lg bg-pink-500 flex items-center justify-center"><i class="fas fa-tag text-white"></i></div><div><p class="font-semibold text-gray-900">{{ $data->category_name }}</p><p class="text-xs text-gray-500">Kategori</p></div></div></td>
                                <td class="px-6 py-4 text-center"><div class="flex gap-3 justify-center"><a href="/category/update/{{ $data->id }}" class="px-4 py-2 bg-yellow-50 text-yellow-600 rounded text-sm font-semibold hover:bg-yellow-100 transition"><i class="fas fa-edit mr-1"></i> Edit</a><form action="{{ route('category_delete', $data->id) }}" method="POST" class="inline" onclick="return confirm('Yakin?')">@csrf<button class="px-4 py-2 bg-red-50 text-red-600 rounded text-sm font-semibold hover:bg-red-100 transition"><i class="fas fa-trash mr-1"></i> Hapus</button></form></div></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-20"><i class="fas fa-folder-open text-6xl text-gray-300 mb-4"></i><h3 class="text-2xl font-bold text-gray-700 mb-2">Belum Ada Kategori</h3><p class="text-gray-500 mb-8">Tambahkan kategori pertama untuk produk Anda</p><a href="/category/create" class="inline-block px-8 py-3 bg-pink-600 text-white rounded-lg font-bold hover:bg-pink-700 transition"><i class="fas fa-plus mr-2"></i> Buat Kategori</a></div>
                @endif
            </div>
        </div>
    </section>

    <x-footer></x-footer>
</body>
</html>
