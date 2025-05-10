<?php
include 'config.php';
$id = $_GET['id'];

$result = mysqli_query($db, "SELECT * FROM daftar_barang WHERE id = '$id'");
$data = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jumlah = $_POST['jumlah'];
    mysqli_query($db, "UPDATE barang SET nama='$nama', jumlah='$jumlah' WHERE id='$id'");
    header("Location: kotak.php");
}
?>

<form method="POST">
    Nama: <input type="text" name="nama" value="<?= $data['nama'] ?>"><br>
    Jumlah: <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>"><br>
    <button type="submit">Simpan Perubahan</button>
</form>
