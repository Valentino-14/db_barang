<?php
session_start();
include 'config.php';

// Cek apakah form sudah disubmit
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $jumlah_pakai = $_POST['jumlah_pakai'];

    // Validasi jumlah yang dipakai harus angka positif
    if (!is_numeric($jumlah_pakai) || $jumlah_pakai <= 0) {
        $_SESSION['error'] = 'Jumlah pakai harus berupa angka positif!';
        header("Location: pakai_barang.php?id=$id");
        exit;
    }

    // Ambil data barang saat ini
    $query = mysqli_query($db, "SELECT jumlah_barang FROM daftar_barang WHERE id=$id");
    $barang = mysqli_fetch_assoc($query);
    $jumlah_tersedia = $barang['jumlah_barang'];

    // Cek apakah jumlah yang dipakai melebihi stok
    if ($jumlah_pakai > $jumlah_tersedia) {
        $_SESSION['error'] = 'Jumlah yang dipakai melebihi stok tersedia!';
        header("Location: pakai_barang.php?id=$id");
        exit;
    }

    // Kurangi stok
    $sisa = $jumlah_tersedia - $jumlah_pakai;

    // Update status jika stok habis
    $status = ($sisa > 0) ? 1 : 0;

    $update = mysqli_query($db, "UPDATE daftar_barang SET jumlah_barang=$sisa, status_barang=$status WHERE id=$id");

    if ($update) {
        $_SESSION['pesan'] = 'Barang berhasil dipakai!';
        header('Location: tabel_barang.php');
    } else {
        $_SESSION['error'] = 'Gagal memperbarui data: ' . mysqli_error($db);
        header("Location: pakai_barang.php?id=$id");
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
    <title>Pakai Barang | Sistem Inventory Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <h3>Pemakaian Barang</h3>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error'] ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header bg-secondary text-white">
                Form Pemakaian Barang
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

                <form action="" method="post" id="formPakaiBarang">
                    <input type="hidden" name="id" value="<?= $barang['id'] ?>">
                    <div class="mb-3">
                        <label for="jumlah_pakai" class="form-label">Jumlah Pakai</label>
                        <input type="number" class="form-control" id="jumlah_pakai" name="jumlah_pakai" required min="1" max="<?= $barang['jumlah_barang'] ?>">
                        <small class="text-muted">Maksimal: <?= $barang['jumlah_barang'] ?> <?= htmlspecialchars($barang['satuan_barang']) ?></small>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" name="submit" class="btn btn-primary">Pakai Barang</button>
                        <a href="tabel_barang.php" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation with JavaScript
        document.getElementById('formPakaiBarang').addEventListener('submit', function(e) {
            const jumlahPakai = document.getElementById('jumlah_pakai').value;
            const jumlahTersedia = <?= $barang['jumlah_barang'] ?>;

            if (jumlahPakai <= 0) {
                e.preventDefault();
                alert('Jumlah pakai harus lebih dari 0');
            } else if (jumlahPakai > jumlahTersedia) {
                e.preventDefault();
                alert('Jumlah pakai tidak boleh melebihi stok tersedia');
            }
        });
    </script>
</body>

</html>