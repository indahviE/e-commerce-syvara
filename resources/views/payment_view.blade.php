<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Checkout - Syvara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('storage/css/payment.css') }}">
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

        .heart-btn {
            transition: all 0.2s ease;
        }

        .heart-btn:active {
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
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <x-navbar></x-navbar>

    <!-- MAIN CONTENT -->
    <form action="{{ route('checkout') }}" method="post" class="flex mx-48 gap-5 my-12">
        @csrf
        {{-- ── SIDE BAR ────────────────────────────────────────────────── --}}
        <div class="w-7/12">
            <div class="card summary-card">
                <div class="card-header">
                    <h2><span class="dot"></span> Form Checkout</h2>
                </div>

                {{-- Mini pill summary --}}
                {{-- <div class="detail-summary-badge">
                    <span class="detail-pill" onclick="openDetailPanel('alamat')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z" />
                        </svg>
                        <span id="pill-alamat">+ Alamat</span>
                    </span>
                    <span class="detail-pill" onclick="openDetailPanel('payment')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <rect x="2" y="5" width="20" height="14" rx="3" />
                            <path d="M2 10h20" />
                        </svg>
                        <span id="pill-payment">+ Pembayaran</span>
                    </span>
                    <span class="detail-pill" onclick="openDetailPanel('pengiriman')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h11a2 2 0 012 2v3M13 17h8l-3-6H13V7" />
                            <circle cx="7.5" cy="18.5" r="1.5" />
                            <circle cx="17.5" cy="18.5" r="1.5" />
                        </svg>
                        <span id="pill-pengiriman">+ Pengiriman</span>
                    </span>
                </div> --}}

                <div class="summary-body">
                    <div class="flex flex-col gap-5">
                        {{-- ── 1. ALAMAT PENGIRIMAN ─────────────────────────── --}}
                        <div id="section-alamat">
                            <p class="panel-section-title">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="var(--pk)" stroke="none">
                                    <path
                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z" />
                                </svg>
                                Alamat Pengiriman
                            </p>
                            <div class="field-group">
                                <div>
                                    <label class="field-label">Nama Penerima</label>
                                    <input type="text" value="{{ Auth::user()->name }}" required name="nama_penerima" class="field-input"
                                        id="f-nama" placeholder="Nama lengkap penerima">
                                </div>
                                <div>
                                    <label class="field-label">Nomor Telepon</label>
                                    <input type="tel" class="field-input" id="f-telp" required name="no_telp" placeholder="08xxxxxxxxxx">
                                </div>
                                <div class="field-row">
                                    <div>
                                        <label class="field-label">Provinsi</label>
                                        <select class="field-select" id="f-provinsi" name="provinsi" required>
                                            <option value="">Pilih Provinsi</option>
                                            <option>Jawa Barat</option>
                                            <option>Jawa Tengah</option>
                                            <option>Jawa Timur</option>
                                            <option>DKI Jakarta</option>
                                            <option>DI Yogyakarta</option>
                                            <option>Banten</option>
                                            <option>Bali</option>
                                            <option>Sumatera Utara</option>
                                            <option>Sumatera Selatan</option>
                                            <option>Kalimantan Timur</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="field-label">Kota / Kabupaten</label>
                                        <input type="text" class="field-input" id="f-kota" required
                                            placeholder="Nama kota" name="kabupaten">
                                    </div>
                                </div>
                                <div class="field-row">
                                    <div>
                                        <label class="field-label">Kecamatan</label>
                                        <input type="text" class="field-input" id="f-kec"
                                            placeholder="Kecamatan" name="kecamatan" required>
                                    </div>
                                    <div>
                                        <label class="field-label">Kode Pos</label>
                                        <input type="text" class="field-input" name="kode_pos" required id="f-kodepos" placeholder="12345"
                                            maxlength="5">
                                    </div>
                                </div>
                                <div>
                                    <label class="field-label">Alamat Lengkap</label>
                                    <textarea class="field-input" name="alamat" required id="f-alamat" rows="3" placeholder="Jl. Nama Jalan No. xx, RT/RW, Kelurahan..."
                                        style="resize:vertical; line-height:1.5;"> </textarea>
                                </div>
                                <div>
                                    <label class="field-label">Catatan untuk Kurir <span
                                            style="color:var(--gray); font-weight:400;">(opsional)</span></label>
                                    <input type="text" class="field-input" id="f-catatan"
                                        placeholder="Contoh: titip di depan pagar" name="catatan_kurir">
                                </div>
                            </div>
                        </div>

                        {{-- ── 2. METODE PEMBAYARAN ─────────────────────────── --}}
                        <div id="section-payment">
                            <p class="panel-section-title">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--pk)"
                                    stroke-width="2.5">
                                    <rect x="2" y="5" width="20" height="14" rx="3" />
                                    <path d="M2 10h20" />
                                </svg>
                                Metode Pembayaran
                            </p>
                            <div class="payment-options">

                                <label class="payment-option selected" onclick="selectPayment(this, 'qris')">
                                    <input type="radio" name="payment_method" value="qris" checked>
                                    <div class="payment-icon-box" style="background:#FFF3E0; color:#E65100;">QRIS</div>
                                    <div>
                                        <div class="payment-option-label">QRIS</div>
                                        <div class="payment-option-sub">Scan & bayar</div>
                                    </div>
                                </label>

                                <label class="payment-option" onclick="selectPayment(this, 'transfer')">
                                    <input type="radio" name="payment_method" value="transfer">
                                    <div class="payment-icon-box" style="background:#E3F2FD; color:#0D47A1;">TF</div>
                                    <div>
                                        <div class="payment-option-label">Transfer Bank</div>
                                        <div class="payment-option-sub">BCA / BNI / BRI</div>
                                    </div>
                                </label>

                                <label class="payment-option" onclick="selectPayment(this, 'va')">
                                    <input type="radio" name="payment_method" value="va">
                                    <div class="payment-icon-box" style="background:#E8F5E9; color:#1B5E20;">VA</div>
                                    <div>
                                        <div class="payment-option-label">Virtual Account</div>
                                        <div class="payment-option-sub">Auto konfirmasi</div>
                                    </div>
                                </label>

                                <label class="payment-option" onclick="selectPayment(this, 'cod')">
                                    <input type="radio" name="payment_method" value="cod">
                                    <div class="payment-icon-box" style="background:#FCE4EC; color:#880E4F;">COD</div>
                                    <div>
                                        <div class="payment-option-label">Bayar di Tempat</div>
                                        <div class="payment-option-sub">Cash on Delivery</div>
                                    </div>
                                </label>

                                <label class="payment-option" onclick="selectPayment(this, 'ewallet')">
                                    <input type="radio" name="payment_method" value="ewallet">
                                    <div class="payment-icon-box" style="background:#F3E5F5; color:#4A148C;">EW</div>
                                    <div>
                                        <div class="payment-option-label">E-Wallet</div>
                                        <div class="payment-option-sub">GoPay / OVO / Dana</div>
                                    </div>
                                </label>

                                <label class="payment-option" onclick="selectPayment(this, 'paylater')">
                                    <input type="radio" name="payment_method" value="paylater">
                                    <div class="payment-icon-box" style="background:#FFF8E1; color:#F57F17;">PL</div>
                                    <div>
                                        <div class="payment-option-label">Pay Later</div>
                                        <div class="payment-option-sub">Kredivo / Akulaku</div>
                                    </div>
                                </label>

                            </div>
                        </div>


                    </div>
                    <!-- KODE PROMO -->
                    <div class="promo-input-group mt-16">
                        <input type="text" name="voucher" class="promo-input" placeholder="Kode promo / voucher" id="promoCode">
                        <button type="button" class="btn-promo"
                            onclick="checkPromo('{{ route('check_promo') }}')">Pakai</button>
                    </div>

                    <!-- RINCIAN -->
                    <div class="summary-row">
                        <span>Subtotal (<span id="item-count">4</span> item)</span>
                        <span id="summary-subtotal">Rp 1.633.731</span>
                    </div>
                    <div class="summary-row">
                        <span>Discount</span>
                        <span id="summary-discount">-</span>
                    </div>
                    <div class="summary-row discount" id="discount-row">
                        <span>Diskon Promo</span>
                        <span id="discount-amount">Rp 0</span>
                    </div>
                    <div class="summary-row shipping">
                        <span>Ongkos Kirim</span>
                        <span id="shipping-cost-display">15.000</span>
                    </div>
                    <div class="summary-row">
                        <span>Biaya Layanan</span>
                        <span>Rp 2.000</span>
                    </div>

                    <hr class="summary-divider">

                    <div class="summary-total">
                        <span>Total Pembayaran</span>
                        <span class="total-price" id="summary-total">Rp 1.650.731</span>
                    </div>

                    {{-- <button class="btn-checkout" onclick="handleCheckout()"> --}}
                    {{-- <form action="{{ route('show_payment') }}" method="post">
                        @csrf --}}
                    <button onclick="document.getElementById('form_button_submit').click();" class="btn-checkout">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <path
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Bayar Sekarang
                    </button>
                    {{-- </form> --}}

                    {{-- <button class="btn-detail-order" onclick="openDetailPanel('alamat')">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 8v4l3 3" />
                        </svg>
                        Atur Detail Pesanan
                    </button> --}}

                    <a href="{{ route('productMember') }}" class="btn-continue">← Cancel Checkout</a>

                    <div class="guarantee-row">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Pembayaran 100% aman & terpercaya
                    </div>
                </div>
            </div>
        </div>


        <!-- LEFT: CART ITEMS -->
        <div class="w-5/12" class="mb-16">
            {{-- @csrf --}}
            <div class="card">
                <div class="card-header">
                    <h2><span class="dot"></span> Daftar Produk Yang dipilih</h2>
                    <span style="font-size:0.8rem;color:var(--text-gray);">{{ count($products) }} item</span>
                </div>

                <!-- ITEM 1 -->
                @foreach ($products as $data)
                    <div class="cart-item" id="item-{{ $loop->iteration }}">
                        <input type="text" type="number" name="id[]" value="{{ $data->id }}" hidden>
                        <div href="/product/{{ $data->id }}/detail"
                            style="width:90px;height:90px;border-radius:14px;background:var(--pink-light);flex-shrink:0;display:flex;align-items:center;justify-content:center;border:1.5px solid var(--border);">
                            <img src="{{ asset('storage/' . $data->image) }}" onerror="this.style.display='none'"
                                alt="Centella Serum" class="item-image"
                                style="width:90px;height:90px;position:absolute;">
                            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#FFAFD4"
                                stroke-width="1.5">
                                <path d="M9 3h6l1 4H8L9 3z" />
                                <path d="M8 7v13a1 1 0 001 1h6a1 1 0 001-1V7" />
                                <path d="M10 11v6M14 11v6" />
                            </svg>
                        </div>
                        <div class="item-info">
                            {{-- <a href="/product/{{ $data->id }}/detail"> --}}
                            <span class="item-badge">{{ $data->categories->pluck('category_name')->join(', ') }}</span>
                            <div class="item-name">{{ $data->name }}</div>
                            <div class="item-stock">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z" />
                                    <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16" />
                                </svg>
                                Stok: {{ $data->stock }}
                            </div>
                            {{-- </a> --}}
                            <div class="item-bottom">
                                <div>
                                    <div class="item-price">Rp {{ number_format($data->price, 0, ',', '.') }}
                                    </div>
                                    <div class="item-subtotal" id="subtotal-{{ $loop->iteration }}">Subtotal: Rp
                                        {{ number_format($data->price * $data->qty, 0, ',', '.') }}</div>
                                </div>
                                <div class="">
                                    {{-- <button type="button" class="qty-btn"
                                        onclick="changeQty('qty-{{ $loop->iteration }}', -1, {{ $data->price }}, 'subtotal-{{ $loop->iteration }}')">−</button> --}}
                                    <input type="number" id="qty-{{ $loop->iteration }}" class="qty-input"
                                        value="{{ $data->qty }}" min="1" max="11" name="qtys[]"
                                        readonly
                                        onchange="calcSubtotal('qty-{{ $loop->iteration }}', {{ $data->price }}, 'subtotal-{{ $loop->iteration }}')"
                                        hidden>
                                    {{-- <button type="button" class="qty-btn"
                                        onclick="changeQty('qty-{{ $loop->iteration }}', 1, {{ $data->price }}, 'subtotal-{{ $loop->iteration }}')">+</button> --}}
                                    <span class="font-bold text-gray-600 text-xs m-3">{{$data->qty}} items</span>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach


                <div class="card-header mt-4">
                    <h2><span class="dot"></span> Waktu pengiriman</h2>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--pk)"
                        stroke-width="2.5">
                        <path d="M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h11a2 2 0 012 2v3M13 17h8l-3-6H13V7" />
                        <circle cx="7.5" cy="18.5" r="1.5" />
                        <circle cx="17.5" cy="18.5" r="1.5" />
                    </svg>
                    {{-- <span style="font-size:0.8rem;color:var(--text-gray);">{{ count($products) }} item</span> --}}
                </div>

                {{-- ── 3. WAKTU PENGIRIMAN ──────────────────────────── --}}
                <div id="section-pengiriman">

                    <div class="shipping-options p-4 pb-8">

                        <label class="shipping-option" onclick="selectShipping(this, 'fast', 25000)">
                            <input type="radio" name="shipping" value="fast">
                            <div class="shipping-icon" style="background:#FFF3E0;">⚡</div>
                            <div class="ship-info">
                                <div class="ship-name">Fast Delivery</div>
                                <div class="ship-duration">Estimasi 1–2 hari kerja</div>
                                <span class="ship-badge" style="background:#FFF3E0; color:#E65100;">Tercepat</span>
                            </div>
                            <div>
                                <div class="ship-price">Rp 25.000</div>
                            </div>
                        </label>

                        <label class="shipping-option selected" onclick="selectShipping(this, 'medium', 15000)">
                            <input type="radio" name="shipping" value="medium" checked>
                            <div class="shipping-icon" style="background:#E8F5E9;">🚚</div>
                            <div class="ship-info">
                                <div class="ship-name">Medium Delivery</div>
                                <div class="ship-duration">Estimasi 3–5 hari kerja</div>
                                <span class="ship-badge" style="background:#E8F5E9; color:#2E7D32;">Populer</span>
                            </div>
                            <div>
                                <div class="ship-price">Rp 15.000</div>
                            </div>
                        </label>

                        <label class="shipping-option" onclick="selectShipping(this, 'slow', 8000)">
                            <input type="radio" name="shipping" value="slow">
                            <div class="shipping-icon" style="background:#E3F2FD;">📦</div>
                            <div class="ship-info">
                                <div class="ship-name">Slow Delivery</div>
                                <div class="ship-duration">Estimasi 5–7 hari kerja</div>
                                <span class="ship-badge" style="background:#E3F2FD; color:#0D47A1;">Hemat</span>
                            </div>
                            <div>
                                <div class="ship-price">Rp 8.000</div>
                            </div>
                        </label>

                    </div>
                </div>
            </div>


            <button type="submit" id="form_button_submit" hidden>test</button>
        </div>



        {{-- ── OVERLAY ─────────────────────────────────────────────── --}}
        <div class="panel-overlay" id="panelOverlay" onclick="closeDetailPanel()"></div>

        {{-- ── DETAIL PANEL ────────────────────────────────────────── --}}
        <div class="detail-panel" id="detailPanel">
            <div class="panel-head">
                <h3>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--pk)"
                        stroke-width="2.5">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 8v4l3 3" />
                    </svg>
                    Detail Pesanan
                </h3>
                <button class="panel-close" onclick="closeDetailPanel()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <path d="M18 6L6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="panel-body">

                {{-- ── 1. ALAMAT PENGIRIMAN ─────────────────────────── --}}
                <div id="section-alamat">
                    <p class="panel-section-title">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="var(--pk)" stroke="none">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z" />
                        </svg>
                        Alamat Pengiriman
                    </p>
                    <div class="field-group">
                        <div>
                            <label class="field-label">Nama Penerima</label>
                            <input type="text" class="field-input" id="f-nama"
                                placeholder="Nama lengkap penerima">
                        </div>
                        <div>
                            <label class="field-label">Nomor Telepon</label>
                            <input type="tel" class="field-input" id="f-telp" placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="field-row">
                            <div>
                                <label class="field-label">Provinsi</label>
                                <select class="field-select" id="f-provinsi">
                                    <option value="">Pilih Provinsi</option>
                                    <option>Jawa Barat</option>
                                    <option>Jawa Tengah</option>
                                    <option>Jawa Timur</option>
                                    <option>DKI Jakarta</option>
                                    <option>DI Yogyakarta</option>
                                    <option>Banten</option>
                                    <option>Bali</option>
                                    <option>Sumatera Utara</option>
                                    <option>Sumatera Selatan</option>
                                    <option>Kalimantan Timur</option>
                                </select>
                            </div>
                            <div>
                                <label class="field-label">Kota / Kabupaten</label>
                                <input type="text" class="field-input" id="f-kota" placeholder="Nama kota">
                            </div>
                        </div>
                        <div class="field-row">
                            <div>
                                <label class="field-label">Kecamatan</label>
                                <input type="text" class="field-input" id="f-kec" placeholder="Kecamatan">
                            </div>
                            <div>
                                <label class="field-label">Kode Pos</label>
                                <input type="text" class="field-input" id="f-kodepos" placeholder="12345"
                                    maxlength="5">
                            </div>
                        </div>
                        <div>
                            <label class="field-label">Alamat Lengkap</label>
                            <textarea class="field-input" id="f-alamat" rows="3" placeholder="Jl. Nama Jalan No. xx, RT/RW, Kelurahan..."
                                style="resize:vertical; line-height:1.5;"></textarea>
                        </div>
                        <div>
                            <label class="field-label">Catatan untuk Kurir <span
                                    style="color:var(--gray); font-weight:400;">(opsional)</span></label>
                            <input type="text" class="field-input" id="f-catatan"
                                placeholder="Contoh: titip di depan pagar">
                        </div>
                    </div>
                </div>

                {{-- ── 2. METODE PEMBAYARAN ─────────────────────────── --}}
                <div id="section-payment">
                    <p class="panel-section-title">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--pk)"
                            stroke-width="2.5">
                            <rect x="2" y="5" width="20" height="14" rx="3" />
                            <path d="M2 10h20" />
                        </svg>
                        Metode Pembayaran
                    </p>
                    <div class="payment-options">

                        <label class="payment-option selected" onclick="selectPayment(this, 'qris')">
                            <input type="radio" name="payment" value="qris" checked>
                            <div class="payment-icon-box" style="background:#FFF3E0; color:#E65100;">QRIS</div>
                            <div>
                                <div class="payment-option-label">QRIS</div>
                                <div class="payment-option-sub">Scan & bayar</div>
                            </div>
                        </label>

                        <label class="payment-option" onclick="selectPayment(this, 'transfer')">
                            <input type="radio" name="payment" value="transfer">
                            <div class="payment-icon-box" style="background:#E3F2FD; color:#0D47A1;">TF</div>
                            <div>
                                <div class="payment-option-label">Transfer Bank</div>
                                <div class="payment-option-sub">BCA / BNI / BRI</div>
                            </div>
                        </label>

                        <label class="payment-option" onclick="selectPayment(this, 'va')">
                            <input type="radio" name="payment" value="va">
                            <div class="payment-icon-box" style="background:#E8F5E9; color:#1B5E20;">VA</div>
                            <div>
                                <div class="payment-option-label">Virtual Account</div>
                                <div class="payment-option-sub">Auto konfirmasi</div>
                            </div>
                        </label>

                        <label class="payment-option" onclick="selectPayment(this, 'cod')">
                            <input type="radio" name="payment" value="cod">
                            <div class="payment-icon-box" style="background:#FCE4EC; color:#880E4F;">COD</div>
                            <div>
                                <div class="payment-option-label">Bayar di Tempat</div>
                                <div class="payment-option-sub">Cash on Delivery</div>
                            </div>
                        </label>

                        <label class="payment-option" onclick="selectPayment(this, 'ewallet')">
                            <input type="radio" name="payment" value="ewallet">
                            <div class="payment-icon-box" style="background:#F3E5F5; color:#4A148C;">EW</div>
                            <div>
                                <div class="payment-option-label">E-Wallet</div>
                                <div class="payment-option-sub">GoPay / OVO / Dana</div>
                            </div>
                        </label>

                        <label class="payment-option" onclick="selectPayment(this, 'paylater')">
                            <input type="radio" name="payment" value="paylater">
                            <div class="payment-icon-box" style="background:#FFF8E1; color:#F57F17;">PL</div>
                            <div>
                                <div class="payment-option-label">Pay Later</div>
                                <div class="payment-option-sub">Kredivo / Akulaku</div>
                            </div>
                        </label>

                    </div>
                </div>

                {{-- ── 3. WAKTU PENGIRIMAN ──────────────────────────── --}}
                <div id="section-pengiriman">
                    <p class="panel-section-title">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--pk)"
                            stroke-width="2.5">
                            <path d="M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h11a2 2 0 012 2v3M13 17h8l-3-6H13V7" />
                            <circle cx="7.5" cy="18.5" r="1.5" />
                            <circle cx="17.5" cy="18.5" r="1.5" />
                        </svg>
                        Waktu Pengiriman
                    </p>
                    <div class="shipping-options">

                        <label class="shipping-option" onclick="selectShipping(this, 'fast', 25000)">
                            <input type="radio" name="shipping" value="fast">
                            <div class="shipping-icon" style="background:#FFF3E0;">⚡</div>
                            <div class="ship-info">
                                <div class="ship-name">Fast Delivery</div>
                                <div class="ship-duration">Estimasi 1–2 hari kerja</div>
                                <span class="ship-badge" style="background:#FFF3E0; color:#E65100;">Tercepat</span>
                            </div>
                            <div>
                                <div class="ship-price">Rp 25.000</div>
                            </div>
                        </label>

                        <label id="shipping-option-default" class="shipping-option selected"
                            onclick="selectShipping(this, 'medium', 15000)">
                            <input type="radio" name="shipping" value="medium" checked>
                            <div class="shipping-icon" style="background:#E8F5E9;">🚚</div>
                            <div class="ship-info">
                                <div class="ship-name">Medium Delivery</div>
                                <div class="ship-duration">Estimasi 3–5 hari kerja</div>
                                <span class="ship-badge" style="background:#E8F5E9; color:#2E7D32;">Populer</span>
                            </div>
                            <div>
                                <div class="ship-price">Rp 15.000</div>
                            </div>
                        </label>

                        <label class="shipping-option" onclick="selectShipping(this, 'slow', 8000)">
                            <input type="radio" name="shipping" value="slow">
                            <div class="shipping-icon" style="background:#E3F2FD;">📦</div>
                            <div class="ship-info">
                                <div class="ship-name">Slow Delivery</div>
                                <div class="ship-duration">Estimasi 5–7 hari kerja</div>
                                <span class="ship-badge" style="background:#E3F2FD; color:#0D47A1;">Hemat</span>
                            </div>
                            <div>
                                <div class="ship-price">Rp 8.000</div>
                            </div>
                        </label>

                    </div>
                </div>

            </div>{{-- end panel-body --}}

            <div class="panel-footer">
                <button class="btn-save-detail" onclick="saveDetailPesanan()">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <path d="M20 6L9 17l-5-5" />
                    </svg>
                    Simpan Detail Pesanan
                </button>
            </div>
        </div>
    </form>

     <x-footer/>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('storage/js/payment.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initCart(@json($products));
            // shipping-option-default
            updateSummary();
        });
    </script>
    <script src="{{ asset('storage/js/functionBackend.js') }}"></script>
    {{-- <script src="{{ asset('storage/js/payment.js') }}"></script> --}}
    {{-- <script src="{{ asset('storage/js/functionBackend.js') }}"></script> --}}

    {{-- @endpush --}}
</body>

</html>
