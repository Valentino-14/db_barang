<?php

$server = "localhost";
$user = "root";
$password = "";
$database = "dt_barang";

$db = mysqli_connect($server, $user, $password, $database);

if (!$db) {
    die("Gagal Terhubung dengan database!");
}