<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syvara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Poppins', sans-serif; }
        input:focus { outline: none; box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1); border-color: #ec4899; }
    </style>
</head>
<body class="bg-gray-50">
    <x-navbar></x-navbar>

    <!-- Header -->
    <section class="py-6 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-2xl border border-pink-100 p-8 shadow-sm mb-6">
                <div class="flex items-center gap-4 mb-4">
                    <a href="/category" class="flex items-center gap-2 text-pink-600 hover:text-pink-700 transition font-semibold">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <h1 class="text-4xl font-bold mb-2 text-gray-900">Tambah Kategori Baru</h1>
                <p class="text-gray-600">Buat kategori produk baru untuk mengorganisir koleksi Anda</p>
            </div>
        </div>
    </section>

    <!-- Form -->
    <section class="py-2 px-2">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-pink-100">
                <div class="p-8">
                    <form action="{{ route('category_create') }}" method="POST" class="space-y-8">
                        @csrf

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">
                                <i class="fas fa-tag mr-2 text-pink-600"></i> Nama Kategori
                            </label>
                            <input type="text" name="category_name" placeholder="Contoh: Face Care, Body Care, Hair Care" value="{{ old('category_name') }}"
                                class="w-full border-2 border-gray-200 rounded-lg px-5 py-3 text-gray-700">
                            @error('category_name')
                                <div class="mt-3 p-4 bg-red-50 border border-red-300 rounded-lg text-red-700 text-sm flex items-center gap-3">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                            <p class="text-gray-500 text-xs mt-2">Masukkan nama kategori yang jelas dan mudah diingat</p>
                        </div>

                        <div class="flex gap-4 pt-4 border-t border-gray-200">
                            <button type="reset" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-bold hover:bg-gray-50 transition">
                                <i class="fas fa-redo mr-2"></i> Reset
                            </button>
                            <button type="submit" class="flex-1 px-6 py-3 bg-pink-600 text-white rounded-lg font-bold hover:bg-pink-700 transition">
                                <i class="fas fa-save mr-2"></i> Simpan Kategori
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <x-footer></x-footer>
</body>
</html>
