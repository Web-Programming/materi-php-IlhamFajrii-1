<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h2>Edit Produk</h2>

    <form action="/products/{{ $product->id }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Produk</label>

            <input type="text" name="name" class="form-control" value="{{ $product->name }}">
        </div>

        <div class="mb-3">
            <label>Harga</label>

            <input type="number" name="price" class="form-control" value="{{ $product->price }}">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>

            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </div>

        <button class="btn btn-primary">
            Update
        </button>

        <a href="/products" class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

</body>
</html>