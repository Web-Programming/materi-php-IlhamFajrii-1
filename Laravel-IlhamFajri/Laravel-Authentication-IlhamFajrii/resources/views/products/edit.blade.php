@extends('layout')

@section('title', 'Edit Produk')

@section('content')

<div class="main-card card-animate mx-auto" style="max-width: 700px;">

    <h3 class="fw-bold mb-4">Edit Produk</h3>

    <form action="/products/{{ $product->id }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Produk</label>

            <input
                type="text"
                name="name"
                value="{{ $product->name }}"
                class="form-control"
                placeholder="Masukkan nama produk"
                required
            >
        </div>

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">Harga</label>

                <input
                    type="number"
                    name="price"
                    value="{{ $product->price }}"
                    class="form-control"
                    placeholder="Contoh: 15000"
                    required
                >

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">Satuan</label>

                <select name="unit" class="form-select" required>

                    <option value="">Pilih satuan</option>

                    <option value="Pcs" {{ $product->unit == 'Pcs' ? 'selected' : '' }}>
                        Pcs
                    </option>

                    <option value="Kilogram" {{ $product->unit == 'Kilogram' ? 'selected' : '' }}>
                        Kilogram
                    </option>

                    <option value="Liter" {{ $product->unit == 'Liter' ? 'selected' : '' }}>
                        Liter
                    </option>

                    <option value="Box" {{ $product->unit == 'Box' ? 'selected' : '' }}>
                        Box
                    </option>

                    <option value="Pack" {{ $product->unit == 'Pack' ? 'selected' : '' }}>
                        Pack
                    </option>

                </select>

            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">Stok</label>

                <input
                    type="number"
                    name="stock"
                    value="{{ $product->stock ?? 0 }}"
                    class="form-control"
                    placeholder="Contoh: 100"
                    required
                >

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">Status</label>

                <select name="status" class="form-select" required>

                    <option value="">Pilih status</option>

                    <option value="tersedia" {{ $product->status == 'tersedia' ? 'selected' : '' }}>
                        Tersedia
                    </option>

                    <option value="habis" {{ $product->status == 'habis' ? 'selected' : '' }}>
                        Habis
                    </option>

                </select>

            </div>

        </div>

        <div class="mb-4">

            <label class="form-label">Deskripsi</label>

            <textarea
                name="description"
                class="form-control"
                rows="4"
                placeholder="Deskripsi produk"
            >{{ $product->description }}</textarea>

        </div>

        <div class="d-flex gap-2">

            <button class="btn btn-dark btn-modern">
                Simpan Produk
            </button>

            <a href="/products" class="btn btn-outline-secondary btn-modern">
                Kembali
            </a>

        </div>

    </form>

</div>

@endsection