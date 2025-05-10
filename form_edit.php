<?php
include 'config.php';
session_start();

// Ambil data barang berdasarkan ID
$id = $_GET['id'];
$data = mysqli_query($db, "SELECT * FROM daftar_barang WHERE id = $id");
$d = mysqli_fetch_assoc($data);

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];
    $satuan_barang = $_POST['satuan_barang'];
    $harga_beli = $_POST['harga_beli'];
    $status_barang = $_POST['status_barang'];

    $query = mysqli_query($db, "UPDATE daftar_barang SET 
        kode_barang='$kode_barang', 
        nama_barang='$nama_barang', 
        jumlah_barang='$jumlah_barang', 
        satuan_barang='$satuan_barang', 
        harga_beli='$harga_beli',
        status_barang='$status_barang' 
        WHERE id = $id");

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
            <input type="text" name="kode_barang" value="<?= $d['kode_barang']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" value="<?= $d['nama_barang']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jumlah Barang</label>
            <input type="number" name="jumlah_barang" value="<?= $d['jumlah_barang']; ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Satuan Barang</label>
            <input type="text" name="satuan_barang" value="<?= $d['satuan_barang']; ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Harga Beli</label>
            <input type="number" step="0.01" name="harga_beli" value="<?= $d['harga_beli']; ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status_barang" class="form-control">
                <option value="1" <?= $d['status_barang'] == 1 ? 'selected' : ''; ?>>Aktif</option>
                <option value="0" <?= $d['status_barang'] == 0 ? 'selected' : ''; ?>>Tidak Aktif</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="tabel_barang.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>

</html>