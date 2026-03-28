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
        tbody tr {
            transition: all 0.3s ease;
        }
        tbody tr:hover {
            background-color: #fdf2f8;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(236, 72, 153, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <x-navbar></x-navbar>

    <!-- Hero Section -->
    <section class="relative pt-8 pb-6 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="bg-pink-500 rounded-3xl p-8 sm:p-12 shadow-xl">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <h1 class="text-4xl md:text-5xl font-bold mb-3 text-white flex items-center gap-3">
                            <i class="fas fa-sparkles"></i>Kategori Produk
                        </h1>
                        <p class="text-pink-100 text-lg">Jelajahi kategori skincare sesuai dengan kebutuhan kulit Anda</p>
                    </div>
                    <a href="/about"
                        class="inline-flex items-center gap-2 px-8 py-4 bg-white text-pink-600 rounded-xl font-bold hover:bg-pink-50 hover:shadow-lg transition duration-300 whitespace-nowrap">
                        <i class="fas fa-info-circle"></i> Pelajari Lebih
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-12 px-4">
        <div class="max-w-7xl mx-auto">
            @if ($category->count() > 0)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                    <!-- Table Header Info -->
                    <div class="px-6 py-4 bg-gradient-to-r from-pink-50 to-pink-100 border-b border-pink-200">
                        <p class="text-gray-600 font-medium">
                            <i class="fas fa-list text-pink-500 mr-2"></i>
                            Total {{ $category->count() }} Kategori
                        </p>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-pink-100 to-pink-50 border-b-2 border-pink-200">
                                    <th class="px-6 py-4 text-left text-sm font-bold text-pink-900 w-16">No</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-pink-900">Nama Kategori</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($category as $data)
                                <tr class="hover:bg-pink-50 cursor-pointer">
                                    <td class="px-6 py-5">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-br from-pink-400 to-pink-500 text-white text-sm font-bold shadow-sm">
                                            {{ $loop->iteration }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <a href="/category/{{ $data->id }}" class="flex items-center gap-4 hover:opacity-80 transition">
                                            <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-pink-400 to-pink-500 flex items-center justify-center shadow-md">
                                                <i class="fas fa-tag text-white text-lg"></i>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-900 text-base">{{ $data->category_name }}</p>
                                                <p class="text-xs text-gray-500 mt-1">Kategori Produk</p>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center border border-gray-100">
                    <div class="mb-6">
                        <i class="fas fa-folder-open text-6xl text-gray-300 mb-4 block"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Kategori</h3>
                    <p class="text-gray-500 mb-6 text-base">Tambahkan kategori pertama untuk mulai menampilkan produk Anda</p>
                    <a href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-pink-500 text-white rounded-lg font-semibold hover:bg-pink-600 transition duration-300">
                        <i class="fas fa-plus"></i>
                        Tambah Kategori
                    </a>
                </div>
            @endif
        </div>
    </section>

    <x-footer></x-footer>
</body>
</html>
