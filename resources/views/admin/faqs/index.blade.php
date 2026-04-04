<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin FAQ Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 min-h-screen">
    <x-navbar />
    <section class="py-10 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">FAQ Produk</h1>
                    <p class="text-gray-600 mt-2">Kelola pertanyaan umum produk yang muncul di halaman detail produk.
                    </p>
                </div>
                <a href="{{ route('admin.faqs.create') }}"
                    class="inline-flex items-center gap-2 rounded-full bg-pink-600 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:bg-pink-700 transition">
                    <i class="fas fa-plus"></i> Tambah FAQ Baru
                </a>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-2xl bg-green-50 border border-green-200 p-4 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto bg-white rounded-3xl border border-pink-100 shadow-sm">
                <table class="min-w-full border-collapse">
                    <thead class="bg-pink-50 text-left text-sm font-semibold text-pink-700">
                        <tr>
                            <th class="px-6 py-4">Produk</th>
                            <th class="px-6 py-4">Pertanyaan</th>
                            <th class="px-6 py-4">Jawaban</th>
                            <th class="px-6 py-4 w-44">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-pink-100">
                        @forelse($faqs as $faq)
                            <tr class="hover:bg-pink-50">
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    {{ $faq->product->name ?? 'Produk dihapus' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $faq->pertanyaan }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $faq->jawaban }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 space-x-2">
                                    {{-- <a href="{{ route('admin.faqs.edit', $faq->id) }}"
                                        class="inline-flex items-center gap-2 rounded-full bg-pink-100 px-4 py-2 text-pink-700 hover:bg-pink-200 transition">Edit</a> --}}
                                    <a href="{{ route('admin.faqs.edit', $faq->id) }}"
                                        class="px-3 py-1 bg-yellow-50 text-yellow-600 rounded text-xs font-semibold hover:bg-yellow-100 transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="post"
                                        class="inline-block" onsubmit="return confirm('Hapus FAQ ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="px-3 py-1 bg-red-50 text-red-600 rounded text-xs font-semibold hover:bg-red-100 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada FAQ produk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $faqs->links() }}
            </div>
        </div>
    </section>
</body>

</html>
