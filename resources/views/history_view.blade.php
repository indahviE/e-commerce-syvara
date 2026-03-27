{{-- ============================================================
   resources/views/history_view.blade.php
   ============================================================ --}}
{{-- @extends('layouts.app') --}}

{{-- @section('title', 'History Pembayaran — Syvara') --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Checkout - Syvara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link rel="stylesheet" href="{{ asset('storage/css/payment.css') }}"> --}}
    {{-- @push('styles') --}}
    <link rel="stylesheet" href="{{ asset('storage/css/history.css') }}">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{-- @endpush --}}

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
    <x-navbar/>
    {{-- @section('content') --}}
    <div class="history-page">
        <div class="history-wrap">

            {{-- ── Hero ───────────────────────────────────────────────── --}}
            {{-- <div class="history-hero">
                <p>Semua transaksi anda tercatat disini.</p>
            </div> --}}
            
            <h1 class="text-lg font-bold mb-4">History Pembayaran</h1>

            {{-- ── Filter Tabs ────────────────────────────────────────── --}}
            @php
                $activeStatus = request('status', '');
                $tabs = [
                    '' => 'Semua',
                    'Diproses' => 'Diproses',
                    'Dikemas' => 'Dikemas',
                    'Dikirim' => 'Dikirim',
                    'Diterima' => 'Diterima',
                    'Dibatalkan' => 'Dibatalkan',
                ];
            @endphp

            <div class="filter-row">
                @foreach ($tabs as $val => $label)
                    <a href="{{ request()->fullUrlWithQuery(['status' => $val]) }}"
                        class="filter-tab {{ $activeStatus === $val ? 'active' : '' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            {{-- ── Order List ─────────────────────────────────────────── --}}
            @if ($orders->isEmpty())
                <div class="empty-state">
                    <span class="empty-icon">🛍️</span>
                    <h3>Belum ada pesanan</h3>
                    <p>Kamu belum melakukan transaksi apapun.</p>
                </div>
            @else
                @foreach ($orders as $order)
                    @php
                        $statusMap = [
                            'Diterima' => ['label' => 'Selesai', 'class' => 'status-selesai'],
                            'Dikemas' => ['label' => 'Sedang Dikemas', 'class' => 'status-diantar'],
                            'Dikirim' => ['label' => 'Sedang Dikirim', 'class' => 'status-dikirim'],
                            'Diproses' => ['label' => 'Menunggu Pengecekan', 'class' => 'status-menunggu'],
                            'Dibatalkan' => ['label' => 'Dibatalkan', 'class' => 'status-dibatalkan'],
                        ];
                        $st = $statusMap[$order->status_order] ?? [
                            'label' => ucfirst($order->status_order),
                            'class' => 'status-menunggu',
                        ];
                    @endphp

                    <div class="order-card" data-status="{{ $order->status_order }}">

                        {{-- Head --}}
                        <div class="order-head">
                            <div class="order-head-left">
                                <span class="order-id">#{{ $loop->iteration }}</span>
                                <span class="order-date">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" />
                                        <line x1="16" y1="2" x2="16" y2="6" />
                                        <line x1="8" y1="2" x2="8" y2="6" />
                                        <line x1="3" y1="10" x2="21" y2="10" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($order->created_at)->locale('id')->isoFormat('D MMM YYYY, HH:mm') }}
                                </span>
                            </div>
                            <span class="status-badge {{ $st['class'] }}">
                                <span class="status-dot"></span>
                                {{ $st['label'] }}
                            </span>
                        </div>

                        {{-- Body Columns --}}
                        <div class="order-body">

                            <div class="order-col">
                                <span class="col-label">Penerima</span>
                                <span class="col-value">{{ $order->nama_penerima ?? '—' }}</span>
                                <span class="col-value muted">{{ $order->no_telp ?? '' }}</span>
                            </div>

                            <div class="order-col">
                                <span class="col-label">Alamat</span>
                                <span class="col-value muted">
                                    {{ implode(', ', array_filter([$order->kecamatan, $order->kabupaten, $order->provinsi])) ?: '—' }}
                                </span>
                            </div>

                            <div class="order-col">
                                <span class="col-label">Total Harga</span>
                                <span class="col-value price">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </span>
                                <span class="col-value muted">{{ ucfirst($order->payment_method ?? '—') }}</span>
                            </div>

                            <div class="order-col-action">
                                <button class="btn-detail" onclick="openDrawer({{ $order->id }})">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <circle cx="11" cy="11" r="8" />
                                        <path d="M21 21l-4.35-4.35" />
                                    </svg>
                                    Detail
                                </button>
                            </div>

                        </div>
                    </div>
                @endforeach

                {{-- Pagination --}}
                <div style="margin-top: 24px;">
                    {{ $orders->links() }}
                </div>
            @endif

        </div>
    </div>

    {{-- ── DRAWER OVERLAY ──────────────────────────────────────── --}}
    <div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>

    {{-- ── DRAWER PANEL ────────────────────────────────────────── --}}
    <div class="drawer-panel" id="drawerPanel">

        <div class="drawer-head">
            <h3>
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#F0157A"
                    stroke-width="2.5">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                    <line x1="16" y1="13" x2="8" y2="13" />
                    <line x1="16" y1="17" x2="8" y2="17" />
                </svg>
                Detail Pesanan
            </h3>
            <button class="drawer-close" onclick="closeDrawer()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M18 6L6 18M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="drawer-body" id="drawerBody">
            {{-- diisi via JS --}}
            <div style="text-align:center; padding: 48px 0; color: #9CA3AF;">
                <div style="font-size:2rem; margin-bottom:10px;">⏳</div>
                Memuat detail...
            </div>
        </div>

    </div>

    {{-- ── DATA JSON (server-side, no extra request needed) ──────── --}}
    {{-- Semua data order di-encode sekali, drawer baca dari sini --}}
    <script>
        const ordersData = @json($orders->keyBy('id'));
    </script>

    {{-- @push('scripts') --}}
    <script>
        // ── Open / Close ──────────────────────────────────────────────
        function openDrawer(orderId) {
            document.getElementById('drawerOverlay').classList.add('open');
            document.getElementById('drawerPanel').classList.add('open');
            document.body.style.overflow = 'hidden';
            renderDrawer(orderId);
        }

        function closeDrawer() {
            document.getElementById('drawerOverlay').classList.remove('open');
            document.getElementById('drawerPanel').classList.remove('open');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeDrawer();
        });

        // ── Render ────────────────────────────────────────────────────
        function renderDrawer(orderId) {
            const o = ordersData[orderId];
            if (!o) return;

            const fmt = n => 'Rp ' + parseInt(n || 0).toLocaleString('id-ID');

            const statusLabel = {
                Diterima: 'Selesai',
                Dikirim: 'Sedang Dikirim',
                Dikemas: 'Sedang Dikemas',
                Diproses: 'Sedang Diproses',
                Dibatalkan: 'Dibatalkan',
            };

            const statusClass = {
                Diterima: 'status-selesai',
                Dikirim: 'status-dikirim',
                Dikemas : 'status-diantar',
                Diproses: 'status-menunggu',
                Dibatalkan: 'status-dibatalkan',
            };

            // ── Products
            const details = o.order_details || [];
            const productsHtml = details.length ?
                details.map(d => {
                    const prod = d.product || {};
                    const nama = prod.nama || prod.name || '—';
                    const harga = prod.harga || prod.price || 0;
                    const qty = d.qty || d.jumlah || 1;
                    const img = prod.image ?
                        `/storage/${prod.image}` :
                        null;

                    return `
                <div class="d-product-row">
                    ${img
                        ? `<img src="${img}" alt="${nama}" class="d-product-img">`
                        : `<div class="d-product-img-ph">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <rect x="3" y="3" width="18" height="18" rx="3"/>
                                        <circle cx="8.5" cy="8.5" r="1.5"/>
                                        <polyline points="21 15 16 10 5 21"/>
                                    </svg>
                               </div>`
                    }
                    <div>
                        <div class="d-product-name">${nama}</div>
                        <div class="d-product-meta">x${qty} &nbsp;·&nbsp; ${fmt(harga)} / pcs</div>
                    </div>
                    <div class="d-product-price">${fmt(harga * qty)}</div>
                </div>
            `;
                }).join('') :
                `<p style="font-size:.83rem; color:#9CA3AF; padding:10px 0;">Tidak ada data produk.</p>`;

            // ── Alamat
            const alamatParts = [o.kecamatan, o.kabupaten, o.provinsi, o.kode_pos].filter(Boolean);

            document.getElementById('drawerBody').innerHTML = `

        {{-- Status --}}
        <div>
            <p class="d-section-title">Status Pesanan</p>
            <span class="d-status-badge status-badge ${statusClass[o.status_order] || 'status-menunggu'}">
                <span class="status-dot"></span>
                ${statusLabel[o.status_order] || o.status_order}
            </span>
        </div>

        {{-- Info Order --}}
        <div>
            <p class="d-section-title">Informasi Order</p>
            <table class="kv-table">
                <tr><td>Tanggal</td>       <td>${formatDate(o.created_at)}</td></tr>
                <tr><td>Metode Bayar</td>  <td>${capitalize(o.payment_method || '—')}</td></tr>
                <tr><td>Pengiriman</td>    <td>${capitalize(o.shipping || '—')}</td></tr>
                ${o.voucher_id ? `<tr><td>Voucher</td><td>#${o.voucher.kode} - Discount : ${o.voucher.discount}%</td></tr>` : ''}
            </table>
        </div>

        {{-- Penerima --}}
        <div>
            <p class="d-section-title">Data Penerima</p>
            <table class="kv-table">
                <tr><td>Nama</td>      <td>${o.nama_penerima || '—'}</td></tr>
                <tr><td>No. Telp</td>  <td>${o.no_telp       || '—'}</td></tr>
                <tr><td>Alamat</td>    <td>${o.alamat        || '—'}</td></tr>
                <tr><td>Wilayah</td>   <td>${alamatParts.join(', ') || '—'}</td></tr>
                ${o.catatan_kurir ? `<tr><td>Catatan Kurir</td><td>${o.catatan_kurir}</td></tr>` : ''}
            </table>
        </div>

        {{-- Produk --}}
        <div>
            <p class="d-section-title">Produk Dipesan</p>
            ${productsHtml}
            <div class="d-total-row">
                <span>Total Pembayaran</span>
                <span>${fmt(o.total_price)}</span>
            </div>
        </div>
    `;
        }

        // ── Helpers ───────────────────────────────────────────────────
        function formatDate(str) {
            if (!str) return '—';
            const d = new Date(str);
            return d.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function capitalize(str) {
            if (!str) return '—';
            return str.charAt(0).toUpperCase() + str.slice(1).replace(/_/g, ' ');
        }
    </script>
    {{-- @endpush --}}

    {{-- @endsection --}}
 <x-footer/>