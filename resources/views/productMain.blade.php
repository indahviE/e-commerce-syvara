<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name ?? 'Detail Produk' }} - Syvara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Poppins', sans-serif; }

        .wishlist-btn {
            transition: all 0.3s ease;
        }

        .wishlist-btn:active {
            transform: scale(1.1);
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
    </style>
</head>
<body class="bg-gray-50">
    <x-navbar></x-navbar>

    <!-- Breadcrumb -->
    <section class="bg-white border-b border-gray-200 py-4 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="flex items-center gap-2 text-sm">
                <a href="/" class="text-pink-600 hover:text-pink-700">Home</a>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                <a href="/product" class="text-pink-600 hover:text-pink-700">Produk</a>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                <span class="text-gray-700">{{ $product->name ?? 'Detail Produk' }}</span>
            </div>
        </div>
    </section>

    <!-- Product Detail -->
    <section class="py-12 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Product Image -->
                <div>
                    <div class="bg-white rounded-2xl border border-pink-100 overflow-hidden p-6 mb-6 relative">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg">
                        @else
                            <div class="w-full h-80 bg-pink-50 rounded-lg flex items-center justify-center">
                                <i class="fas fa-image text-6xl text-pink-200"></i>
                            </div>
                        @endif

                        <!-- Wishlist Button - Top Right -->
                        @auth
                            <button
                                class="wishlist-btn absolute top-8 right-8 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-pink-50 transition z-10"
                                data-product-id="{{ $product->id }}"
                                title="Tambah ke favorit"
                            >
                                <i class="fas fa-heart {{ $product->isWishlisted() ? 'fas text-pink-600' : 'far text-gray-400' }} text-xl"></i>
                            </button>
                        @else
                            <a href="/login" class="absolute top-8 right-8 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-pink-50 transition z-10" title="Login untuk favorit">
                                <i class="far fa-heart text-gray-400 text-xl"></i>
                            </a>
                        @endauth
                    </div>
                    <span class="inline-block px-4 py-2 bg-pink-100 text-pink-700 rounded-lg text-sm font-semibold">
                        <i class="fas fa-tag mr-2"></i> {{ $product->category->category_name ?? 'Uncategorized' }}
                    </span>
                </div>

                <!-- Product Info -->
                <div class="space-y-6">
                    <!-- Title & Rating -->
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-3">{{ $product->name }}</h1>
                        <div class="flex items-center gap-4">
                            {{-- <div class="flex gap-1">
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star-half-alt text-yellow-400"></i>
                            </div> --}}
                            {{-- <span class="text-gray-600">(4.5 dari 5 - 248 ulasan)</span> --}}
                        </div>
                    </div>

                    <!-- Price & Stock -->
                    <div class="bg-pink-50 border border-pink-200 rounded-2xl p-6">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-gray-700 font-semibold">Harga:</span>
                            <span class="text-4xl font-bold text-pink-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-pink-200">
                            <span class="text-gray-700 font-semibold">Stok Tersedia:</span>
                            <span class="text-2xl font-bold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $product->stock > 0 ? $product->stock . ' pcs' : 'Habis' }}
                            </span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Deskripsi Produk</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="/product" class="flex-1 text-center px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </a>
                        <button class="flex-1 px-6 py-3 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-lg font-semibold hover:shadow-lg transition" {{ $product->stock == 0 ? 'disabled' : '' }}>
                            <i class="fas fa-shopping-bag mr-2"></i> Beli Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    @if (isset($relatedProducts) && $relatedProducts->count() > 0)
    <section class="py-16 px-4 bg-white border-t border-gray-200">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Produk Lainnya</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-5">
                @foreach ($relatedProducts as $related)
                <a href="/product/{{ $related->id }}/detail" class="product-card group bg-white rounded-2xl overflow-hidden border border-pink-100 hover:border-pink-300 block">
                    <!-- Product Image Container -->
                    <div class="product-img relative h-48 sm:h-56 overflow-hidden">
                        @if ($related->image)
                            <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-image text-4xl text-pink-300"></i>
                            </div>
                        @endif

                        <!-- Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>

                        <!-- Badges -->
                        <div class="absolute top-3 left-3 right-3 flex justify-between items-start">
                            {{-- NEW Badge - Hanya muncul kalo kurang dari 3 jam --}}
                            @if ($related->created_at->diffInHours(now()) < 3)
                                <span class="bg-gradient-to-r from-pink-500 to-rose-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                    ✨ NEW
                                </span>
                            @endif

                            {{-- Stock Status Badge --}}
                            @if ($related->stock < 5 && $related->stock > 0)
                                <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                    Terbatas
                                </span>
                            @elseif ($related->stock == 0)
                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                    Habis
                                </span>
                            @endif
                        </div>

                        <!-- Wishlist Button -->
                        @auth
                            <button
                                class="wishlist-btn-mini absolute top-3 right-3 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-pink-50 transition z-10"
                                data-product-id="{{ $related->id }}"
                                onclick="event.preventDefault(); event.stopPropagation();"
                                title="Tambah ke favorit"
                            >
                                <i class="fas fa-heart {{ $related->isWishlisted() ? 'fas text-pink-600' : 'far text-gray-400' }} text-lg"></i>
                            </button>
                        @else
                            <a href="/login" onclick="event.stopPropagation();" class="absolute top-3 right-3 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-pink-50 transition z-10" title="Login untuk favorit">
                                <i class="far fa-heart text-gray-400 text-lg"></i>
                            </a>
                        @endauth
                    </div>

                    <!-- Product Info -->
                    <div class="p-4">
                        <!-- Category Badge -->
                        <div class="mb-2">
                            <span class="inline-block text-xs font-bold text-pink-600 bg-pink-50 px-2.5 py-1 rounded-full border border-pink-200">
                                {{ $related->category->category_name ?? 'Produk' }}
                            </span>
                        </div>

                        <!-- Product Name -->
                        <h3 class="font-bold text-gray-900 text-sm line-clamp-2 mb-2 group-hover:text-pink-600 transition">
                            {{ $related->name }}
                        </h3>

                        <!-- Price -->
                        <p class="text-pink-600 font-bold text-lg mb-3">
                            Rp {{ number_format($related->price, 0, ',', '.') }}
                        </p>

                        <!-- Stock Info -->
                        <div class="flex items-center justify-between text-xs text-gray-600">
                            <span class="flex items-center gap-1">
                                <i class="fas fa-box text-pink-500"></i>
                                Stok: <strong class="text-gray-900">{{ $related->stock }}</strong>
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Specifications -->
    <section class="py-16 px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Spesifikasi Produk</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Umum</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Kategori:</span>
                            <span class="font-semibold text-gray-900">{{ $product->category->category_name ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between border-t border-gray-300 pt-3">
                            <span class="text-gray-600">Harga:</span>
                            <span class="font-semibold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between border-t border-gray-300 pt-3">
                            <span class="text-gray-600">Stok:</span>
                            <span class="font-semibold text-gray-900">{{ $product->stock }} pcs</span>
                        </div>
                        <div class="flex justify-between border-t border-gray-300 pt-3">
                            <span class="text-gray-600">Status:</span>
                            <span class="font-semibold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">{{ $product->stock > 0 ? 'Tersedia' : 'Habis' }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Panduan Penggunaan</h3>
                    <div class="space-y-3 text-sm text-gray-700">
                        <p><strong>Frekuensi:</strong> Gunakan 1-2 kali sehari</p>
                        <p><strong>Cara Pakai:</strong> Oleskan secara merata ke wajah yang sudah dibersihkan</p>
                        <p><strong>Waktu Terbaik:</strong> Pagi dan malam sebelum tidur</p>
                        <p><strong>Hasil:</strong> Terlihat dalam 2-4 minggu penggunaan teratur</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-16 px-4 bg-gray-50">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Pertanyaan Umum</h2>
            <div class="space-y-4">
                <details class="bg-white p-6 rounded-lg border border-pink-200 group cursor-pointer">
                    <summary class="flex justify-between items-center font-bold text-gray-900 hover:text-pink-600 transition">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-plus text-pink-600 group-open:hidden"></i>
                            <i class="fas fa-minus text-pink-600 hidden group-open:block"></i>
                            Apakah produk ini cocok untuk kulit saya?
                        </span>
                    </summary>
                    <p class="text-gray-700 mt-4 ml-8">Produk ini dirancang untuk semua jenis kulit, termasuk kulit sensitif. Namun, kami merekomendasikan melakukan patch test terlebih dahulu jika Anda memiliki kulit yang sangat sensitif atau alergi terhadap bahan-bahan tertentu.</p>
                </details>

                <details class="bg-white p-6 rounded-lg border border-pink-200 group cursor-pointer">
                    <summary class="flex justify-between items-center font-bold text-gray-900 hover:text-pink-600 transition">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-plus text-pink-600 group-open:hidden"></i>
                            <i class="fas fa-minus text-pink-600 hidden group-open:block"></i>
                            Berapa lama hasil akan terlihat?
                        </span>
                    </summary>
                    <p class="text-gray-700 mt-4 ml-8">Hasil awal biasanya terlihat dalam 2-4 minggu dengan penggunaan teratur. Hasil maksimal dapat dicapai dalam 8-12 minggu, tergantung kondisi kulit individual dan konsistensi penggunaan.</p>
                </details>

                <details class="bg-white p-6 rounded-lg border border-pink-200 group cursor-pointer">
                    <summary class="flex justify-between items-center font-bold text-gray-900 hover:text-pink-600 transition">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-plus text-pink-600 group-open:hidden"></i>
                            <i class="fas fa-minus text-pink-600 hidden group-open:block"></i>
                            Apakah ada efek samping?
                        </span>
                    </summary>
                    <p class="text-gray-700 mt-4 ml-8">Produk kami telah teruji dermatologi dan tidak memiliki efek samping yang signifikan. Namun, beberapa orang mungkin mengalami sedikit kemerahan atau ketidaknyamanan pada awal penggunaan karena proses adaptasi kulit. Jika ini terjadi, kurangi frekuensi penggunaan dan konsultasikan dengan dermatolog.</p>
                </details>

                <details class="bg-white p-6 rounded-lg border border-pink-200 group cursor-pointer">
                    <summary class="flex justify-between items-center font-bold text-gray-900 hover:text-pink-600 transition">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-plus text-pink-600 group-open:hidden"></i>
                            <i class="fas fa-minus text-pink-600 hidden group-open:block"></i>
                            Bagaimana cara menyimpan produk?
                        </span>
                    </summary>
                    <p class="text-gray-700 mt-4 ml-8">Simpan produk di tempat yang sejuk dan kering, jauh dari sinar matahari langsung. Hindari menyimpan di kamar mandi karena kelembaban tinggi dapat merusak produk. Gunakan dalam waktu 12 bulan setelah pembukaan untuk hasil optimal.</p>
                </details>
            </div>
        </div>
    </section>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <x-footer></x-footer>

    <!-- Wishlist Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Main wishlist button
        const mainBtn = document.querySelector('.wishlist-btn');
        if (mainBtn) {
            mainBtn.addEventListener('click', async (e) => {
                e.preventDefault();
                e.stopPropagation();
                await toggleWishlist(mainBtn);
            });
        }

        // Mini wishlist buttons in related products
        document.querySelectorAll('.wishlist-btn-mini').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                e.preventDefault();
                e.stopPropagation();
                await toggleWishlist(btn);
            });
        });
    });

    async function toggleWishlist(btn) {
        const productId = btn.dataset.productId;

        try {
            const response = await fetch(`/wishlist/toggle/${productId}`, {
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
            console.error('Error:', error);
            showNotification('Gagal update favorit', 'error');
        }
    }

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.textContent = message;

        const bgColor = type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6';

        notification.style.cssText = `
            position: fixed;
            bottom: 30px;
            right: 20px;
            background: ${bgColor};
            color: white;
            padding: 14px 20px;
            border-radius: 10px;
            z-index: 9999;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            animation: slideInUp 0.3s ease-out;
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.animation = 'slideOutDown 0.3s ease-out';
            setTimeout(() => notification.remove(), 300);
        }, 2500);
    }

    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInUp {
            from {
                transform: translateY(20px);
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
                transform: translateY(20px);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
    </script>
</body>
</html>
