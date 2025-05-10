<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Inventory Barang | Data Alat Tulis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
</head>
<body>
<div class="container mt-4">
    <header class="mb-4">
        <h2>Daftar Barang</h2>
        <p>Data semua alat tulis yang tersedia di inventory</p>
    </header>

    <nav class="mb-3">
        <a href="index.php" class="btn btn-secondary">Kembali ke Menu</a>
        <a href="tabel_barang.php" class="btn btn-primary">Data Barang</a>
    </nav>

    <table id="tabel_barang" class="table table-striped table-bordered" style="width:100%">
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
$sql = "SELECT * FROM barang";
$query = mysqli_query($db, $sql);
?>

<table class="table table-striped">
    <tbody>
        <?php while($row = mysqli_fetch_assoc($query)) : ?>
        <tr>
            <td><?= $row['kode'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['jumlah'] ?></td>
            <td><?= $row['satuan'] ?></td>
            <td><?= $row['harga_beli'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <a href="edit.php?kode=<?= $row['kode'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="hapus.php?kode=<?= $row['kode'] ?>" class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</div>

<!-- Script DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
<script>
    new DataTable('#tabelBarang');
</script>
</body>
</html>
