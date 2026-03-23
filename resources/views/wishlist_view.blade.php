<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorit Saya - Syvara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Poppins', sans-serif; }

        .product-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .product-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(236, 72, 153, 0.2);
        }

        .product-img {
            overflow: hidden;
            position: relative;
        }

        .product-img img {
            transition: transform 0.4s ease;
        }

        .product-card:hover .product-img img {
            transform: scale(1.08);
        }

        .wishlist-badge {
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

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: scale(1);
            }
            to {
                opacity: 0;
                transform: scale(0.95);
            }
        }

        .fade-out {
            animation: fadeOut 0.3s ease-out;
        }

        .gradient-text {
            background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .heart-icon {
            transition: all 0.3s ease;
        }

        .heart-icon:active {
            transform: scale(1.2);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-pink-50 via-white to-pink-50">
    <x-navbar></x-navbar>

    <!-- Hero Section -->
    <section class="relative pt-12 pb-8 px-4 overflow-hidden">
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-10 left-10 w-64 h-64 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-64 h-64 bg-rose-200 rounded-full mix-blend-multiply filter blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <h3 class="text-4xl md:text-4xl font-bold gradient-text">Koleksi Favoritmu!</h3>
                </div>
                <p class="text-gray-600 text-lg md:text-xl max-w-2xl"> Simpan dan kelola koleksi favorit kamu di sini.
                </p>
            </div>
                        <!-- Empty State -->
            @if(!$products || $products->isEmpty())
                <div class="flex justify-center items-center py-20">
                    <div class="text-center max-w-md">
                        <div class="mb-6 inline-block">
                            <div class="w-32 h-32 bg-gradient-to-br from-pink-100 to-rose-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-heart text-6xl text-gray-300"></i>
                            </div>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-3">Belum ada favorit</h2>
                        <p class="text-gray-600 text-lg mb-8">
                            Jelajahi koleksi produk kami dan tambahkan item favorit kamu untuk melihatnya di sini.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="/product" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-xl font-semibold hover:shadow-lg transition duration-300">
                                <i class="fas fa-shopping-bag mr-2"></i> Jelajahi Produk
                            </a>
                            <a href="/" class="inline-flex items-center justify-center px-8 py-4 bg-white border-2 border-pink-300 text-pink-600 rounded-xl font-semibold hover:bg-pink-50 transition duration-300">
                                <i class="fas fa-home mr-2"></i> Kembali Beranda
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Products Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <div class="product-card group bg-white rounded-2xl overflow-hidden border border-pink-100 hover:border-pink-300 wishlist-badge">
                            <!-- Product Image -->
                            <div class="product-img relative h-64 bg-gradient-to-br from-pink-100 to-rose-100">
                                @if($product->image)
                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-cover"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-image text-5xl text-gray-300"></i>
                                    </div>
                                @endif

                                <!-- Overlay Actions -->
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition duration-300 flex items-end justify-between p-4 opacity-0 group-hover:opacity-100">
                                    <a href="/product/{{ $product->id }}" class="flex-1 mr-2 px-4 py-2 bg-white text-pink-600 rounded-lg font-semibold hover:bg-pink-50 transition text-center text-sm">
                                        <i class="fas fa-eye mr-1"></i> Detail
                                    </a>
                                </div>

                                <!-- Wishlist Button (Top Right) -->
                                <button
                                    class="wishlist-btn heart-icon absolute top-4 right-4 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-pink-50 transition duration-300 z-10"
                                    data-product-id="{{ $product->id }}"
                                    title="Hapus dari favorit"
                                >
                                    <i class="fas fa-heart text-pink-600 text-xl"></i>
                                </button>

                                <!-- Stock Badge -->
                                @if($product->stock > 0)
                                    <span class="absolute top-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                                        Stok: {{ $product->stock }}
                                    </span>
                                @else
                                    <span class="absolute top-4 left-4 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                                        Habis
                                    </span>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="p-5">
                                <!-- Category -->
                                @if($product->category)
                                    <span class="inline-block text-xs font-semibold text-pink-600 bg-pink-50 px-3 py-1 rounded-full mb-3">
                                        {{ $product->category->category_name }}
                                    </span>
                                @endif

                                <!-- Product Name -->
                                <h3 class="font-bold text-gray-900 text-lg mb-2 line-clamp-2 group-hover:text-pink-600 transition">
                                    {{ $product->name }}
                                </h3>

                                <!-- Price -->
                                <div class="mb-4">
                                    <p class="text-2xl font-bold gradient-text">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex gap-3">
                                    <a
                                        href="/product/{{ $product->id }}/detail"
                                        class="flex-1 px-4 py-3 bg-gradient-to-r from-pink-50 to-rose-50 text-pink-600 rounded-xl font-semibold hover:from-pink-100 hover:to-rose-100 transition duration-300 text-center text-sm border border-pink-200"
                                    >
                                        <i class="fas fa-cart-plus mr-1"></i> Beli
                                    </a>
                                    <button
                                        class="add-to-cart px-4 py-3 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-xl font-semibold hover:shadow-lg transition duration-300 text-sm"
                                        data-product-id="{{ $product->id }}"
                                        title="Tambah ke keranjang"
                                    >
                                        <i class="fas fa-shopping-bag"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
    </section>

    <!-- Main Content -->
    <section class=" px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Stats -->
            <div class="flex flex-wrap gap-4">
                <div class="bg-white/80 backdrop-blur-sm rounded-xl px-6 py-3 border border-pink-200">
                    <p class="text-sm text-gray-600">Total Favorit</p>
                    <p class="text-2xl font-bold text-pink-600">
                        @if($products && $products->count() > 0)
                            {{ $products->count() }}
                        @else
                            0
                        @endif
                    </p>
                </div>
                <div class="bg-white/80 backdrop-blur-sm rounded-xl px-6 py-3 border border-pink-200">
                    <p class="text-sm text-gray-600">Total Harga</p>
                    <p class="text-2xl font-bold text-pink-600">
                        @if($products && $products->count() > 0)
                            Rp {{ number_format($products->sum('price'), 0, ',', '.') }}
                        @else
                            Rp 0
                        @endif
                    </p>
                </div>
            </div>
        </div>
                <!-- Back to Shopping -->
                <div class="mt-16 text-center">
                    <p class="text-gray-600 mb-6">Ingin menambah lebih banyak favorit?</p>
                    <a href="/product" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-xl font-semibold hover:shadow-lg transition duration-300">
                        <i class="fas fa-shopping-bag"></i> Lanjutkan Belanja
                    </a>
                </div>
            @endif
        </div>
    </section>

    <x-footer></x-footer>

    <!-- Meta CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Script untuk remove dari wishlist -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Remove from wishlist
        document.querySelectorAll('.wishlist-btn').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                e.preventDefault();
                e.stopPropagation();

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

                    if (data.status === 'removed') {
                        // Animate card removal
                        const card = btn.closest('.product-card');
                        card.classList.add('fade-out');

                        setTimeout(() => {
                            card.remove();

                            // Check if no more products
                            const remainingCards = document.querySelectorAll('.product-card');
                            if (remainingCards.length === 0) {
                                location.reload();
                            }
                        }, 300);

                        // Show notification
                        showNotification('Dihapus dari favorit', 'success');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showNotification('Gagal menghapus dari favorit', 'error');
                }
            });
        });

        // Add to cart
        document.querySelectorAll('.add-to-cart').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const productId = btn.dataset.productId;
                showNotification('Produk ditambahkan ke keranjang!', 'success');
                // Implement actual cart logic here
            });
        });
    });

    // Notification function
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
            padding: 16px 24px;
            border-radius: 12px;
            z-index: 9999;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            animation: slideInUp 0.3s ease-out;
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.animation = 'slideOutDown 0.3s ease-out';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    // Add animation styles
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
