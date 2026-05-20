<!DOCTYPE html>
<html>
<head>
    <title>CRUD Produk Toko Aliong</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h2 class="mb-4">CRUD Produk Toko Aliong</h2>

    <a href="/products/create" class="btn btn-primary mb-3">
        Tambah Produk
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th width="220">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach($products as $product)

                <tr>
                    <td>{{ $product->name }}</td>

                    <td>Rp {{ number_format($product->price) }}</td>

                    <td>

                        <a href="/products/{{ $product->id }}" class="btn btn-info btn-sm">
                            Detail
                        </a>

                        <a href="/products/{{ $product->id }}/edit" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="/products/{{ $product->id }}" method="POST" class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">
                                Hapus
                            </button>

                        </form>

                    </td>
                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

</body>
</html>