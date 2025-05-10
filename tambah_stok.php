<?php
session_start();
include 'config.php';

// Cek apakah form sudah disubmit
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $jumlah_tambah = $_POST['jumlah_tambah'];

    // Validasi jumlah yang ditambahkan harus angka positif
    if (!is_numeric($jumlah_tambah) || $jumlah_tambah <= 0) {
        $_SESSION['error'] = 'Jumlah tambah harus berupa angka positif!';
        header("Location: tambah_stok.php?id=$id");
        exit;
    }

    // Ambil data barang saat ini
    $query = mysqli_query($db, "SELECT jumlah_barang FROM daftar_barang WHERE id=$id");
    $barang = mysqli_fetch_assoc($query);
    $jumlah_tersedia = $barang['jumlah_barang'];

    // Tambah stok
    $total = $jumlah_tersedia + $jumlah_tambah;

    // Update status jika stok bertambah (pasti available)
    $update = mysqli_query($db, "UPDATE daftar_barang SET jumlah_barang=$total, status_barang=1 WHERE id=$id");

    if ($update) {
        $_SESSION['pesan'] = 'Stok barang berhasil ditambahkan!';
        header('Location: tabel_barang.php');
    } else {
        $_SESSION['error'] = 'Gagal memperbarui data: ' . mysqli_error($db);
        header("Location: tambah_stok.php?id=$id");
    }
    exit;
}

// Ambil ID dari parameter URL
$id = isset($_GET['id']) ? $_GET['id'] : 0;
if (!$id) {
    $_SESSION['error'] = 'ID barang tidak valid!';
    header('Location: tabel_barang.php');
    exit;
}

// Ambil data barang
$query = mysqli_query($db, "SELECT * FROM daftar_barang WHERE id=$id");
$barang = mysqli_fetch_assoc($query);

// Cek apakah barang ditemukan
if (!$barang) {
    $_SESSION['error'] = 'Barang tidak ditemukan!';
    header('Location: tabel_barang.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Stok Barang | Sistem Inventory Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <h3>Tambah Stok Barang</h3>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error'] ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header bg-info text-white">
                Form Tambah Stok Barang
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Kode Barang</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($barang['kode_barang']) ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($barang['nama_barang']) ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah Tersedia</label>
                    <input type="text" class="form-control" value="<?= $barang['jumlah_barang'] ?> <?= htmlspecialchars($barang['satuan_barang']) ?>" readonly>
                </div>

                <form action="" method="post" id="formTambahStok">
                    <input type="hidden" name="id" value="<?= $barang['id'] ?>">
                    <div class="mb-3">
                        <label for="jumlah_tambah" class="form-label">Jumlah Tambah</label>
                        <input type="number" class="form-control" id="jumlah_tambah" name="jumlah_tambah" required min="1">
                        <small class="text-muted">Masukkan jumlah barang yang akan ditambahkan</small>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" name="submit" class="btn btn-primary">Tambah Stok</button>
                        <a href="tabel_barang.php" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation with JavaScript
        document.getElementById('formTambahStok').addEventListener('submit', function(e) {
            const jumlahTambah = document.getElementById('jumlah_tambah').value;

            if (jumlahTambah <= 0) {
                e.preventDefault();
                alert('Jumlah tambah harus lebih dari 0');
            }
        });
    </script>
</body>

</html>