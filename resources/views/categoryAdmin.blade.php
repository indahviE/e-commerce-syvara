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

        <!-- alert sukes yh-->
        <div class="max-w-7xl mx-auto px-4 py-3">
            @if (session('success'))
            <div class="flex items-start gap-4 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg alert-box">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                <div><h3 class="font-bold text-green-900 text-sm">Sukses!</h3><p class="text-green-700 text-sm mt-1">{{ session('success') }}</p></div>
                <button class="text-green-600 ml-auto" onclick="this.closest('.alert-box').remove()"><i class="fas fa-times"></i></button>
            </div>
            @endif

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
            <div class="bg-white rounded-lg border border-gray-200 p-6 mx-40">

        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-gray-900 text-lg">Kelola Kategori</h3>
            <a href="/category/create"
            class="inline-flex items-center px-6 py-2 bg-pink-600 text-white rounded-lg font-semibold hover:bg-pink-700 transition">
                <i class="fas fa-plus mr-2"></i> Tambah Kategori
            </a>
        </div>

        @if ($category->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm border-separate border-spacing-y-2">
                <thead>
                    <tr class="bg-white shadow-sm rounded-lg hover:bg-gray-50 transition">
                        <th class="text-left py-2 px-3 font-semibold text-gray-700">No</th>
                        <th class="text-left py-2 px-3 font-semibold text-gray-700">Kategori</th>
                        <th class="text-center py-2 px-3 font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $data)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="py-4 px-3 text-gray-900 font-medium">
                            {{ $loop->iteration }}
                        </td>

                        <td class="py-4 px-3">
                            <span class="inline-block bg-pink-100 text-pink-600 text-sm px-3 py-1 rounded-full">
                                {{ $data->category_name }}
                            </span>
                        </td>

                        <td class="py-4 px-3 text-center">
                            <div class="flex gap-2 justify-center">
                                <a href="/category/update/{{ $data->id }}"
                                class="px-3 py-1 bg-yellow-50 text-yellow-600 rounded text-xs font-semibold hover:bg-yellow-100 transition">
                                    Edit
                                </a>

                                <form action="{{ route('category_delete', $data->id) }}" method="POST"
                                    class="inline" onclick="return confirm('Yakin hapus?')">
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
        @else
            <div class="text-center py-20 bg-white rounded-lg border border-gray-200">
                <i class="fas fa-folder-open text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">Belum Ada Kategori</h3>
                <p class="text-gray-500 mb-8">Tambahkan kategori pertama</p>
            </div>
        @endif
    </div>
    <div class="mt-6 flex justify-center">
        {{ $category->links() }}
    </div>
        </section>

        <x-footer></x-footer>
    </body>
    </html>
