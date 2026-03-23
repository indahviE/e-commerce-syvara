<x-app-layout>
    <title>About - GlowSkin</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Poppins', sans-serif; }
        .card-hover:hover { transform: translateY(-8px); box-shadow: 0 12px 24px rgba(236, 72, 153, 0.1); }
    </style>
</head>
<body class="bg-gray-50">
    <x-navbar></x-navbar>

    <!-- Hero -->
    <section class="bg-pink-600 text-white py-24 px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-5xl font-bold mb-6">Tentang Syvara</h1>
            <p class="text-xl text-pink-100">Kami berkomitmen menyediakan skincare berkualitas tinggi untuk kulit sehat dan bercahaya Anda</p>
        </div>
    </section>

    <!-- Content -->
    <section class="py-20 px-4 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-20">
                <div>
                    <h2 class="text-4xl font-bold mb-6 text-pink-600">Siapa Kami?</h2>
                    <p class="text-gray-700 text-lg mb-4 leading-relaxed">
                        Your One-Stop Beauty Destination, Kami adalah platform yang menghadirkan semua brand skincare dan beauty care favorit Anda dalam satu tempat.
                    </p>
                    <p class="text-gray-700 text-lg mb-4 leading-relaxed">
                        Dari produk lokal hingga internasional, semua original dan terpercaya dengan harga yang kompetitif untuk semua orang.
                    </p>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        Quality adalah prioritas kami, setiap produk sudah verified authentic dan melalui quality check sebelum sampai ke tangan Anda.
                    </p>
                </div>
                {{-- <div class="bg-pink-50 rounded-2xl p-12 flex items-center justify-center min-h-96 border-2 border-pink-200">
                    <i class="fas fa-spa text-8xl text-pink-200 opacity-40"></i>
                </div> --}}
                <div class="hidden md:block">
                    <div class="rounded-3xl h-96 flex items-center justify-center border-2 border-pink-200 overflow-hidden">
                        <img src="https://plus.unsplash.com/premium_photo-1682095615234-7f0a053a85a1?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Syvara Product" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <!-- Values -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
                <div class="card-hover p-8 bg-white rounded-2xl border border-pink-100 text-center">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shopping-bag text-2xl text-pink-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-900">Misi Kami</h3>
                    <p class="text-gray-700">Menyediakan akses mudah ke produk perawatan kecantikan berkualitas tinggi dari brand-brand terpercaya dengan harga terjangkau</p>
                </div>

                <div class="card-hover p-8 bg-white rounded-2xl border border-pink-100 text-center">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-star text-2xl text-pink-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-900">Visi Kami</h3>
                    <p class="text-gray-700">Menjadi platform beauty terpercaya pilihan utama dengan koleksi lengkap dan layanan terbaik untuk semua kalangan</p>
                </div>

                <div class="card-hover p-8 bg-white rounded-2xl border border-pink-100 text-center">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-handshake text-2xl text-pink-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-900">Nilai Kami</h3>
                    <p class="text-gray-700">Autentik, Terpercaya, Berkualitas, dan Customer-Centric adalah komitmen kami setiap hari</p>
                </div>
            </div>

            <!-- Keunggulan Platform -->
            <div class="bg-gray-900 rounded-2xl p-12 text-white">
                <h2 class="text-4xl font-bold mb-12 text-center">Keunggulan Platform Kami</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div>
                        <div class="w-20 h-20 bg-gray-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-check-circle text-4xl text-pink-400"></i>
                        </div>
                        <h4 class="font-bold text-lg mb-2">100% Original</h4>
                        <p class="text-gray-300">Semua produk dijamin authentic dari brand resmi</p>
                    </div>

                    <div>
                        <div class="w-20 h-20 bg-gray-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-box text-4xl text-pink-400"></i>
                        </div>
                        <h4 class="font-bold text-lg mb-2">Koleksi Lengkap</h4>
                        <p class="text-gray-300">Brand internasional dan lokal terbaik dalam satu tempat</p>
                    </div>

                    <div>
                        <div class="w-20 h-20 bg-gray-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-heart text-4xl text-pink-400"></i>
                        </div>
                        <h4 class="font-bold text-lg mb-2">Customer Care</h4>
                        <p class="text-gray-300">Dukungan penuh untuk kepuasan dan pengalaman berbelanja terbaik</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team -->
    <section class="py-20 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 text-gray-900">Tim Kami</h2>
                <p class="text-gray-600 text-lg">Profesional yang berdedikasi untuk kesehatan kulit Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl overflow-hidden border border-pink-200 text-center">
                    <div class="h-48 bg-pink-100 flex items-center justify-center">
                        <i class="fas fa-user-circle text-7xl text-pink-300"></i>
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900">Tim Founder</h4>
                        <p class="text-pink-600 font-semibold">Founder & CEO</p>
                        <p class="text-gray-700 text-sm mt-2">Berpengalaman lebih dari 10 tahun di industri skincare</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl overflow-hidden border border-pink-200 text-center">
                    <div class="h-48 bg-pink-100 flex items-center justify-center">
                        <i class="fas fa-user-circle text-7xl text-pink-300"></i>
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900">Tim Dermatologist</h4>
                        <p class="text-pink-600 font-semibold">Chief Formulator</p>
                        <p class="text-gray-700 text-sm mt-2">Ahli dermatologi dengan sertifikasi internasional</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl overflow-hidden border border-pink-200 text-center">
                    <div class="h-48 bg-pink-100 flex items-center justify-center">
                        <i class="fas fa-user-circle text-7xl text-pink-300"></i>
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900">Tim Customer Care</h4>
                        <p class="text-pink-600 font-semibold">Head of Operations</p>
                        <p class="text-gray-700 text-sm mt-2">Siap melayani Anda dengan sepenuh hati 24/7</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-footer></x-footer>
</body>
</x-app-layout>
