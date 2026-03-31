<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syavara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Poppins', sans-serif; }
        input:focus, select:focus, textarea:focus { outline: none; box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1); border-color: #ec4899; }
    </style>
</head>
<body class="bg-gray-50">
    <x-navbar></x-navbar>

    <!-- Header -->
    <section class="py-6 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-2xl border border-yellow-100 p-8 shadow-sm mb-6">
                <div class="flex items-center gap-4 mb-4">
                    <a href="/product" class="flex items-center gap-2 text-yellow-600 hover:text-yellow-700 transition font-semibold">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <h1 class="text-4xl font-bold mb-2 text-gray-900">Edit Produk</h1>
                <p class="text-gray-600">Perbarui informasi produk skincare Anda</p>
            </div>
        </div>
    </section>

    <!-- Form -->
    <section class="py-2 px-2">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-yellow-100">
                <div class="p-8">
                    <form action="{{ route('product_update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                <i class="fas fa-heading mr-2 text-yellow-600"></i> Nama Produk
                            </label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                class="w-full border-2 border-gray-200 rounded-lg px-4 py-3">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">
                                <i class="fas fa-list mr-2 text-yellow-600"></i> Kategori (Pilih 1 atau lebih)
                            </label>

                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-2">
                                @foreach ($categories as $cat)
                                    <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-yellow-300 hover:bg-yellow-50 transition"
                                        data-category="{{ $cat->id }}">
                                        <input type="checkbox" name="category_ids[]" value="{{ $cat->id }}"
                                            {{ in_array($cat->id, old('category_ids', $product->categoryIds)) ? 'checked' : '' }}
                                            class="w-5 h-5 text-yellow-600 rounded cursor-pointer category-checkbox">
                                        <span class="flex-1 font-semibold text-gray-700">{{ $cat->category_name }}</span>
                                    </label>
                                @endforeach
                            </div>

                            <div id="selectedCategories" class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg hidden">
                                <p class="text-sm font-semibold text-gray-700 mb-2">Kategori Terpilih:</p>
                                <div id="selectedList" class="flex flex-wrap gap-2"></div>
                            </div>

                            @error('category_ids')
                                <div class="mt-2 p-3 bg-red-50 border border-red-300 rounded-lg text-red-700 text-sm flex items-center gap-2">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fas fa-dollar-sign mr-2 text-yellow-600"></i> Harga
                                </label>
                                <input type="number" name="price" value="{{ old('price', $product->price) }}"
                                    class="w-full border-2 border-gray-200 rounded-lg px-4 py-3">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fas fa-boxes mr-2 text-yellow-600"></i> Stok
                                </label>
                                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                                    class="w-full border-2 border-gray-200 rounded-lg px-4 py-3">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                <i class="fas fa-align-left mr-2 text-yellow-600"></i> Deskripsi
                            </label>
                            <textarea rows="5" name="description"
                                class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 resize-none">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                <i class="fas fa-image mr-2 text-yellow-600"></i> Gambar Produk (Opsional)
                            </label>
                            @if ($product->image)
                                <p class="text-sm text-gray-600 mb-3">Gambar saat ini:</p>
                                <div class="mb-4 rounded-lg overflow-hidden border border-gray-200" style="max-width: 200px;">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto">
                                </div>
                            @endif
                            <input type="file" name="gambar" accept="image/*"
                                class="w-full border-2 border-gray-200 rounded-lg px-4 py-3">
                        </div>

                        <div class="flex gap-4 pt-4 border-t border-gray-200">
                            <button type="reset" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-bold hover:bg-gray-50 transition">
                                <i class="fas fa-redo mr-2"></i> Reset
                            </button>
                            <button type="submit" class="flex-1 px-6 py-3 bg-yellow-600 text-white rounded-lg font-bold hover:bg-yellow-700 transition">
                                <i class="fas fa-save mr-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <x-footer></x-footer>

    <script>
        const checkboxes = document.querySelectorAll('.category-checkbox');
        const selectedCategories = document.getElementById('selectedCategories');
        const selectedList = document.getElementById('selectedList');

        function updateSelectedCategories() {
            const selected = Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.closest('label').querySelector('span').textContent.trim());

            if (selected.length > 0) {
                selectedCategories.classList.remove('hidden');
                selectedList.innerHTML = selected.map(cat =>
                    `<span class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-600 text-white rounded-full text-sm font-semibold">
                        ${cat}
                        <i class="fas fa-check"></i>
                    </span>`
                ).join('');
            } else {
                selectedCategories.classList.add('hidden');
                selectedList.innerHTML = '';
            }
        }

        checkboxes.forEach(checkbox => checkbox.addEventListener('change', updateSelectedCategories));
        updateSelectedCategories();
    </script>
</body>
</html>
