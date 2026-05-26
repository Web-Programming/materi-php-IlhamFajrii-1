@extends('layout')

@section('title', 'CRUD-Produk-Ilham Fajri')

@section('content')
<div class="main-card">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-start mb-4 gap-3">
        <div>
            <h2 class="fw-bold mb-1">Manajemen Produk</h2>
            <p class="text-secondary mb-0">Dashboard produk
                @if($search)
                    <span style="background: #dbeafe; color: #1e40af; padding: 2px 8px; border-radius: 4px; font-size: 12px; margin-left: 8px; font-weight: 600;">
                        Cari: "{{ $search }}" 
                        <a href="/products" style="color: #1e40af; text-decoration: none; margin-left: 4px;">✕</a>
                    </span>
                @endif
            </p>
        </div>

        <div class="d-flex flex-column gap-2 w-100 w-md-auto">
            <form method="GET" action="/products" class="d-flex gap-2" style="align-items: center;">
                <input type="text" name="search" placeholder="Cari produk..." value="{{ $search ?? '' }}" class="form-control" style="max-width: 250px; border-radius: 14px; padding: 10px 15px;">
                <button type="submit" class="btn btn-secondary btn-modern" style="border-radius: 14px; padding: 10px 15px; background-color: #667eea; border: none; color: white; display: flex; align-items: center; justify-content: center; width: 44px; height: 44px;" title="Cari">
                    <i class="bi bi-search" style="font-size: 18px;"></i>
                </button>
                @if($search)
                    <a href="/products" class="btn btn-light btn-modern" style="border-radius: 14px; padding: 10px 15px;">
                        <i class="bi bi-x"></i>
                    </a>
                @endif
            </form>

            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-modern btn-dashboard">
                    <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10l9-7 9 7v11a1 1 0 01-1 1h-5v-6H9v6H4a1 1 0 01-1-1V10z"/>
                    </svg>
                    Dashboard
                </a>
                <a href="/products/create" class="btn btn-dark btn-modern">
                    + Tambah Produk
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success animated-alert border-0 rounded-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Satuan</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Nilai Stok</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="card-animate">
                    <td>
                        <div class="fw-semibold">{{ $product->name }}</div>
                        <small class="text-secondary">{{ $product->description }}</small>
                    </td>
                    <td>
                        <span class="badge bg-dark-subtle text-dark px-3 py-2 rounded-pill">
                            {{ $product->unit }}
                        </span>
                    </td>
                    <td class="fw-semibold">{{ $product->stock ?? 0 }}</td>
                    <td class="fw-semibold text-success">Rp {{ number_format($product->price) }}</td>
                    <td>
                        @if($product->status == 'tersedia')
                            <span class="badge bg-success">✓ Tersedia</span>
                        @else
                            <span class="badge bg-danger">✗ Habis</span>
                        @endif
                    </td>
                    <td class="fw-semibold text-info">Rp {{ number_format(($product->stock ?? 0) * $product->price) }}</td>
                    <td class="text-center">
                        <div class="d-flex gap-2 justify-content-center flex-wrap">
                            <a href="/products/{{ $product->id }}" class="btn btn-info btn-sm btn-modern text-white">Detail</a>
                            <a href="/products/{{ $product->id }}/edit" class="btn btn-warning btn-sm btn-modern">Edit</a>
                            <form action="/products/{{ $product->id }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm btn-modern" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-secondary">Belum ada produk ditambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
