<!DOCTYPE html>
<html>
<head>
    <title>Detail Produk</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h2>Detail Produk</h2>

    <div class="card p-3">

        <h4>{{ $product->name }}</h4>

        <h5 class="text-primary">
            Rp {{ number_format($product->price) }}
        </h5>

        <p>
            {{ $product->description }}
        </p>

    </div>

    <a href="/products" class="btn btn-secondary mt-3">
        Kembali
    </a>

</div>

</body>
</html>