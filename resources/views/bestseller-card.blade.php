<!-- resources/views/components/bestseller-card.blade.php -->

<div class="product-card group bg-white rounded-2xl overflow-hidden border border-orange-200 hover:border-orange-400 flex flex-col h-full shadow-lg hover:shadow-xl relative">

    <!-- ✅ BESTSELLER RIBBON -->
    <div class="ribbon"></div>

    <!-- Image Container -->
    <a href="/product/{{ $product->id }}/detail" class="block overflow-hidden">
        <div class="product-img relative h-40 sm:h-48">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                    class="w-full h-full object-cover transition-transform group-hover:scale-110">
            @else
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-orange-100 to-red-100">
                    <i class="fas fa-image text-4xl text-orange-300"></i>
                </div>
            @endif

            <!-- Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>

            <!-- Sold Badge -->
            @if(isset($product->total_sold) && $product->total_sold > 0)
                <div class="absolute bottom-3 left-3">
                    <div class="sold-badge">
                        <i class="fas fa-shopping-bag"></i>
                        {{ number_format($product->total_sold) }} terjual
                    </div>
                </div>
            @endif

            <!-- Wishlist Button -->
            @auth
                <button class="wishlist-btn absolute top-3 right-3 w-9 h-9 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-orange-50 transition z-10"
                    data-product-id="{{ $product->id }}"
                    onclick="event.preventDefault(); event.stopPropagation();"
                    title="Tambah ke favorit">
                    <i class="fas fa-heart {{ $product->isWishlisted() ? 'text-orange-500' : 'far text-gray-400' }} text-lg"></i>
                </button>
            @else
                <a href="/login" onclick="event.stopPropagation();"
                    class="absolute top-3 right-3 w-9 h-9 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-orange-50 transition z-10"
                    title="Login untuk favorit">
                    <i class="far fa-heart text-gray-400 text-lg"></i>
                </a>
            @endauth
        </div>
    </a>

    <!-- Content -->
    <div class="p-3 flex flex-col flex-grow">

        <!-- Category Badges -->
        @if($product->categories->count() > 0)
            <div class="mb-2 flex flex-wrap gap-1">
                @foreach($product->categories->take(2) as $category)
                    <span class="inline-block text-xs font-bold text-orange-600 bg-orange-50 px-2 py-0.5 rounded-full border border-orange-200">
                        {{ $category->category_name }}
                    </span>
                @endforeach
                @if($product->categories->count() > 2)
                    <span class="text-xs text-gray-400">+{{ $product->categories->count() - 2 }}</span>
                @endif
            </div>
        @endif

        <!-- Product Name -->
        <h3 class="font-bold text-gray-900 text-sm line-clamp-2 min-h-[40px] mb-2 group-hover:text-orange-600 transition">
            {{ $product->name }}
        </h3>

        <!-- Price -->
        <p class="font-bold text-lg mb-2" style="background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
            Rp {{ number_format($product->price, 0, ',', '.') }}
        </p>

        <!-- Stock Info -->
        <div class="flex items-center justify-between text-xs text-gray-600 mb-3">
            <span class="flex items-center gap-1">
                <i class="fas fa-box text-orange-500"></i>
                Stok: <strong class="text-gray-900">{{ $product->stock }}</strong>
            </span>
        </div>

        <!-- Action Buttons (sticky at bottom) -->
        <div class="flex gap-2 mt-auto">
            <form action="{{ route('show_single_payment') }}" method="post" class="flex gap-2 flex-1">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $product->id }}">
                <select name="qty" class="text-xs border border-orange-200 rounded px-1 py-1">
                    @for($i = 1; $i <= min(10, $product->stock); $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <button type="submit"
                    class="flex-1 text-orange-600 border border-orange-200 rounded-lg font-semibold hover:bg-orange-50 transition text-xs py-1">
                    Checkout
                </button>
            </form>

            <button type="button"
                onclick="addToCart('{{ route('cart_product_add') }}', '{{ $product->id }}')"
                class="px-3 py-1 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-lg font-semibold hover:shadow-lg transition text-xs">
                <i class="fas fa-shopping-bag"></i>
            </button>
        </div>
    </div>
</div>
