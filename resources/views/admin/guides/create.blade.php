<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Panduan Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-pink-50 min-h-screen">
    <x-navbar />
    <section class="py-10 px-4">
        <div class="max-w-4xl mx-auto bg-white rounded-[36px] border border-pink-100 p-8 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Tambah Panduan Produk</h1>
                    <p class="text-gray-600 mt-2">Tambahkan panduan penggunaan yang muncul di halaman detail produk.</p>
                </div>
                <a href="{{ route('admin.guides.index') }}" class="rounded-full bg-gray-100 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-200 transition">Kembali</a>
            </div>

            <form action="{{ route('admin.guides.store') }}" method="post" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Produk</label>
                    <select name="produk_id" class="w-full rounded-2xl border border-pink-200 bg-pink-50 px-4 py-3">
                        <option value="">Pilih produk</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('produk_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                        @endforeach
                    </select>
                    @error('produk_id')<p class="text-sm text-red-600 mt-2">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Frekuensi</label>
                        <input type="text" name="frekuensi" value="{{ old('frekuensi') }}" class="w-full rounded-2xl border border-pink-200 bg-pink-50 px-4 py-3" placeholder="1-2 kali sehari">
                        @error('frekuensi')<p class="text-sm text-red-600 mt-2">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Waktu Terbaik</label>
                        <input type="text" name="waktu_terbaik" value="{{ old('waktu_terbaik') }}" class="w-full rounded-2xl border border-pink-200 bg-pink-50 px-4 py-3" placeholder="Pagi dan malam sebelum tidur">
                        @error('waktu_terbaik')<p class="text-sm text-red-600 mt-2">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Cara Pakai</label>
                    <textarea name="cara_pakai" rows="4" class="w-full rounded-2xl border border-pink-200 bg-pink-50 px-4 py-3" placeholder="Oleskan secara merata ke wajah yang sudah dibersihkan">{{ old('cara_pakai') }}</textarea>
                    @error('cara_pakai')<p class="text-sm text-red-600 mt-2">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Hasil</label>
                    <textarea name="hasil" rows="4" class="w-full rounded-2xl border border-pink-200 bg-pink-50 px-4 py-3" placeholder="Terlihat dalam 2-4 minggu penggunaan teratur">{{ old('hasil') }}</textarea>
                    @error('hasil')<p class="text-sm text-red-600 mt-2">{{ $message }}</p>@enderror
                </div>

                <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-pink-600 px-6 py-3 text-white font-semibold hover:bg-pink-700 transition">
                    <i class="fas fa-save"></i> Simpan Panduan
                </button>
            </form>
        </div>
    </section>
</body>
</html>
