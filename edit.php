<?php
session_start();
include 'config.php';

$id = $_GET['id'];

// Menggunakan nama tabel yang benar dan konsisten
$result = mysqli_query($db, "SELECT * FROM daftar_barang WHERE id = '$id'");
$data = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];
    $satuan_barang = $_POST['satuan_barang'];
    $harga_beli = $_POST['harga_beli'];
    $status_barang = $_POST['status_barang'];

    // Menggunakan nama tabel dan field-field yang benar
    $query = mysqli_query($db, "UPDATE daftar_barang SET 
        kode_barang='$kode_barang', 
        nama_barang='$nama_barang', 
        jumlah_barang='$jumlah_barang', 
        satuan_barang='$satuan_barang', 
        harga_beli='$harga_beli',
        status_barang='$status_barang' 
        WHERE id='$id'");

    if ($query) {
        $_SESSION['pesan'] = "Data berhasil diperbarui";
    } else {
        $_SESSION['pesan'] = "Error: " . mysqli_error($db);
    }

    header("Location: tabel_barang.php");
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
            <input type="text" name="kode_barang" value="<?= $data['kode_barang']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" value="<?= $data['nama_barang']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jumlah Barang</label>
            <input type="number" name="jumlah_barang" value="<?= $data['jumlah_barang']; ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Satuan Barang</label>
            <input type="text" name="satuan_barang" value="<?= $data['satuan_barang']; ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Harga Beli</label>
            <input type="number" step="0.01" name="harga_beli" value="<?= $data['harga_beli']; ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status_barang" class="form-control">
                <option value="1" <?= $data['status_barang'] == 1 ? 'selected' : ''; ?>>Aktif</option>
                <option value="0" <?= $data['status_barang'] == 0 ? 'selected' : ''; ?>>Tidak Aktif</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="tabel_barang.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>

</html>