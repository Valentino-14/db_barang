<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Inventory Barang | Data Alat Tulis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h3>Sistem Inventory Barang</h3>
    <a href="tambah.php" class="btn btn-success mb-3">+ Tambah Barang</a>
    <a href="kotak.php" class="btn btn-primary mb-3">Data Barang</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Harga Beli</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'config.php';
            $data = mysqli_query($db, "SELECT * FROM daftar_barang");
            while ($d = mysqli_fetch_array($data)) {
            ?>
            <tr>
                <td><?= htmlspecialchars($d['kode_barang']); ?></td>
                <td><?= htmlspecialchars($d['nama_barang']); ?></td>
                <td><?= $d['jumlah_tersedia']; ?></td>
                <td><?= htmlspecialchars($d['satuan']); ?></td>
                <td><?= number_format($d['harga_beli'], 0, ',', '.'); ?></td>
                <td>
                    <span class="badge <?= $d['jumlah_tersedia'] > 0 ? 'bg-success' : 'bg-danger' ?>">
                        <?= $d['jumlah_tersedia'] > 0 ? 'Available' : 'Out of Stock' ?>
                    </span>
                </td>
                <td>
                    <a href="edit.php?id=<?= $d['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus.php?id=<?= $d['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    <a href="pakai.php?id=<?= $d['id']; ?>" class="btn btn-secondary btn-sm">Pakai</a>
                    <a href="tambah_stok.php?id=<?= $d['id']; ?>" class="btn btn-info btn-sm">+ Stok</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>


