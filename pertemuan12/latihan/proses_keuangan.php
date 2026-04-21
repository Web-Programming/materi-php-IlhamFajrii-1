<?php
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$isSubmitted = isset($_POST['simpan']);
$tanggal = trim($_POST['tanggal'] ?? '');
$jenis = trim($_POST['jenis'] ?? '');
$nominal = (int) ($_POST['nominal'] ?? 0);
$keterangan = trim($_POST['keterangan'] ?? '');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencatatan Keuangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        <?php if ($isSubmitted): ?>
                            <div class="text-center mb-4">
                                <h1 class="h3 mb-2">Ringkasan Transaksi Tersimpan</h1>
                                <p class="text-muted mb-0">Data yang Anda kirim melalui form telah diterima.</p>
                            </div>

                            <div class="alert alert-success" role="alert">
                                Data transaksi berhasil diproses.
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered align-middle mb-4">
                                    <tbody>
                                        <tr>
                                            <th class="bg-light" style="width: 30%;">Tanggal</th>
                                            <td><?= e($tanggal) ?></td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Jenis</th>
                                            <td><?= e($jenis) ?></td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Nominal</th>
                                            <td>Rp <?= number_format($nominal, 0, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Keterangan</th>
                                            <td><?= e($keterangan) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex gap-2">
                                <a href="index.php" class="btn btn-primary">Kembali ke Form</a>
                            </div>
                        <?php else: ?>
                            <div class="text-center mb-4">
                                <h1 class="h3 mb-2">Akses Ditolak</h1>
                                <p class="text-muted mb-0">Halaman ini harus diakses melalui form input transaksi.</p>
                            </div>

                            <div class="alert alert-danger" role="alert">
                                Silakan isi form terlebih dahulu sebelum membuka halaman ini.
                            </div>

                            <a href="index.php" class="btn btn-outline-primary">Buka Form</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>