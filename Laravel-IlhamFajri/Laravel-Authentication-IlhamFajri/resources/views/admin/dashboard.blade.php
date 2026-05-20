@extends('layouts.admin')

@section('title', 'Dashboard - Admin Inventaris')

@section('content')
<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <p class="page-subtitle">Selamat datang kembali, {{ $userName }}! 👋</p>
</div>

<!-- Stats Cards -->
<div class="stats-container">
    <!-- Total Barang -->
    <div class="stat-card blue">
        <div class="stat-icon">
            <i class="bi bi-boxes"></i>
        </div>
        <div class="stat-label">Total Barang</div>
        <div class="stat-value">{{ $totalBarang }}</div>
        <div class="stat-change">Semua produk inventaris</div>
    </div>

    <!-- Barang Tersedia -->
    <div class="stat-card green">
        <div class="stat-icon">
            <i class="bi bi-check-circle"></i>
        </div>
        <div class="stat-label">Barang Tersedia</div>
        <div class="stat-value">{{ $barangTersedia }}</div>
        <div class="stat-change">Siap untuk dijual</div>
    </div>

    <!-- Barang Habis -->
    <div class="stat-card red">
        <div class="stat-icon">
            <i class="bi bi-exclamation-circle"></i>
        </div>
        <div class="stat-label">Barang Habis</div>
        <div class="stat-value">{{ $barangHabis }}</div>
        <div class="stat-change down">Perlu restocking</div>
    </div>

    <!-- Total Nilai Stok -->
    <div class="stat-card orange">
        <div class="stat-icon">
            <i class="bi bi-cash-coin"></i>
        </div>
        <div class="stat-label">Total Nilai Stok</div>
        <div class="stat-value">Rp {{ number_format($totalNilaiStok, 0, ',', '.') }}</div>
        <div class="stat-change">Nilai inventaris</div>
    </div>
</div>

<!-- Additional Content -->
<div class="row mt-5">
    <div class="col-12">
        <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
            <h5 class="mb-4" style="font-weight: 700; color: #1f2937;">Produk Terbaru</h5>
            @if($produkTerbaru->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr style="background: #f9fafb;">
                                <th style="color: #6b7280; font-weight: 600;">Nama Produk</th>
                                <th style="color: #6b7280; font-weight: 600;">Satuan</th>
                                <th style="color: #6b7280; font-weight: 600;">Stok</th>
                                <th style="color: #6b7280; font-weight: 600;">Harga</th>
                                <th style="color: #6b7280; font-weight: 600;">Status</th>
                                <th style="color: #6b7280; font-weight: 600;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produkTerbaru as $produk)
                                <tr>
                                    <td style="font-weight: 500; color: #1f2937;">{{ $produk->name }}</td>
                                    <td>{{ $produk->unit }}</td>
                                    <td>
                                        <span style="background: #e0e7ff; color: #667eea; padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 600;">
                                            {{ $produk->stock }}
                                        </span>
                                    </td>
                                    <td style="font-weight: 600; color: #1f2937;">Rp {{ number_format($produk->price, 0, ',', '.') }}</td>
                                    <td>
                                        @if($produk->status == 'tersedia')
                                            <span style="background: #d1fae5; color: #059669; padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 600;">
                                                ✓ Tersedia
                                            </span>
                                        @else
                                            <span style="background: #fee2e2; color: #dc2626; padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 600;">
                                                ✗ Habis
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/products/{{ $produk->id }}/edit" style="color: #667eea; text-decoration: none; font-size: 13px; font-weight: 600;">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p style="color: #9ca3af; text-align: center; padding: 30px 0;">
                    <i class="bi bi-inbox" style="font-size: 40px; opacity: 0.5;"></i><br>
                    Belum ada produk. <a href="/products/create" style="color: #667eea;">Tambah produk</a>
                </p>
            @endif
        </div>
    </div>
</div>
@endsection
