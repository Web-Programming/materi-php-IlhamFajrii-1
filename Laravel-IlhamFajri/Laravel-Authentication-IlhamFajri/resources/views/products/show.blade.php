@extends('layout')
@section('title', 'Detail Produk')
@section('content')
<div class="main-card card-animate mx-auto" style="max-width: 650px;">
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h3 class="fw-bold">{{ $product->name }}</h3>
            <span class="badge bg-dark rounded-pill px-3 py-2">{{ $product->unit }}</span>
        </div>
        <a href="/products" class="btn btn-outline-dark btn-modern">Kembali</a>
    </div>

    <div class="p-4 rounded-4 bg-light">
        <h5 class="text-secondary">Harga Produk</h5>
        <h2 class="fw-bold text-success mb-4">Rp {{ number_format($product->price) }}</h2>

        <h5 class="text-secondary">Deskripsi</h5>
        <p class="mb-0">{{ $product->description ?? 'Tidak ada deskripsi produk.' }}</p>
    </div>
</div>
@endsection
