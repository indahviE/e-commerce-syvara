{{-- ============================================================
   resources/views/admin/orders/index.blade.php
   ============================================================ --}}
{{-- @extends('layouts.admin') --}}

{{-- @section('title', 'Kelola Pesanan — Syvara Admin') --}}

{{-- @push('styles') --}}
{{-- @endpush --}}

{{-- @section('content') --}}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Member - Syvara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('storage/css/payment.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/css/admin-orders.css') }}">

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

@php
    $statuses = [
        ''           => ['label' => 'Semua',      'icon_color' => '#64748B', 'bg' => '#F1F5F9'],
        'Diproses'   => ['label' => 'Diproses',   'icon_color' => '#7C3AED', 'bg' => '#F5F3FF'],
        'Dikemas'    => ['label' => 'Dikemas',    'icon_color' => '#D97706', 'bg' => '#FFFBEB'],
        'Dikirim'    => ['label' => 'Dikirim',    'icon_color' => '#2563EB', 'bg' => '#EFF6FF'],
        'Diterima'   => ['label' => 'Diterima',   'icon_color' => '#059669', 'bg' => '#ECFDF5'],
        'Dibatalkan' => ['label' => 'Dibatalkan', 'icon_color' => '#EF4444', 'bg' => '#FEF2F2'],
    ];

    $counts = [
        ''           => $allOrders->count(),
        'Diproses'   => $allOrders->where('status_order', 'Diproses')->count(),
        'Dikemas'    => $allOrders->where('status_order', 'Dikemas')->count(),
        'Dikirim'    => $allOrders->where('status_order', 'Dikirim')->count(),
        'Diterima'   => $allOrders->where('status_order', 'Diterima')->count(),
        'Dibatalkan' => $allOrders->where('status_order', 'Dibatalkan')->count(),
    ];

    $activeStatus = request('status', '');
@endphp

<div class="admin-page">
<div class="admin-wrap">

    {{-- ── Header ─────────────────────────────────────────── --}}
    <div class="page-header">
        <div class="page-header-left">
            <h1>Kelola Pesanan</h1>
            <p>Pantau dan atur semua transaksi pelanggan</p>
        </div>
    </div>

    {{-- ── Stat Cards ─────────────────────────────────────── --}}
    <div class="stat-grid">
        @foreach($statuses as $val => $st)
        <a href="{{ request()->fullUrlWithQuery(['status' => $val, 'page' => 1]) }}"
           class="stat-card {{ $activeStatus === $val ? 'active' : '' }}">
            <div class="stat-icon" style="background: {{ $st['bg'] }};">
                @if($val === '')
                    <svg viewBox="0 0 24 24" fill="none" stroke="{{ $st['icon_color'] }}" stroke-width="2">
                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                @elseif($val === 'diproses')
                    <svg viewBox="0 0 24 24" fill="none" stroke="{{ $st['icon_color'] }}" stroke-width="2">
                        <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
                    </svg>
                @elseif($val === 'dikemas')
                    <svg viewBox="0 0 24 24" fill="none" stroke="{{ $st['icon_color'] }}" stroke-width="2">
                        <path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/>
                    </svg>
                @elseif($val === 'dikirim')
                    <svg viewBox="0 0 24 24" fill="none" stroke="{{ $st['icon_color'] }}" stroke-width="2">
                        <path d="M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h11a2 2 0 012 2v3M13 17h8l-3-6H13V7"/><circle cx="7.5" cy="18.5" r="1.5"/><circle cx="17.5" cy="18.5" r="1.5"/>
                    </svg>
                @elseif($val === 'diterima')
                    <svg viewBox="0 0 24 24" fill="none" stroke="{{ $st['icon_color'] }}" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                @else
                    <svg viewBox="0 0 24 24" fill="none" stroke="{{ $st['icon_color'] }}" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
                    </svg>
                @endif
            </div>
            <div>
                <div class="stat-num">{{ $counts[$val] }}</div>
                <div class="stat-label">{{ $st['label'] }}</div>
            </div>
        </a>
        @endforeach
    </div>

    {{-- ── Flash ───────────────────────────────────────────── --}}
    @if(session('success'))
        <div style="background:#ECFDF5; color:#065F46; border:1px solid #A7F3D0; border-radius:10px; padding:10px 16px; font-size:.83rem; font-weight:600; margin-bottom:16px; display:flex; align-items:center; gap:8px;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- ── Filter Bar ──────────────────────────────────────── --}}
    <form method="GET" action="{{ request()->url() }}" class="filter-bar">

        <div class="filter-group" style="max-width: 240px;">
            <label>Nama Pemesan</label>
            <input
                type="text"
                name="nama"
                class="filter-input"
                placeholder="Cari nama pemesan..."
                value="{{ request('nama') }}">
        </div>

        <div class="filter-group" style="max-width: 180px;">
            <label>Status</label>
            <select name="status" class="filter-select">
                @foreach($statuses as $val => $st)
                    <option value="{{ $val }}" {{ request('status') === $val ? 'selected' : '' }}>
                        {{ $st['label'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-group" style="max-width: 180px;">
            <label>Dari Tanggal</label>
            <input
                type="date"
                name="dari"
                class="filter-input"
                value="{{ request('dari') }}">
        </div>

        <div class="filter-group" style="max-width: 180px;">
            <label>Sampai Tanggal</label>
            <input
                type="date"
                name="sampai"
                class="filter-input"
                value="{{ request('sampai') }}">
        </div>

        <button type="submit" class="ms-auto btn-filter">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
            </svg>
            Cari
        </button>

        <a href="{{ request()->url() }}" class="btn-reset">Reset</a>

    </form>


    {{-- ── Table ───────────────────────────────────────────── --}}
    <div class="table-card">
        <div class="table-card-head">
            <h2>Daftar Pesanan</h2>
            <span class="result-count">{{ $orders->total() }} pesanan ditemukan</span>
        </div>

        <div style="overflow-x: auto;">
        <table class="orders-table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Pemesan</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Pembayaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                @php
                    $statusClass = [
                        'diproses'   => 'badge-diproses',
                        'dikemas'    => 'badge-dikemas',
                        'dikirim'    => 'badge-dikirim',
                        'diterima'   => 'badge-diterima',
                        'dibatalkan' => 'badge-dibatalkan',
                    ][$order->status_order] ?? 'badge-semua';

                    $statusSelectClass = [
                        'diproses'   => 's-diproses',
                        'dikemas'    => 's-dikemas',
                        'dikirim'    => 's-dikirim',
                        'diterima'   => 's-diterima',
                        'dibatalkan' => 's-dibatalkan',
                    ][$order->status_order] ?? '';
                @endphp
                <tr>
                    {{-- ID --}}
                    <td class="td-id">#{{ $order->id }}</td>

                    {{-- Pemesan --}}
                    <td>
                        <div class="td-name">{{ $order->nama_penerima ?? ($order->user->name ?? '—') }}</div>
                        <div class="td-muted">{{ $order->no_telp ?? '' }}</div>
                    </td>

                    {{-- Tanggal --}}
                    <td class="td-muted">
                        {{ \Carbon\Carbon::parse($order->created_at)->locale('id')->isoFormat('D MMM YYYY') }}<br>
                        <span style="font-size:.75rem;">{{ \Carbon\Carbon::parse($order->created_at)->format('H:i') }}</span>
                    </td>

                    {{-- Total --}}
                    <td class="td-price">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </td>

                    {{-- Pembayaran --}}
                    <td class="td-muted">{{ ucfirst($order->payment_method ?? '—') }}</td>

                    {{-- Status (inline form) --}}
                    <td>
                        <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select
                                name="status_order"
                                class="status-select {{ $statusSelectClass }}"
                                onchange="this.form.submit()"
                                title="Ubah status">
                                @foreach($statuses as $val => $st)
                                    @if($val !== '')
                                        <option value="{{ $val }}" {{ $order->status_order === $val ? 'selected' : '' }}>
                                            {{ $st['label'] }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </form>
                    </td>

                    {{-- Aksi --}}
                    <td>
                        <div class="td-actions">
                            <button
                                class="btn-icon"
                                onclick="openDrawer({{ $order->id }})"
                                title="Lihat detail">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="empty-row">
                    <td colspan="7">
                        <div style="font-size:2rem; margin-bottom:8px;">📋</div>
                        Tidak ada pesanan ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>

        {{-- Pagination --}}
        <div class="table-foot">
            <span>
                Menampilkan {{ $orders->firstItem() }}–{{ $orders->lastItem() }}
                dari {{ $orders->total() }} pesanan
            </span>
            {{ $orders->withQueryString()->links() }}
        </div>
    </div>

</div>
</div>

{{-- ── DRAWER OVERLAY ──────────────────────────────────────── --}}
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>

{{-- ── DRAWER PANEL ────────────────────────────────────────── --}}
<div class="drawer-panel" id="drawerPanel">

    <div class="drawer-head">
        <h3 id="drawerTitle">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#F0157A" stroke-width="2.5">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
            </svg>
            Detail Pesanan
        </h3>
        <button class="drawer-close" onclick="closeDrawer()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M18 6L6 18M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <div class="drawer-body" id="drawerBody">
        <div style="text-align:center; padding:48px 0; color:#9CA3AF;">
            <div style="font-size:2rem; margin-bottom:10px;">⏳</div>
            Memuat data...
        </div>
    </div>

    {{-- Status changer di footer drawer --}}
    <div class="drawer-foot" id="drawerFoot" style="display:none;">
        <div class="drawer-foot-label">Ubah Status Pesanan</div>
        <form class="drawer-status-form"
              id="drawerStatusForm"
              method="POST">
            @csrf
            @method('PATCH')
            <select name="status_order" class="drawer-status-select" id="drawerStatusSelect">
                @foreach($statuses as $val => $st)
                    @if($val !== '')
                        <option value="{{ $val }}">{{ $st['label'] }}</option>
                    @endif
                @endforeach
            </select>
            <button type="submit" class="btn-save-status">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="14" height="14">
                    <path d="M20 6L9 17l-5-5"/>
                </svg>
                Simpan
            </button>
        </form>
    </div>

</div>

{{-- ── Data JSON ───────────────────────────────────────────── --}}
<script>
    const ordersData = @json($orders->keyBy('id'));
    const statusRoute = "{{ route('admin.orders.status', ':id') }}";
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
        diproses: 'Diproses', dikemas: 'Dikemas',
        dikirim: 'Dikirim', diterima: 'Diterima', dibatalkan: 'Dibatalkan'
    };

    const statusBadgeClass = {
        diproses: 'badge-diproses', dikemas: 'badge-dikemas',
        dikirim: 'badge-dikirim', diterima: 'badge-diterima', dibatalkan: 'badge-dibatalkan'
    };

    // Update judul drawer
    document.getElementById('drawerTitle').innerHTML = `
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#F0157A" stroke-width="2.5">
            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
            <polyline points="14 2 14 8 20 8"/>
        </svg>
        Detail Pemesanan #${o.id}
    `;

    // Update form action status di footer
    const form = document.getElementById('drawerStatusForm');
    form.action = statusRoute.replace(':id', o.id);
    document.getElementById('drawerStatusSelect').value = o.status_order;
    document.getElementById('drawerFoot').style.display = 'block';

    // Products
    const details = o.order_details || [];
    const prodsHtml = details.length
        ? details.map(d => {
            const p    = d.product || {};
            const nama = p.nama || p.name || '—';
            const harga= p.harga || p.price || 0;
            const qty  = d.qty || d.jumlah || 1;
            const img  = p.image ? `/storage/${p.image}` : null;

            return `
                <div class="d-prod-row">
                    ${img
                        ? `<img src="${img}" alt="${nama}" class="d-prod-img">`
                        : `<div class="d-prod-img-ph"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></div>`
                    }
                    <div>
                        <div class="d-prod-name">${nama}</div>
                        <div class="d-prod-meta">x${qty} &nbsp;·&nbsp; ${fmt(harga)} / pcs</div>
                    </div>
                    <div class="d-prod-price">${fmt(harga * qty)}</div>
                </div>`;
        }).join('')
        : `<p style="font-size:.8rem; color:#9CA3AF; padding:10px 0;">Tidak ada data produk.</p>`;

    const alamat = [o.kecamatan, o.kabupaten, o.provinsi, o.kode_pos].filter(Boolean).join(', ');

    document.getElementById('drawerBody').innerHTML = `
        <div class="d-section">
            <p class="d-section-title">Status</p>
            <span class="badge ${statusBadgeClass[o.status_order] || 'badge-semua'}">
                <span class="badge-dot"></span>
                ${statusLabel[o.status_order] || o.status_order}
            </span>
        </div>

        <div class="d-section">
            <p class="d-section-title">Info Pesanan</p>
            <table class="kv-table">
              
                <tr><td>Tanggal</td>       <td>${fmtDate(o.created_at)}</td></tr>
                <tr><td>Metode Bayar</td>  <td>${cap(o.payment_method)}</td></tr>
                <tr><td>Pengiriman</td>    <td>${cap(o.shipping)}</td></tr>
                ${o.voucher_id ? `<tr><td>Voucher</td><td>#${o.voucher.kode} - Diskon : ${o.voucher.discount}%</td></tr>` : ''}
            </table>
        </div>

        <div class="d-section">
            <p class="d-section-title">Data Penerima</p>
            <table class="kv-table">
                <tr><td>Nama</td>    <td>${o.nama_penerima || '—'}</td></tr>
                <tr><td>No. Telp</td><td>${o.no_telp       || '—'}</td></tr>
                <tr><td>Alamat</td>  <td>${o.alamat        || '—'}</td></tr>
                <tr><td>Wilayah</td> <td>${alamat           || '—'}</td></tr>
                ${o.catatan_kurir
                    ? `<tr><td>Catatan Kurir</td><td>${o.catatan_kurir}</td></tr>`
                    : ''}
            </table>
        </div>

        <div class="d-section">
            <p class="d-section-title">Produk Dipesan</p>
            ${prodsHtml}
            <div class="d-total-row">
                <span>Total Pembayaran</span>
                <span>${fmt(o.total_price)}</span>
            </div>
        </div>
    `;
}

function fmtDate(str) {
    if (!str) return '—';
    return new Date(str).toLocaleDateString('id-ID', {
        day: 'numeric', month: 'long', year: 'numeric',
        hour: '2-digit', minute: '2-digit'
    });
}

function cap(str) {
    if (!str) return '—';
    return str.charAt(0).toUpperCase() + str.slice(1).replace(/_/g, ' ');
}

// Warna status select otomatis berubah saat dropdown berubah di tabel
document.querySelectorAll('.status-select').forEach(sel => {
    sel.addEventListener('change', function () {
        this.className = 'status-select s-' + this.value;
    });
});
</script>
{{-- @endpush --}}

{{-- @endsection --}}

 <x-footer/>