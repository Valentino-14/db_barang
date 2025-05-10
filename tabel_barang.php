<?php
// Letakkan session_start() di awal sebelum ada output apapun
session_start();
include 'config.php';

// Tambahkan penanganan error untuk menampilkan pesan yang lebih baik
$dataBarang = array();
$error_message = '';

try {
    $sql = "SELECT * FROM daftar_barang";
    $query = mysqli_query($db, $sql);

    if (!$query) {
        $error_message = "Error: " . mysqli_error($db);
    } else {
        while ($row = mysqli_fetch_assoc($query)) {
            $dataBarang[] = $row;
        }
    }
} catch (Exception $e) {
    $error_message = "Error: " . $e->getMessage();
}
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
            <a href="tambah.php" class="btn btn-success">Tambah Barang</a>
        </nav>

        <?php
        // Pesan konfirmasi jika ada
        if (isset($_SESSION['pesan'])) {
            echo '<div class="alert alert-success">' . $_SESSION['pesan'] . '</div>';
            unset($_SESSION['pesan']);
        }

        // Tampilkan pesan error jika ada
        if (!empty($error_message)) {
            echo '<div class="alert alert-danger">' . $error_message . '</div>';
        }
        ?>

        <table id="tabelBarang" class="table table-striped table-bordered" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Harga Beli</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dataBarang)): ?>
                    <?php foreach ($dataBarang as $row): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['kode_barang'] ?></td>
                            <td><?= $row['nama_barang'] ?></td>
                            <td><?= $row['jumlah_barang'] ?></td>
                            <td><?= $row['satuan_barang'] ?></td>
                            <td><?= $row['harga_beli'] ?></td>
                            <td><?= $row['status_barang'] ? 'Aktif' : 'Tidak Aktif' ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="javascript:void(0);" onclick="konfirmasiHapus(<?= $row['id'] ?>)" class="btn btn-danger btn-sm">Hapus</a>
                                <a href="pakai_barang.php?id=<?= $row['id'] ?>" class="btn btn-secondary btn-sm">Pakai</a>
                                <a href="tambah_stok.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Tambah Stok</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Script DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabelBarang').DataTable();
        });

        // Fungsi konfirmasi hapus
        function konfirmasiHapus(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                window.location.href = 'hapus.php?id=' + id;
            }
        }
    </script>
</body>

</html>