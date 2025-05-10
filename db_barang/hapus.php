<?php
include 'config.php';
$id = $_GET['id'];
mysqli_query($db, "DELETE FROM data_barang WHERE id='$id'");
header("Location: index.php");
