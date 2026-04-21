<?php
// --------------------------
// Contoh GET
// --------------------------
$keyword = trim($_GET['keyword'] ?? '');
$kategori = trim($_GET['kategori'] ?? 'Semua');
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Materi Dasar PHP Form - GET</title>
</head>
<body>
    <h2>1) Contoh Form GET</h2>
    <form method="GET" action="">
        <label for="keyword">Keyword pencarian</label>
        <input id="keyword" name="keyword" type="text" 
        value="<?= htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8') ?>" 
        placeholder="Contoh: laptop">

        <label for="kategori">Kategori</label>
        <select id="kategori" name="kategori">
            <option value="Semua" <?= $kategori === 'Semua' ? 'selected' : '' ?>>Semua</option>
            <option value="Elektronik" <?= $kategori === 'Elektronik' ? 'selected' : '' ?>>Elektronik</option>
            <option value="Pakaian" <?= $kategori === 'Pakaian' ? 'selected' : '' ?>>Pakaian</option>
            <option value="Makanan" <?= $kategori === 'Makanan' ? 'selected' : '' ?>>Makanan</option>
        </select>
        <button type="submit">Cari</button>
    </form>
    <?php if (isset($_GET['keyword']) || isset($_GET['kategori'])): ?>
        <div class="result">
            <strong>Hasil GET:</strong><br>
            Keyword: <?= htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8') ?><br>
            Kategori: <?= htmlspecialchars($kategori, ENT_QUOTES, 'UTF-8') ?>
            <hr/>
            Keyword 2: <?php echo $keyword; ?><br>
        </div>
    <?php endif; ?>
    <h2>2) <a href="index2.php">Contoh Form POST</a></h2>
</body>
</html>
