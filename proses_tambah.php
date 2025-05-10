<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];
    $satuan_barang = $_POST['satuan_barang'];
    $harga_beli = $_POST['harga_beli'];
    $status_barang = isset($_POST['status_barang']) ? 1 : 0;

    // Menggunakan nama tabel yang benar
    $query = mysqli_query($db, "INSERT INTO daftar_barang 
                        (kode_barang, nama_barang, jumlah_barang, satuan_barang, harga_beli, status_barang) 
                        VALUES 
                        ('$kode_barang', '$nama_barang', '$jumlah_barang', '$satuan_barang', '$harga_beli', '$status_barang')");

    if ($query) {
        $_SESSION['pesan'] = "Data berhasil ditambahkan";
    } else {
        $_SESSION['pesan'] = "Data gagal ditambahkan: " . mysqli_error($db);
    }

    header('Location: tabel_barang.php');
    exit;
} else {
    header('Location: tambah.php');
    exit;
}
