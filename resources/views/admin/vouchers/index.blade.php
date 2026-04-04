<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Promosi & Diskon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <x-navbar />
    <section class="py-10 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Promosi & Diskon</h1>
                <p class="text-gray-600 mt-2">Kelola voucher dan diskon produk yang dapat digunakan customer.</p>
            </div>

            @if(session('success'))
                <div class="mb-6 rounded-2xl bg-green-50 border border-green-200 p-4 text-green-700 flex items-start gap-3">
                    <i class="fas fa-check-circle flex-shrink-0 mt-0.5"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Tabs Navigation -->
            <div class="bg-white rounded-t-3xl border border-b-0 border-pink-100 flex gap-0">
                <button
                    type="button"
                    onclick="switchTab('vouchers')"
                    id="tab-vouchers-btn"
                    class="tab-btn active flex-1 px-6 py-4 text-sm font-semibold text-pink-600 border-b-2 border-pink-600 transition hover:bg-pink-50">
                    <i class="fas fa-ticket-alt mr-2"></i> Voucher
                </button>
                <button
                    type="button"
                    onclick="switchTab('discounts')"
                    id="tab-discounts-btn"
                    class="tab-btn flex-1 px-6 py-4 text-sm font-semibold text-gray-600 border-b-2 border-transparent transition hover:bg-pink-50">
                    <i class="fas fa-percentage mr-2"></i> Diskon Produk
                </button>
            </div>

            <!-- TAB: VOUCHERS -->
            <div id="content-vouchers" class="bg-white rounded-b-3xl border border-t-0 border-pink-100 p-8 tab-content">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Daftar Voucher</h2>
                    <a href="{{ route('admin.vouchers.create') }}" class="inline-flex items-center gap-2 rounded-full bg-pink-600 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:bg-pink-700 transition">
                        <i class="fas fa-plus"></i> Tambah Voucher Baru
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse">
                        <thead class="bg-pink-50 text-left text-sm font-semibold text-pink-700">
                            <tr>
                                <th class="px-6 py-4">Kode Voucher</th>
                                <th class="px-6 py-4">Diskon</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 w-44">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-pink-100">
                            @forelse($vouchers as $voucher)
                                <tr class="hover:bg-pink-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $voucher->kode }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-800">{{ $voucher->discount }}%</td>
                                    <td class="px-6 py-4 text-sm">
                                        @if($voucher->is_expired)
                                            <span class="inline-flex items-center gap-1 rounded-full bg-red-100 px-3 py-1 text-red-700 text-xs font-semibold">
                                                <i class="fas fa-times-circle"></i> Expired
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-3 py-1 text-green-700 text-xs font-semibold">
                                                <i class="fas fa-check-circle"></i> Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm space-x-2">
                                        <a href="{{ route('admin.vouchers.edit', $voucher->id) }}" class="inline-flex items-center gap-2 rounded-full bg-pink-100 px-4 py-2 text-pink-700 hover:bg-pink-200 transition text-xs font-semibold">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="post" class="inline-block" onsubmit="return confirm('Hapus voucher ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-red-500 px-4 py-2 text-white hover:bg-red-600 transition text-xs font-semibold">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                        <i class="fas fa-inbox text-4xl opacity-30 mb-3 block"></i>
                                        Belum ada voucher.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($vouchers->hasPages())
                    <div class="mt-6">
                        {{ $vouchers->links() }}
                    </div>
                @endif
            </div>

            <!-- TAB: DISCOUNTS -->
            <div id="content-discounts" class="bg-white rounded-b-3xl border border-t-0 border-pink-100 p-8 tab-content hidden">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Daftar Diskon Produk</h2>
                    <a href="{{ route('admin.discounts.create') }}" class="inline-flex items-center gap-2 rounded-full bg-pink-600 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:bg-pink-700 transition">
                        <i class="fas fa-plus"></i> Tambah Diskon Baru
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse">
                        <thead class="bg-pink-50 text-left text-sm font-semibold text-pink-700">
                            <tr>
                                <th class="px-6 py-4">Nama Produk</th>
                                <th class="px-6 py-4">Tipe Diskon</th>
                                <th class="px-6 py-4">Nilai</th>
                                <th class="px-6 py-4">Berlaku Sampai</th>
                                <th class="px-6 py-4 w-44">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-pink-100">
                            @forelse($discounts as $discount)
                                <tr class="hover:bg-pink-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $discount->product->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-800">
                                        @if($discount->discount_type === 'percentage')
                                            <span class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-3 py-1 text-blue-700 text-xs font-semibold">
                                                <i class="fas fa-percent"></i> Persentase
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 rounded-full bg-amber-100 px-3 py-1 text-amber-700 text-xs font-semibold">
                                                <i class="fas fa-coins"></i> Nominal
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800">{{ $discount->discount_label }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-800">
                                        @if($discount->is_active)
                                            <span class="text-green-600 font-medium">{{ $discount->valid_until->format('d M Y') }}</span>
                                        @else
                                            <span class="text-red-600 font-medium">{{ $discount->valid_until->format('d M Y') }} <small>(Expired)</small></span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm space-x-2">
                                        <a href="{{ route('admin.discounts.edit', $discount->id) }}" class="inline-flex items-center gap-2 rounded-full bg-pink-100 px-4 py-2 text-pink-700 hover:bg-pink-200 transition text-xs font-semibold">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.discounts.destroy', $discount->id) }}" method="post" class="inline-block" onsubmit="return confirm('Hapus diskon ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-red-500 px-4 py-2 text-white hover:bg-red-600 transition text-xs font-semibold">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                        <i class="fas fa-inbox text-4xl opacity-30 mb-3 block"></i>
                                        Belum ada diskon produk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($discounts->hasPages())
                    <div class="mt-6">
                        {{ $discounts->links() }}
                    </div>
                @endif
            </div>

        </div>
    </section>

    <script>
        function switchTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(el => {
                el.classList.add('hidden');
            });

            // Remove active state from all buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active', 'border-pink-600', 'text-pink-600');
                btn.classList.add('border-transparent', 'text-gray-600');
            });

            // Show selected tab
            document.getElementById('content-' + tabName).classList.remove('hidden');

            // Set active state to button
            document.getElementById('tab-' + tabName + '-btn').classList.add('active', 'border-pink-600', 'text-pink-600');
            document.getElementById('tab-' + tabName + '-btn').classList.remove('border-transparent', 'text-gray-600');
        }
    </script>
</body>
</html>
