<?php

$server = "localhost";
$user = "root";
$password = "";
$database = "db_barang";

$db = mysqli_connect($server, $user, $password, $database);

if (!$db) {
    die("Gagal Terhubung dengan database!");
}
