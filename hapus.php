<?php
session_start();
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Menggunakan nama tabel yang benar dan konsisten
    $query = mysqli_query($db, "DELETE FROM daftar_barang WHERE id='$id'");

    if ($query) {
        $_SESSION['pesan'] = "Data berhasil dihapus";
    } else {
        $_SESSION['pesan'] = "Data gagal dihapus: " . mysqli_error($db);
    }
    header('Location: tabel_barang.php');
    exit;
} else {
    $_SESSION['pesan'] = "ID tidak ditemukan";
    header('Location: tabel_barang.php');
    exit;
}
