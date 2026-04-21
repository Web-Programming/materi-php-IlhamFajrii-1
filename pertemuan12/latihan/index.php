<!DOCTYPE html>
<html lang="id">
<head>
    <title>Pencatatan Keuangan Sederhana</title>
</head>
<body>
    <h2>Form Tambah Catatan Keuangan</h2>
    <form action="proses_keuangan.php" method="POST">
        <label for="tanggal">Tanggal:</label><br>
        <input type="date" id="tanggal" name="tanggal" required><br><br>

        <label for="jenis">Jenis Transaksi:</label><br>
        <select id="jenis" name="jenis" required>
            <option value="Pemasukan">Pemasukan</option>
            <option value="Pengeluaran">Pengeluaran</option>
        </select><br><br>

        <label for="nominal">Nominal (Rp):</label><br>
        <input type="number" id="nominal" name="nominal" min="1" required><br><br>

        <label for="keterangan">Keterangan:</label><br>
        <input type="text" id="keterangan" name="keterangan" required><br><br>

        <input type="submit" name="simpan" value="Simpan Data">
    </form>
</body>
</html>