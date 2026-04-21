<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencatatan Keuangan Sederhana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h1 class="h3 mb-2">Form Tambah Catatan Keuangan</h1>
                            <p class="text-muted mb-0">Masukkan data transaksi pemasukan atau pengeluaran.</p>
                        </div>

                        <form action="proses_keuangan.php" method="POST">
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="jenis" class="form-label">Jenis Transaksi</label>
                                <select id="jenis" name="jenis" class="form-select" required>
                                    <option value="Pemasukan">Pemasukan</option>
                                    <option value="Pengeluaran">Pengeluaran</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="nominal" class="form-label">Nominal (Rp)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" id="nominal" name="nominal" class="form-control" min="1" placeholder="Contoh: 50000" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Contoh: Bayar listrik" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" name="simpan" class="btn btn-primary btn-lg">Simpan Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>