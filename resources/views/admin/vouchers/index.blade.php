<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Voucher</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-pink-50 min-h-screen">
    <x-navbar />
    <section class="py-10 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Voucher</h1>
                    <p class="text-gray-600 mt-2">Kelola kode voucher yang dapat digunakan saat checkout.</p>
                </div>
                <a href="{{ route('admin.vouchers.create') }}" class="inline-flex items-center gap-2 rounded-full bg-pink-600 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:bg-pink-700 transition">
                    <i class="fas fa-plus"></i> Tambah Voucher Baru
                </a>
            </div>

            @if(session('success'))
                <div class="mb-6 rounded-2xl bg-green-50 border border-green-200 p-4 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto bg-white rounded-3xl border border-pink-100 shadow-sm">
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
                            <tr class="hover:bg-pink-50">
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $voucher->kode }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $voucher->discount }}%</td>
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $voucher->is_expired ? 'Expired' : 'Aktif' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 space-x-2">
                                    <a href="{{ route('admin.vouchers.edit', $voucher->id) }}" class="inline-flex items-center gap-2 rounded-full bg-pink-100 px-4 py-2 text-pink-700 hover:bg-pink-200 transition">Edit</a>
                                    <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="post" class="inline-block" onsubmit="return confirm('Hapus voucher ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-red-500 px-4 py-2 text-white hover:bg-red-600 transition">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada voucher.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $vouchers->links() }}
            </div>
        </div>
    </section>
</body>
</html>
