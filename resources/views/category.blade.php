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

        * {
            font-family: 'Poppins', sans-serif;
        }

        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background-color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(236, 72, 153, 0.1);
        }

        ::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-pink-50 via-white to-pink-50">
    <x-navbar></x-navbar>

    <section class="pt-12 pb-8 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-pink-600 mb-4">Find Product By Category</p>
            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 mb-4">Cari Produk Berdasarkan Kategori</h1>
            <p class="mx-auto max-w-2xl text-gray-600 leading-relaxed">Pilih kategori favoritmu dan jelajahi produk skincare terbaik yang sudah dikelompokkan sesuai kebutuhan kulit.</p>
        </div>
    </section>

    <section class="pb-16 px-4">
        <div class="max-w-7xl mx-auto">
            @if ($categories->count() > 0)
                <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($categories as $category)
                        <a href="/category/{{ $category->id }}" class="group block overflow-hidden rounded-[32px] border border-pink-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-2xl">
                            <div class="p-6 sm:p-8">
                                <div class="flex items-center justify-between gap-4 mb-6">
                                    <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-pink-100 text-pink-600 shadow-sm">
                                        <i class="fas fa-tags text-lg"></i>
                                    </span>
                                    <span class="text-xs font-bold uppercase tracking-[0.35em] text-pink-500">Kategori</span>
                                </div>

                                <h2 class="text-2xl font-bold text-gray-900 mb-3">{{ $category->category_name }}</h2>
                                <p class="text-sm text-gray-500 mb-6">Terdapat <span class="font-semibold text-pink-600">{{ $category->products->count() }}</span> produk dalam kategori ini.</p>

                                <div class="inline-flex items-center gap-2 text-sm font-semibold text-pink-600 transition group-hover:gap-3">
                                    <span>Lihat produk</span>
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                            <div class="h-8 bg-gradient-to-r from-pink-50 to-rose-50"></div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="rounded-[32px] border border-pink-100 bg-white p-12 text-center shadow-sm">
                    <div class="mx-auto mb-6 h-24 w-24 rounded-full bg-pink-50 text-pink-500 flex items-center justify-center text-4xl">
                        <i class="fas fa-tags"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Kategori Belum Tersedia</h3>
                    <p class="text-gray-500 mb-6">Saat ini belum ada kategori produk. Silakan tambahkan kategori terlebih dahulu untuk mempermudah pencarian produk.</p>
                    <a href="/admin/category" class="inline-flex items-center gap-2 rounded-full bg-pink-500 px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:bg-pink-600">
                        <i class="fas fa-plus"></i> Tambah Kategori
                    </a>
                </div>
            @endif
        </div>
    </section>

    <x-footer></x-footer>
</body>

</html>