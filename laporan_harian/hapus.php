<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'koneksi.php';

if (!isset($_GET['id'])) {
    die("ID tidak ada");
}

$id = $_GET['id'];

$query = mysqli_query($conn, "DELETE FROM laporan WHERE id='$id'");

if (!$query) {
    die("Gagal hapus: " . mysqli_error($conn));
}

header("Location: index.php");
exit;
?>