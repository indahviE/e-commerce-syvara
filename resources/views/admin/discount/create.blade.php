<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Diskon Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-pink-50 min-h-screen">
    <x-navbar />
    <section class="py-10 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Tambah Diskon Produk</h1>
                    <p class="text-gray-600 mt-2">Berikan diskon khusus untuk produk tertentu.</p>
                </div>
                <a href="{{ route('admin.vouchers.index') }}" class="rounded-full bg-gray-100 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-200 transition">Kembali</a>
            </div>

            <div class="rounded-3xl bg-white border border-pink-100 p-8 shadow-sm">
                <form action="{{ route('admin.discounts.store') }}" method="post" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Pilih Produk</label>
                        <select name="products_id" class="w-full rounded-2xl border border-pink-200 bg-pink-50 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-500" required>
                            <option value="">-- Pilih Produk --</option>
                            @forelse($products as $product)
                                <option value="{{ $product->id }}" {{ old('products_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }} (Rp {{ number_format($product->price, 0, ',', '.') }})
                                </option>
                            @empty
                                <option value="" disabled>Semua produk sudah memiliki diskon</option>
                            @endforelse
                        </select>
                        @error('products_id')<p class="mt-2 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Tipe Diskon</label>
                            <select name="discount_type" id="discount_type" class="w-full rounded-2xl border border-pink-200 bg-pink-50 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-500" onchange="updateDiscountLabel()" required>
                                <option value="">-- Pilih Tipe --</option>
                                <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
                                <option value="nominal" {{ old('discount_type') == 'nominal' ? 'selected' : '' }}>Nominal (Rp)</option>
                            </select>
                            @error('discount_type')<p class="mt-2 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Nilai Diskon
                                <span id="discount_label" class="text-xs text-gray-500">(Persentase)</span>
                            </label>
                            <div class="flex items-center gap-2">
                                <input
                                    type="number"
                                    name="discount_value"
                                    value="{{ old('discount_value') }}"
                                    min="1"
                                    class="w-full rounded-2xl border border-pink-200 bg-pink-50 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-500"
                                    placeholder="Contoh: 20"
                                    required
                                />
                                <span id="discount_unit" class="text-sm font-medium text-gray-600 min-w-fit">%</span>
                            </div>
                            @error('discount_value')<p class="mt-2 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Berlaku Sampai</label>
                        <input
                            type="date"
                            name="valid_until"
                            value="{{ old('valid_until') }}"
                            class="w-full rounded-2xl border border-pink-200 bg-pink-50 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-500"
                            required
                        />
                        @error('valid_until')<p class="mt-2 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="rounded-2xl bg-blue-50 border border-blue-200 p-4">
                        <p class="text-xs text-blue-700">
                            <i class="fas fa-info-circle mr-2"></i>
                            <strong>Catatan:</strong> Diskon akan otomatis dihitung saat checkout berdasarkan tipe dan nilai yang Anda tentukan.
                        </p>
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-pink-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:bg-pink-700 transition">
                            <i class="fas fa-save"></i> Simpan Diskon
                        </button>
                        <a href="{{ route('admin.vouchers.index') }}" class="inline-flex items-center gap-2 rounded-full bg-gray-200 px-6 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-300 transition">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        function updateDiscountLabel() {
            const type = document.getElementById('discount_type').value;
            const label = document.getElementById('discount_label');
            const unit = document.getElementById('discount_unit');

            if (type === 'percentage') {
                label.textContent = '(Persentase)';
                unit.textContent = '%';
            } else if (type === 'nominal') {
                label.textContent = '(Nominal Rp)';
                unit.textContent = 'Rp';
            } else {
                label.textContent = '';
                unit.textContent = '';
            }
        }

        // Trigger on page load jika ada old value
        document.addEventListener('DOMContentLoaded', updateDiscountLabel);
    </script>
</body>
</html>