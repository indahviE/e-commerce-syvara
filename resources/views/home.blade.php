<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syvara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Poppins', sans-serif; }
        .card-hover:hover { transform: translateY(-8px); box-shadow: 0 16px 32px rgba(236, 72, 153, 0.15); }
    </style>
</head>
<body class="bg-white">
    <x-navbar></x-navbar>

    <section class="py-4 px-4 border-b border-pink-100">
        <div class="max-w-7xl min-h-[80vh] bg-cover bg-center mx-auto bg-[url('{{asset('images/Landing%20page.png')}}')]">
            <div class="grid h-[78vh] grid-cols-1 md:grid-cols-2 gap-12 items-end ">
                <div class="ms-[11%] pe-[2%] space-y-2 ">
                    <span class="text-pink-600 text-sm font-semibold">Premium Skincare</span>
                    {{-- <h1 class="text-5xl md:text-6xl font-bold text-gray-900 leading-tight">
                        Kulit Cerah & Sehat
                    </h1>
                    <p class="text-xl text-gray-700 leading-relaxed">
                        Produk skincare alami dengan bahan pilihan terbaik untuk kulit yang lebih cerah, sehat, dan bercahaya setiap hari.
                    </p> --}}
                    @auth
                    <div class="bg-pink-50 border border-pink-200 rounded-lg p-4 mb-1">
                        <p class="text-gray-900 font-semibold">Halo, <span class="text-pink-600">{{ auth()->user()->name }}</span>!</p>
                        <p class="text-gray-700 text-sm">Selamat datang kembali di Svayra</p>
                    </div>
                    @endauth
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="/product" class="px-8 py-4 bg-pink-500 text-white rounded-lg font-bold hover:bg-pink-600 transition text-center">
                            <i class="fas fa-shopping-bag mr-2"></i> Lihat Semua Produk
                        </a>
                        <a href="/about" class="px-8 py-4 border-2 border-pink-500 text-pink-500 rounded-lg font-bold hover:border-pink-600 hover:text-pink-600 transition text-center">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="hidden md:block">
                    {{-- <div class="rounded-3xl h-96 flex items-center justify-center border-2 border-pink-200 overflow-hidden">
                        <img src="https://plus.unsplash.com/premium_photo-1683120952553-af3ec9cd60c0?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="GlowSkin Product" class="w-full h-full object-cover">
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="py-20 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Mengapa Pilih Syvara?</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Kami menyediakan produk skincare original 100%</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card-hover p-8 bg-white rounded-2xl border border-pink-100">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-leaf text-2xl text-pink-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">100% Produk Original</h3>
                    <p class="text-gray-700">Semua produk dijamin authentic dari brand resmi tanpa barang KW</p>
                </div>

                <div class="card-hover p-8 bg-white rounded-2xl border border-pink-100">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-flask text-2xl text-pink-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Aman & Teruji</h3>
                    <p class="text-gray-700">Semua produk sudah through quality control dan standar keamanan internasional</p>
                </div>

                <div class="card-hover p-8 bg-white rounded-2xl border border-pink-100">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-star text-2xl text-pink-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Hasil Nyata</h3>
                    <p class="text-gray-700">Lebih dari 10.000 customer puas telah merasakan manfaat nyata dalam penggunaan rutin</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="bg-pink-600 text-white py-16 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div><h3 class="text-4xl font-bold mb-2">50K+</h3><p>Pelanggan Puas</p></div>
                <div><h3 class="text-4xl font-bold mb-2">20+</h3><p>Produk Unggulan</p></div>
                <div><h3 class="text-4xl font-bold mb-2">4.8★</h3><p>Rating Kepuasan</p></div>
                <div><h3 class="text-4xl font-bold mb-2">100%</h3><p>Natural Ingredients</p></div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20 px-4">
        <div class="max-w-4xl mx-auto bg-white rounded-3xl p-12 text-center border-2 border-pink-200">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Siap Merawat Kulit Anda?</h2>
            <p class="text-lg text-gray-700 mb-8">Dapatkan kulit impian Anda dengan produk skincare Syvara</p>
            <a href="/product" class="inline-block px-10 py-4 bg-pink-600 text-white rounded-lg font-bold hover:bg-pink-700 transition">
                <i class="fas fa-arrow-right mr-2"></i> Jelajahi Produk Sekarang
            </a>
        </div>
    </section>

    <x-footer></x-footer>
</body>
</html>
