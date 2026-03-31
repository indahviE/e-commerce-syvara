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

<body class="bg-white">
    <x-navbar></x-navbar>

    <!-- Header Section -->
    <section class="py-8 px-4 bg-gradient-to-r from-pink-50 to-pink-100">
        <div class="max-w-7xl mx-auto">
            <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl p-8 shadow-lg">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-3">Kategori Produk</h1>
                        <p class="text-pink-100 text-lg">Jelajahi kategori skincare sesuai dengan kebutuhan kulit Anda
                        </p>
                    </div>
                    <a href="/about"
                        class="inline-flex items-center gap-2 px-8 py-4 bg-white text-pink-500 rounded-xl font-semibold hover:bg-gray-50 hover:shadow-md transition duration-300">
                        <i class="fas fa-arrow-right"></i>
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-12 px-4">
        <div class="max-w-7xl mx-auto">
            @if ($categories->count() > 0)
                {{-- <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                    <!-- Table Header Info -->
                    <div class="px-6 py-4 bg-gradient-to-r from-pink-50 to-pink-100 border-b border-pink-200">
                        <p class="text-gray-600 font-medium">
                            <i class="fas fa-list text-pink-500 mr-2"></i>
                            Total {{ $category->count() }} Kategori
                        </p>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-pink-100 to-pink-50 border-b-2 border-pink-200">
                                    <th class="px-6 py-4 text-left text-sm font-bold text-pink-900 w-16">No</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-pink-900">Nama Kategori</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($category as $data)
                                <tr class="hover:bg-pink-50 cursor-pointer">
                                    <td class="px-6 py-5">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-br from-pink-400 to-pink-500 text-white text-sm font-bold shadow-sm">
                                            {{ $loop->iteration }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <a href="/category/{{ $data->id }}" class="flex items-center gap-4 hover:opacity-80 transition">
                                            <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-pink-400 to-pink-500 flex items-center justify-center shadow-md">
                                                <i class="fas fa-tag text-white text-lg"></i>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-900 text-base">{{ $data->category_name }}</p>
                                                <p class="text-xs text-gray-500 mt-1">Kategori Produk</p>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> --}}
                {{-- Wrapper: scroll horizontal --}}
                <div class="flex overflow-x-auto gap-0 h-screen">

                    {{-- Per Kategori --}}
                    @foreach ($categories as $i => $category)
                        <div class="flex flex-col h-full"
                            style="width: {{ count($category->products) >= 2 ? '520' : '275' }}px;">

                            {{-- Judul Vertikal --}}
                            <div class="flex items-end justify-start bg-white  border-gray-100 px-3 overflow-hidden"
                                style="width: {{ count($category->products) >= 2 ? '500' : '260' }}px;">
                                {{-- @for ($i = 0; $i < 100; $i++) --}}
                                <h2
                                    class="text-xl text-start text-pink-500 font-bold uppercase text-gray-900 whitespace-nowrap">
                                    {{ $category->category_name }} — {{ $category->category_name }} —
                                    {{ $category->category_name }} — {{ $category->category_name }} —
                                    {{ $category->category_name }}
                                </h2>
                                {{-- @endfor --}}
                            </div>

                            {{-- Grid Produk: 2 kolom, scroll vertikal --}}
                            <div class="overflow-y-auto h-[85vh] p-4" style="width: 520px;">
                                <div class="grid grid-cols-2 gap-3">
                                    @foreach ($category->products as $data)
                                        {{-- card produk kamu di sini --}}
                                        <div
                                            class="product-card group bg-white rounded-xl overflow-hidden border border-pink-100 hover:border-pink-300 transition-all">
                                            <a href="/product/{{ $data->id }}/detail">
                                                <div
                                                    class="product-img relative h-32 sm:h-40 bg-pink-50 overflow-hidden">
                                                    @if ($data->image)
                                                        <img src="{{ asset('storage/' . $data->image) }}"
                                                            alt="{{ $data->name }}">
                                                    @else
                                                        <div
                                                            class="w-full h-full flex items-center justify-center bg-pink-50">
                                                            <i class="fas fa-image text-2xl text-pink-200"></i>
                                                        </div>
                                                    @endif

                                                    {{-- NEW BADGE - Muncul jika produk ditambah kurang dari 3 jam --}}
                                                    @if ($data->created_at->diffInHours(now()) < 3)
                                                        <span
                                                            class="absolute top-1 right-1 bg-pink-500 text-white px-2 py-0.5 rounded text-xs font-bold">NEW</span>
                                                    @endif
                                                </div>

                                                <div class="p-2.5 sm:p-3">
                                                    <div class="mb-2">
                                                        <span
                                                            class="inline-block text-xs font-bold text-pink-600 bg-pink-50 px-2.5 py-1 rounded-full border border-pink-200">
                                                            {{ $category->category_name ?? 'Produk' }}
                                                        </span>
                                                    </div>
                                                    <h3
                                                        class="font-bold text-gray-900 text-xs sm:text-sm line-clamp-2 mb-1">
                                                        {{ $data->name }}</h3>
                                                    <p class="text-pink-600 font-bold text-xs sm:text-sm mb-2">Rp
                                                        {{ number_format($data->price, 0, ',', '.') }}</p>

                                                    <div
                                                        class="flex justify-between items-center text-xs text-gray-600">
                                                        <span>Stok: {{ $data->stock }}</span>
                                                        <span
                                                            class="text-pink-500 font-semibold group-hover:text-pink-600 opacity-0 group-hover:opacity-100 transition">→</span>
                                                    </div>
                                                </div>
                                            </a>

                                            <form action="{{ route('show_single_payment') }}" method="post"
                                                class="flex gap-2 p-3">
                                                <!-- Add to Cart Button -->
                                                @csrf
                                                <select name="qty" id="">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                </select>
                                                <input type="text" value="{{ $data->id }}" name="produk_id"
                                                    hidden>
                                                <button type="submit"
                                                    class="from-pink-50 to-rose-50 text-pink-600 rounded-xl font-semibold hover:from-pink-100 hover:to-rose-100 transition duration-300 text-center text-sm border border-pink-200 w-full">
                                                    Checkout
                                                </button>
                                                <button
                                                    onclick="addToCart('{{ route('cart_product_add') }}', '{{ $data->id }}')"
                                                    class="w-fit px-4 py-2.5 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-lg font-semibold text-center hover:shadow-lg transition duration-300 text-sm">
                                                    <i class="fas fa-shopping-bag mr-1"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center border border-gray-100">
                    <div class="mb-6">
                        <i class="fas fa-folder-open text-6xl text-gray-300 mb-4 block"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Kategori</h3>
                    <p class="text-gray-500 mb-6 text-base">Tambahkan kategori pertama untuk mulai menampilkan produk
                        Anda</p>
                    <a href="#"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-pink-500 text-white rounded-lg font-semibold hover:bg-pink-600 transition duration-300">
                        <i class="fas fa-plus"></i>
                        Tambah Kategori
                    </a>
                </div>
            @endif
        </div>
    </section>

    <x-footer></x-footer>
</body>

</html>