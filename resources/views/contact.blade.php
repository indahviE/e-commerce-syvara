<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - GlowSkin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Poppins', sans-serif; }
        .form-input:focus { outline: none; box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1); border-color: #ec4899; }
    </style>
</head>
<body class="bg-white">
    <x-navbar></x-navbar>

    <!-- Hero -->
    <section class="py-20 px-4 border-b border-pink-100">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">Hubungi Kami</h1>
            <p class="text-xl text-gray-700">Kami siap membantu Anda dengan semua pertanyaan tentang produk skincare kami</p>
        </div>
    </section>

    <!-- Contact Methods -->
    <section class="py-20 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div class="bg-white p-8 rounded-2xl border border-pink-200 text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-phone text-2xl text-pink-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Telepon</h3>
                    <p class="text-gray-600 mb-4">Hubungi kami langsung untuk bantuan cepat</p>
                    <a href="tel:+6281234567" class="text-pink-600 font-bold text-lg hover:text-pink-700">+62 812-345-6789</a>
                    <p class="text-gray-500 text-sm mt-3">Senin - Jumat, 09:00 - 18:00</p>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-pink-200 text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-envelope text-2xl text-pink-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Email</h3>
                    <p class="text-gray-600 mb-4">Kirim email untuk pertanyaan detail</p>
                    <a href="mailto:hello@glowskin.com" class="text-pink-600 font-bold text-lg hover:text-pink-700 break-all">hello@glowskin.com</a>
                    <p class="text-gray-500 text-sm mt-3">Respons dalam 24 jam</p>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-pink-200 text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marker-alt text-2xl text-pink-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Lokasi</h3>
                    <p class="text-gray-600 mb-4">Kunjungi showroom kami</p>
                    <p class="text-gray-800 font-bold">Jakarta, Indonesia</p>
                    <p class="text-gray-500 text-sm mt-3">Jl. Senayan Raya No. 123</p>
                </div>
            </div>

            <!-- Form & Map -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Form -->
                <div class="bg-pink-50 p-8 rounded-2xl border border-pink-200">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h3>
                    <form action="https://formspree.io/f/xbdargga" method="POST" class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" placeholder="Masukkan nama Anda" required
                                class="form-input w-full px-4 py-3 border-2 border-pink-200 rounded-lg transition">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" placeholder="email@example.com" required
                                class="form-input w-full px-4 py-3 border-2 border-pink-200 rounded-lg transition">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="tel" name="phone" placeholder="+62 812-xxx-xxxx"
                                class="form-input w-full px-4 py-3 border-2 border-pink-200 rounded-lg transition">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Subjek</label>
                            <input type="text" name="subject" placeholder="Topik pertanyaan Anda" required
                                class="form-input w-full px-4 py-3 border-2 border-pink-200 rounded-lg transition">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pesan</label>
                            <textarea rows="5" name="message" placeholder="Tuliskan pesan Anda di sini..." required
                                class="form-input w-full px-4 py-3 border-2 border-pink-200 rounded-lg transition resize-none"></textarea>
                        </div>

                        <button type="submit" class="w-full px-6 py-3 bg-pink-600 text-white rounded-lg font-bold hover:bg-pink-700 transition">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Pesan
                        </button>
                    </form>
                </div>

                <!-- Map & Social -->
                <div class="space-y-8">
                    <a href="https://maps.app.goo.gl/i8v1PHuBoh38mQmcA?g_st=aw" target="_blank" class="block bg-gray-200 rounded-2xl h-96 border-2 border-gray-300 overflow-hidden hover:bg-gray-300 transition">
                        <div class="w-full h-full flex items-center justify-center">
                            <div class="text-center">
                                <i class="fas fa-map-marked-alt text-6xl text-pink-600 mb-4 block"></i>
                                <p class="text-gray-700 font-bold text-lg">Buka Lokasi di Google Maps</p>
                                <p class="text-gray-600 text-sm mt-2">Klik untuk melihat rute & detail lengkap</p>
                            </div>
                        </div>
                    </a>

                    <div class="bg-white p-8 rounded-2xl border border-pink-200">
                        <h4 class="text-xl font-bold text-gray-900 mb-6">Follow Kami</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <a href="#" class="p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition text-center">
                                <i class="fab fa-instagram text-2xl text-blue-600 mb-2 block"></i>
                                <span class="text-sm font-semibold text-blue-600">Instagram</span>
                            </a>
                            <a href="#" class="p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition text-center">
                                <i class="fab fa-facebook text-2xl text-blue-600 mb-2 block"></i>
                                <span class="text-sm font-semibold text-blue-600">Facebook</span>
                            </a>
                            <a href="#" class="p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition text-center">
                                <i class="fab fa-twitter text-2xl text-blue-600 mb-2 block"></i>
                                <span class="text-sm font-semibold text-blue-600">Twitter</span>
                            </a>
                            <a href="#" class="p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition text-center">
                                <i class="fab fa-tiktok text-2xl text-blue-600 mb-2 block"></i>
                                <span class="text-sm font-semibold text-blue-600">TikTok</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-20 px-4 bg-gray-50">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Pertanyaan Umum</h2>
                <p class="text-gray-700 text-lg">Cari jawaban untuk pertanyaan Anda di sini</p>
            </div>

            <div class="space-y-4">
                <details class="bg-white p-6 rounded-lg border border-pink-200 group cursor-pointer">
                    <summary class="flex justify-between items-center font-bold text-gray-900 hover:text-pink-600 transition">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-plus text-pink-600 group-open:hidden"></i>
                            <i class="fas fa-minus text-pink-600 hidden group-open:block"></i>
                            Berapa lama pengiriman produk?
                        </span>
                    </summary>
                    <p class="text-gray-700 mt-4 ml-8">Waktu pengiriman standar adalah 2-5 hari kerja ke seluruh wilayah Indonesia. Untuk area tertentu mungkin memerlukan waktu lebih lama.</p>
                </details>

                <details class="bg-white p-6 rounded-lg border border-pink-200 group cursor-pointer">
                    <summary class="flex justify-between items-center font-bold text-gray-900 hover:text-pink-600 transition">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-plus text-pink-600 group-open:hidden"></i>
                            <i class="fas fa-minus text-pink-600 hidden group-open:block"></i>
                            Apakah produk aman untuk kulit sensitif?
                        </span>
                    </summary>
                    <p class="text-gray-700 mt-4 ml-8">Semua produk GlowSkin telah teruji dermatologi dan aman untuk kulit sensitif. Namun, kami tetap merekomendasikan untuk melakukan patch test terlebih dahulu.</p>
                </details>

                <details class="bg-white p-6 rounded-lg border border-pink-200 group cursor-pointer">
                    <summary class="flex justify-between items-center font-bold text-gray-900 hover:text-pink-600 transition">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-plus text-pink-600 group-open:hidden"></i>
                            <i class="fas fa-minus text-pink-600 hidden group-open:block"></i>
                            Berapa lama hasil skincare terlihat?
                        </span>
                    </summary>
                    <p class="text-gray-700 mt-4 ml-8">Hasil biasanya mulai terlihat dalam 2-4 minggu dengan penggunaan teratur. Hasil maksimal dapat dicapai dalam 8-12 minggu tergantung kondisi kulit individu.</p>
                </details>

                <details class="bg-white p-6 rounded-lg border border-pink-200 group cursor-pointer">
                    <summary class="flex justify-between items-center font-bold text-gray-900 hover:text-pink-600 transition">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-plus text-pink-600 group-open:hidden"></i>
                            <i class="fas fa-minus text-pink-600 hidden group-open:block"></i>
                            Apakah ada garansi uang kembali?
                        </span>
                    </summary>
                    <p class="text-gray-700 mt-4 ml-8">Ya! Kami menawarkan garansi kepuasan 100%. Jika Anda tidak puas dengan produk, Anda dapat mengembalikannya dalam 30 hari untuk pengembalian dana penuh tanpa pertanyaan.</p>
                </details>
            </div>
        </div>
    </section>

    <x-footer></x-footer>
</body>
</html>
