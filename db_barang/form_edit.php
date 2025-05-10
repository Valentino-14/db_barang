<?php
include 'config.php';

// Ambil data barang berdasarkan ID
$id = $_GET['id'];
$data = mysqli_query($db, "SELECT * FROM data_barang WHERE id = $id");
$d = mysqli_fetch_assoc($data);

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $jumlah_tersedia = $_POST['jumlah_tersedia'];
    $satuan = $_POST['satuan'];
    $harga_beli = $_POST['harga_beli'];

    mysqli_query($db, "UPDATE barang SET 
        kode_barang='$kode_barang', 
        nama_barang='$nama_barang', 
        jumlah_tersedia='$jumlah_tersedia', 
        satuan='$satuan', 
        harga_beli='$harga_beli' 
        WHERE id = $id");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h3>Edit Data Barang</h3>
    <form method="POST">
        <div class="mb-3">
            <label>Kode Barang</label>
            <input type="text" name="kode_barang" value="<?= $d['kode_barang']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" value="<?= $d['nama_barang']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jumlah Tersedia</label>
            <input type="number" name="jumlah_tersedia" value="<?= $d['jumlah_tersedia']; ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Satuan</label>
            <input type="text" name="satuan" value="<?= $d['satuan']; ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Harga Beli</label>
            <input type="number" name="harga_beli" value="<?= $d['harga_beli']; ?>" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>
