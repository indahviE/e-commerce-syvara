<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Voucher</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-pink-50 min-h-screen">
    <x-navbar />
    <section class="py-10 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Tambah Voucher</h1>
                    <p class="text-gray-600 mt-2">Buat kode voucher baru untuk diskon checkout.</p>
                </div>
                <a href="{{ route('admin.vouchers.index') }}" class="rounded-full bg-gray-100 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-200 transition">Kembali</a>
            </div>

            <div class="rounded-3xl bg-white border border-pink-100 p-8 shadow-sm">
                <form action="{{ route('admin.vouchers.store') }}" method="post" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kode Voucher</label>
                        <input type="text" name="kode" value="{{ old('kode') }}" class="mt-3 w-full rounded-2xl border border-pink-200 bg-pink-50 px-4 py-3" placeholder="Masukkan kode voucher" />
                        @error('kode')<p class="mt-2 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Diskon (%)</label>
                        <input type="number" name="discount" value="{{ old('discount') }}" min="0" max="100" class="mt-3 w-full rounded-2xl border border-pink-200 bg-pink-50 px-4 py-3" placeholder="Contoh: 20" />
                        @error('discount')<p class="mt-2 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status Voucher</label>
                        <select name="is_expired" class="mt-3 w-full rounded-2xl border border-pink-200 bg-pink-50 px-4 py-3">
                            <option value="0" {{ old('is_expired') == '0' ? 'selected' : '' }}>Aktif</option>
                            <option value="1" {{ old('is_expired') == '1' ? 'selected' : '' }}>Expired</option>
                        </select>
                        @error('is_expired')<p class="mt-2 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-pink-600 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:bg-pink-700 transition">
                            <i class="fas fa-save"></i> Simpan Voucher
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
