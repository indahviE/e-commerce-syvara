<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Produk - Syvara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        .product-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(236, 72, 153, 0.2);
        }

        .product-img {
            overflow: hidden;
            position: relative;
            background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%);
        }

        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .product-card:hover .product-img img {
            transform: scale(1.1);
        }

        .badge-new {
            animation: slideInRight 0.5s ease-out;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .wishlist-btn {
            transition: all 0.2s ease;
        }

        /* .wishlist-btn {
        position: relative;
        z-index: 10;
        } */
        .wishlist-btn:active {
            transform: scale(1.15);
        }

        .stock-low {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.8;
            }
        }

        .gradient-text {
            background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Sticky Footer CSS */
        html {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        section {
            flex: 1;
        }

        #productGrid {
            transition: all 0.4s ease;
        }

        ::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-pink-50 via-white to-pink-50">
    <x-navbar></x-navbar>



    <!-- Hero Section -->
    {{-- <section class="relative pt-8 pb-6 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="bg-pink-500 rounded-3xl p-8 sm:p-12 shadow-xl">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <h1 class="text-4xl md:text-5xl font-bold mb-3 text-white flex items-center gap-3">
                            <i class="fas fa-sparkles"></i>Semua Produk
                        </h1>
                        <p class="text-pink-100 text-lg">Koleksi skincare premium terlengkap untuk kulit sehat Anda</p>
                    </div>
                    <a href="/about"
                        class="inline-flex items-center gap-2 px-8 py-4 bg-white text-pink-600 rounded-xl font-bold hover:bg-pink-50 hover:shadow-lg transition duration-300 whitespace-nowrap">
                        <i class="fas fa-info-circle"></i> Pelajari Lebih
                    </a>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Products Grid -->
    <section class="py-4 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-wrap items-center gap-1 overflow-x-auto mb-6">
                <span class="text-sm text-gray-600 font-400">Filters :</span>
                <form action="" method="get">
                    <input type="text" hidden name="category_name" value="">
                    <input type="text" hidden name="id" value="">
                    <button type="submit">
                        <span
                            class="inline-block text-sm flex gap-1 font-bold text-pink-600 bg-white px-8 py-1 rounded-full border border-pink-200">
                            <p>
                                Show All
                            </p>
                        </span>
                    </button>
                </form>

                @foreach ($categories->take(20) as $category)
                    <form action="" method="get">
                        <input type="text" hidden name="category_name" value="{{ $category->category_name }}">
                        <input type="text" hidden name="id" value="{{ $category->id }}">
                        <button type="submit">
                            <span
                                class="inline-block text-sm flex gap-1 font-bold text-pink-600 bg-white px-2.5 py-1 rounded-full border border-pink-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M5.5 7A1.5 1.5 0 0 1 4 5.5A1.5 1.5 0 0 1 5.5 4A1.5 1.5 0 0 1 7 5.5A1.5 1.5 0 0 1 5.5 7m15.91 4.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.11 0-2 .89-2 2v7c0 .55.22 1.05.59 1.41l8.99 9c.37.36.87.59 1.42.59s1.05-.23 1.41-.59l7-7c.37-.36.59-.86.59-1.41c0-.56-.23-1.06-.59-1.42" />
                                </svg>
                                <p>
                                    {{ $category->category_name }}
                                </p>
                            </span>
                        </button>
                    </form>
                @endforeach
                @if ($categories->count() > 20)
                    <a href="/category">
                        <span
                            class="inline-block text-sm font-bold text-gray-500 bg-white px-3 py-1 rounded-full border border-gray-200 hover:bg-gray-100">
                            ...
                        </span>
                    </a>
                @endif


            </div>
            @if ($products->count() > 0)
                {{-- <div
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-5">
                    @foreach ($products as $data)
                        <!-- Product Card -->
                        <div
                            class="product-card group bg-white rounded-2xl overflow-hidden border border-pink-100 hover:border-pink-300 block">
                            <!-- Product Image Container -->
                            <a href="/product/{{ $data->id }}/detail">
                                <div class="product-img relative h-48 sm:h-56 overflow-hidden">
                                    @if ($data->image)
                                        <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->name }}">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-gradient-to-br from-pink-100 to-rose-100">
                                            <i class="fas fa-image text-4xl text-pink-300"></i>
                                        </div>
                                    @endif

                                    <!-- Overlay Gradient -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                                    </div>

                                    <!-- Badges -->
                                    <div class="absolute top-3 left-3 right-3 flex justify-between items-start">
                                        @if ($data->created_at->diffInHours(now()) < 3)
                                            <span
                                                class="badge-new bg-gradient-to-r from-pink-500 to-rose-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                                NEW
                                            </span>
                                        @endif

                                        @if ($data->stock < 5 && $data->stock > 0)
                                            <span
                                                class="stock-low bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                                Terbatas
                                            </span>
                                        @elseif ($data->stock == 0)
                                            <span
                                                class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                                Habis
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Wishlist Button (Top Right) -->
                                    @auth
                                        <button
                                            class="wishlist-btn heart-btn absolute top-3 right-3 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-pink-50 transition z-10"
                                            data-product-id="{{ $data->id }}"
                                            onclick="event.preventDefault(); event.stopPropagation();"
                                            title="Tambah ke favorit">
                                            <i
                                                class="fas fa-heart {{ $data->isWishlisted() ? 'fas text-pink-600' : 'far text-gray-400' }} text-lg"></i>
                                        </button>
                                    @else
                                        <a href="/login" onclick="event.stopPropagation();"
                                            class="absolute top-3 right-3 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-pink-50 transition z-10"
                                            title="Login untuk favorit">
                                            <i class="far fa-heart text-gray-400 text-lg"></i>
                                        </a>
                                    @endauth
                                </div>

                                <!-- Product Info -->
                                <div class="p-4">
                                    <!-- Category Badge -->
                                    <div class="mb-2">
                                        <span
                                            class="inline-block text-xs font-bold text-pink-600 bg-pink-50 px-2.5 py-1 rounded-full border border-pink-200">
                                            {{ $data->category->category_name ?? 'Produk' }}
                                        </span>
                                    </div>

                                    <!-- Product Name -->
                                    <h3
                                        class="font-bold text-gray-900 text-sm line-clamp-2 mb-2 group-hover:text-pink-600 transition">
                                        {{ $data->name }}
                                    </h3>

                                    <!-- Price -->
                                    <p class="gradient-text font-bold text-lg mb-3">
                                        Rp {{ number_format($data->price, 0, ',', '.') }}
                                    </p>
                            </a>

                            <!-- Stock Info -->
                            <div class="flex items-center justify-between text-xs text-gray-600 mb-3">
                                <span class="flex items-center gap-1">
                                    <i class="fas fa-box text-pink-500"></i>
                                    Stok: <strong class="text-gray-900">{{ $data->stock }}</strong>
                                </span>
                                <span
                                    class="text-pink-500 font-semibold group-hover:text-pink-600 opacity-0 group-hover:opacity-100 transition">→</span>
                            </div>

                            <form action="{{ route('show_single_payment') }}" method="post" class="flex gap-2">
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
                                <input type="text" value="{{$data->id}}" name="produk_id" hidden>
                                <button type="submit"
                                    class="from-pink-50 to-rose-50 text-pink-600 rounded-xl font-semibold hover:from-pink-100 hover:to-rose-100 transition duration-300 text-center text-sm border border-pink-200 w-full">
                                    Checkout
                                </button>

                                <button type="button"
                                    onclick="addToCart('{{ route('cart_product_add') }}', '{{ $data->id }}')"
                                    class="w-fit px-4 py-2.5 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-lg font-semibold text-center hover:shadow-lg transition duration-300 text-sm">
                                    <i class="fas fa-shopping-bag mr-1"></i>
                                </button>
                            </form>
                        </div>
                </div> --}}

                {{-- Grid kosong, diisi JS --}}
                <div class="relative">


                    {{-- Tombol Kiri --}}
                    <button onclick="changePage(-1)" id="btnPrev"
                        class="absolute -left-5 top-1/2 -translate-y-1/2 z-10
                        w-10 h-10 rounded-full bg-white border border-pink-200 shadow-md
                        flex items-center justify-center text-pink-400
                        hover:bg-pink-500 hover:text-white hover:border-pink-500
                        disabled:opacity-30 disabled:cursor-not-allowed
                        transition-all duration-200">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                    </button>

                    {{-- Tombol Kanan --}}
                    <button onclick="changePage(1)" id="btnNext"
                        class="absolute -right-5 top-1/2 -translate-y-1/2 z-10
                        w-10 h-10 rounded-full bg-white border border-pink-200 shadow-md
                        flex items-center justify-center text-pink-400
                        hover:bg-pink-500 hover:text-white hover:border-pink-500
                        disabled:opacity-30 disabled:cursor-not-allowed
                        transition-all duration-200">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </button>



                    <div class="grid grid-cols-5 gap-4" id="productGrid">
                        {{-- diisi JS --}}
                    </div>

                    {{-- <div class="flex items-center justify-between mt-6 px-1">
                        <span class="text-sm text-gray-400 font-medium" id="pageInfo"></span>
                        <div class="flex items-center gap-2">
                            <button onclick="changePage(-1)" id="btnPrev"
                                class="flex items-center gap-2 px-4 py-2 rounded-full border border-pink-200
                       text-pink-400 text-sm font-semibold
                       hover:bg-pink-500 hover:text-white hover:border-pink-500
                       disabled:opacity-30 disabled:cursor-not-allowed transition-all duration-200">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5">
                                    <path d="M15 18l-6-6 6-6" />
                                </svg>
                                Prev
                            </button>
                            <div class="flex gap-1.5 items-center" id="dotContainer"></div>
                            <button onclick="changePage(1)" id="btnNext"
                                class="flex items-center gap-2 px-4 py-2 rounded-full border border-pink-200
                       text-pink-400 text-sm font-semibold
                       hover:bg-pink-500 hover:text-white hover:border-pink-500
                       disabled:opacity-30 disabled:cursor-not-allowed transition-all duration-200">
                                Next
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5">
                                    <path d="M9 18l6-6-6-6" />
                                </svg>
                            </button>
                        </div>
                    </div> --}}

                    {{-- Dots & Info bawah --}}
                    <div class="flex items-center justify-center gap-3 mt-5">
                        <span class="text-xs text-gray-400 font-medium" id="pageInfo"></span>
                        <div class="flex gap-1.5 items-center" id="dotContainer"></div>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="flex justify-center items-center py-20">
                    <div class="text-center max-w-md">
                        <div class="mb-6 inline-block">
                            <div
                                class="w-32 h-32 bg-gradient-to-br from-pink-100 to-rose-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-inbox text-6xl text-gray-300"></i>
                            </div>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Produk Tidak Ditemukan</h2>
                        <p class="text-gray-600 mb-6">Maaf, tidak ada produk yang sesuai dengan pencarian Anda.</p>
                        <a href="/"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-lg font-bold hover:shadow-lg transition duration-300">
                            <i class="fas fa-home"></i> Kembali Beranda
                        </a>
                    </div>
                </div>
            @endif

            @if ($frequentProducts->isNotEmpty())
                <section class="py-10 px-4">
                    <div class="max-w-7xl mx-auto">
                        <div class="flex items-center justify-between mb-5">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">Produk yang Sering Dibeli</h2>
                                <p class="text-sm text-gray-500">Rekomendasi dari produk favorit pelanggan.</p>
                            </div>
                        </div>

                        <div class="-mx-4 overflow-x-auto py-2" style="overflow-y:hidden;">
                            <div class="flex gap-4 px-4 min-w-max" id="productFlex">
                                {{-- @foreach ($frequentProducts as $data)
                                    <span>
                                        <!-- Product Image Container -->
                                        <a href="/product/{{ $data->id }}/detail">
                                            <div class="product-img relative h-48 sm:h-56 overflow-hidden">
                                                @if ($data->image)
                                                    <img src="{{ asset('storage/' . $data->image) }}"
                                                        alt="{{ $data->name }}">
                                                @else
                                                    <div
                                                        class="w-full h-full flex items-center justify-center bg-gradient-to-br from-pink-100 to-rose-100">
                                                        <i class="fas fa-image text-4xl text-pink-300"></i>
                                                    </div>
                                                @endif

                                                <!-- Overlay Gradient -->
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                                                </div>

                                                <!-- Badges -->
                                                <div
                                                    class="absolute top-3 left-3 right-3 flex justify-between items-start">
                                                    @if ($data->created_at->diffInHours(now()) < 3)
                                                        <span
                                                            class="badge-new bg-gradient-to-r from-pink-500 to-rose-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                                            NEW
                                                        </span>
                                                    @endif

                                                    @if ($data->stock < 5 && $data->stock > 0)
                                                        <span
                                                            class="stock-low bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                                            Terbatas
                                                        </span>
                                                    @elseif ($data->stock == 0)
                                                        <span
                                                            class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                                            Habis
                                                        </span>
                                                    @endif
                                                </div>

                                                <!-- Wishlist Button (Top Right) -->
                                                @auth
                                                    <button
                                                        class="wishlist-btn heart-btn absolute top-3 right-3 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-pink-50 transition z-10"
                                                        data-product-id="{{ $data->id }}"
                                                        onclick="event.preventDefault(); event.stopPropagation();"
                                                        title="Tambah ke favorit">
                                                        <i
                                                            class="fas fa-heart {{ $data->isWishlisted() ? 'fas text-pink-600' : 'far text-gray-400' }} text-lg"></i>
                                                    </button>
                                                @else
                                                    <a href="/login" onclick="event.stopPropagation();"
                                                        class="absolute top-3 right-3 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-pink-50 transition z-10"
                                                        title="Login untuk favorit">
                                                        <i class="far fa-heart text-gray-400 text-lg"></i>
                                                    </a>
                                                @endauth
                                            </div>

                                            <!-- Product Info -->
                                            <div class="p-4">
                                                <!-- Category Badge -->
                                                <div class="mb-2">
                                                    <span
                                                        class="inline-block text-xs font-bold text-pink-600 bg-pink-50 px-2.5 py-1 rounded-full border border-pink-200">
                                                        {{ $data->category->category_name ?? 'Produk' }}
                                                    </span>
                                                </div>

                                                <!-- Product Name -->
                                                <h3
                                                    class="font-bold text-gray-900 text-sm line-clamp-2 mb-2 group-hover:text-pink-600 transition">
                                                    {{ $data->name }}
                                                </h3>

                                                <!-- Price -->
                                                <p class="gradient-text font-bold text-lg mb-3">
                                                    Rp {{ number_format($data->price, 0, ',', '.') }}
                                                </p>
                                        </a>

                                        <!-- Stock Info -->
                                        <div class="flex items-center justify-between text-xs text-gray-600 mb-3">
                                            <span class="flex items-center gap-1">
                                                <i class="fas fa-box text-pink-500"></i>
                                                Stok: <strong class="text-gray-900">{{ $data->stock }}</strong>
                                            </span>
                                            <span
                                                class="text-pink-500 font-semibold group-hover:text-pink-600 opacity-0 group-hover:opacity-100 transition">→</span>
                                        </div>

                                        <form action="{{ route('show_single_payment') }}" method="post"
                                            class="flex gap-2">
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

                                            <button type="button"
                                                onclick="addToCart('{{ route('cart_product_add') }}', '{{ $data->id }}')"
                                                class="w-fit px-4 py-2.5 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-lg font-semibold text-center hover:shadow-lg transition duration-300 text-sm">
                                                <i class="fas fa-shopping-bag mr-1"></i>
                                            </button>
                                        </form>
                                    </span>
                                @endforeach --}}
                            </div>
                        </div>
                    </div>
                </section>
            @endif

        </div>
    </section>

    {{-- Simpan semua data produk sebagai JSON --}}
    <script>
        const allProducts = @json($products);
        const topProduct = @json($frequentProducts);

        console.log({allProducts, topProduct})
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <x-footer></x-footer>

    <!-- Wishlist Toggle Script -->
    <script>
        const PER_PAGE = 5;
        // const slides = document.querySelectorAll('.product-slide');
        const total = allProducts.length;
        const totalPage = Math.ceil(total / PER_PAGE);
        let current = 0;

        console.log({
            total,
            totalPage,
            current
        })

        function render() {
            console.log("Hi i do render");
            const grid = document.getElementById('productGrid');
            const flex = document.getElementById('productFlex');
            grid.style.opacity = 0;
            flex.style.opacity = 0;
            grid.style.transform = "translateX(40px)";
            flex.style.transform = "translateX(40px)";

            setTimeout(() => {
                const slice = allProducts.slice(current * PER_PAGE, (current + 1) * PER_PAGE);
                const sliceTopProduk = topProduct.slice(current * 1000, (current + 1) * 1000);

                grid.innerHTML = slice.map(renderCard).join('');
                flex.innerHTML = sliceTopProduk.map(renderCard).join('');
                //animasi masuk
                grid.style.transform = "translateX(0)";
                grid.style.opacity = 1;
                flex.style.transform = "translateX(0)";
                flex.style.opacity = 1;
            }, 150);

            // info
            const from = current * PER_PAGE + 1;
            const to = Math.min((current + 1) * PER_PAGE, total);
            document.getElementById('pageInfo').textContent = `${from}–${to} dari ${total} produk`;

            // Dots
            const dots = document.getElementById('dotContainer');
            dots.innerHTML = '';
            for (let i = 0; i < totalPage; i++) {
                const d = document.createElement('button');
                d.onclick = () => {
                    current = i;
                    render();
                };
                d.className = `rounded-full transition-all duration-200 ${
            i === current ? 'w-5 h-2 bg-pink-500' : 'w-2 h-2 bg-pink-200 hover:bg-pink-300'
        }`;
                dots.appendChild(d);
            }
        }


        // Fungsi render card — sesuaikan HTML card kamu di sini
        function renderCard(p) {
            const imgHtml = p.image ?
                `<img src="/storage/${p.image}" alt="${p.name}" class="w-full h-full object-cover">` :
                `<div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-pink-100 to-rose-100"><i class="fas fa-image text-4xl text-pink-300"></i></div>`;

            const isNew = new Date(p.created_at) > new Date(Date.now() - 3 * 60 * 60 * 1000);
            const isLow = p.stock < 5 && p.stock > 0;
            const isHabis = p.stock === 0;
            const isAuth = {{ auth()->check() ? 'true' : 'false' }};
            const isWish = p.is_wishlisted ?? false;

            const badgeNew = isNew ?
                `<span class="badge-new bg-gradient-to-r from-pink-500 to-rose-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">NEW</span>` :
                '';

            const badgeStock = isHabis ?
                `<span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">Habis</span>` :
                isLow ?
                `<span class="stock-low bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">Terbatas</span>` :
                '';

            // ✅ CATEGORY LIMIT + ...
            let chips = "";
            if (p.categories && p.categories.length > 0) {
                const maxShow = 2;
                const visible = p.categories.slice(0, maxShow);

                chips = visible.map(c => `
            <span class="inline-block text-xs font-bold text-pink-600 bg-pink-50 px-2 py-0.5 rounded-full border border-pink-200">
                ${c.category_name}
            </span>
        `).join('');

                if (p.categories.length > maxShow) {
                    chips += `<span class="text-xs text-gray-400 font-semibold">...</span>`;
                }
            }

            const wishBtn = isAuth ?
                `<button class="wishlist-btn pointer-events-auto heart-btn absolute top-3 right-3 z-50 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-pink-50 transition z-10"data-product-id="${p.id}"title="Tambah ke favorit"><i class="fas fa-heart ${isWish ? 'text-pink-600' : 'far text-gray-400'} text-lg"></i></button>` :
                `<a href="/login" onclick="event.stopPropagation();"class="absolute top-3 right-3 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-pink-50 transition z-10"title="Login untuk favorit"><i class="far fa-heart text-gray-400 text-lg"></i></a>`;

            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            const checkoutRoute = "{{ route('show_single_payment') }}";
            const cartRoute = "{{ route('cart_product_add') }}";

            return `
    <div class="max-w-[250px] product-card group bg-white rounded-2xl overflow-hidden border border-pink-100 hover:border-pink-300 flex flex-col h-full">

        <!-- IMAGE -->
        <a href="/product/${p.id}/detail">
            <div class="product-img relative h-48 sm:h-56 overflow-hidden">
                ${imgHtml}

                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>

                <div class="absolute top-3 left-3 right-3 flex justify-between items-start">
                    ${badgeNew}
                    ${badgeStock}
                </div>

                ${wishBtn}
            </div>
        </a>

        <!-- CONTENT -->
        <div class="p-4 flex flex-col flex-grow">

            <!-- CATEGORY -->
            <div class="mb-2 flex flex-wrap gap-1 min-h-[30px]">
                ${chips}
            </div>

            <!-- NAME -->
            <h3 class="font-bold text-gray-900 text-sm line-clamp-2 min-h-[40px] mb-2 group-hover:text-pink-600 transition">
                ${p.name}
            </h3>

            <!-- PRICE -->
            <p class="gradient-text font-bold text-lg mb-3">
                Rp ${parseInt(p.price).toLocaleString('id-ID')}
            </p>

            <!-- STOCK -->
            <div class="flex items-center justify-between text-xs text-gray-600 mb-3">
                <span class="flex items-center gap-1">
                    <i class="fas fa-box text-pink-500"></i>
                    Stok: <strong class="text-gray-900">${p.stock}</strong>
                </span>
                <span class="text-pink-500 font-semibold opacity-0 group-hover:opacity-100 transition">→</span>
            </div>

            <!-- BUTTON (SELALU DI BAWAH) -->
            <form action="${checkoutRoute}" method="post" class="flex gap-2 mt-auto">
                <input type="hidden" name="_token" value="${csrfToken}">
                <input type="hidden" name="produk_id" value="${p.id}">

                <select name="qty" class="text-sm border rounded px-1">
                    ${Array.from({length: 11}, (_, i) => `<option value="${i+1}">${i+1}</option>`).join('')}
                </select>

                <button type="submit"
                    class="from-pink-50 to-rose-50 text-pink-600 rounded-xl font-semibold hover:from-pink-100 hover:to-rose-100 transition duration-300 text-center text-sm border border-pink-200 w-full">
                    Checkout
                </button>

                <button type="button"
                    onclick="addToCart('${cartRoute}', '${p.id}')"
                    class="w-fit px-4 py-2.5 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-lg font-semibold text-center hover:shadow-lg transition duration-300 text-sm">
                    <i class="fas fa-shopping-bag mr-1"></i>
                </button>
            </form>

        </div>
    </div>
        `;
    }


                                function changePage(dir) {
                                const next = current + dir;
                                if (next < 0 || next >= totalPage) return;

                                const grid = document.getElementById('productGrid');

                                // 🔥 arah animasi (biar realistis)
                                grid.style.transform = dir > 0 ? "translateX(60px)" : "translateX(-60px)";

                                current = next;
                                render();
                            }

                                render(); // init


                                document.addEventListener('click', async function (e) {
                                const btn = e.target.closest('.wishlist-btn');
                                if (!btn) return;

                                e.preventDefault();
                                e.stopPropagation();

                                const productId = btn.dataset.productId;

                                try {
                                    const response = await fetch(` / wishlist / toggle / $ {
            productId
        }
        `, {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                            'Content-Type': 'application/json'
                                        }
                                    });

                                    const data = await response.json();

                                    if (data.status === 'added') {
                                        btn.innerHTML = '<i class="fas fa-heart text-pink-600 text-lg"></i>';
                                        showNotification('Ditambahkan ke favorit', 'success');
                                    } else {
                                        btn.innerHTML = '<i class="far fa-heart text-gray-400 text-lg"></i>';
                                        showNotification('Dihapus dari favorit', 'info');
                                    }
                                } catch (error) {
                                    console.error(error);
                                    showNotification('Gagal update favorit', 'error');
                                }
                            });

                                // Notification function
                                function showNotification(message, type = 'info') {
                                    // e.preventDefault();
                                    const notification = document.createElement('div');
                                    notification.textContent = message;

                                    const bgColor = type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6';

                                    notification.style.cssText = `
        postion: fixed;
        bottom: 30 px;
        right: 20 px;
        background: $ {
            bgColor
        };
        color: white;
        padding: 14 px 20 px;
        border - radius: 10 px;
        z - index: 9999;
        font - weight: 600;
        font - size: 14 px;
        box - shadow: 0 10 px 25 px rgba(0, 0, 0, 0.2);
        animation: slideInUp 0.3 s ease - out;
        `;

                                    document.body.appendChild(notification);

                                    setTimeout(() => {
                                        notification.style.animation = 'slideOutDown 0.3s ease-out';
                                        setTimeout(() => notification.remove(), 300);
                                    }, 2500);
                                }

                                // Add animation styles
                                const style = document.createElement('style');
                                style.textContent = `
        @keyframes slideInUp {
            from {
                transform: translateY(20 px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideOutDown {
            from {
                transform: translateY(0);
                opacity: 1;
            }
            to {
                transform: translateY(20 px);
                opacity: 0;
            }
        }
        `;
                                document.head.appendChild(style);
    </script>
    <script src="{{ asset('storage/js/functionBackend.js') }}"></script>
</body>

</html>
