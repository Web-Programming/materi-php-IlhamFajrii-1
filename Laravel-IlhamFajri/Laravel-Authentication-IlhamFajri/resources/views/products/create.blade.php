@extends('layout')
@section('title', 'Tambah Produk')
@section('content')
<div class="main-card card-animate mx-auto" style="max-width: 700px;">
    <h3 class="fw-bold mb-4">Tambah Produk Baru</h3>

    <form action="/products" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="name" class="form-control" placeholder="Masukkan nama produk" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="price" class="form-control" placeholder="Contoh: 15000" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Satuan</label>
                <select name="unit" class="form-select" required>
                    <option value="">Pilih satuan</option>
                    <option>Pcs</option>
                    <option>Kilogram</option>
                    <option>Liter</option>
                    <option>Box</option>
                    <option>Pack</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stock" class="form-control" placeholder="Contoh: 100" value="0" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="">Pilih status</option>
                    <option value="tersedia">Tersedia</option>
                    <option value="habis">Habis</option>
                </select>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Deskripsi produk"></textarea>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-dark btn-modern">Simpan Produk</button>
            <a href="/products" class="btn btn-outline-secondary btn-modern">Kembali</a>
        </div>
    </form>
</div>
@endsection
