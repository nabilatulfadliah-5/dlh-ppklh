<?php
$conn = mysqli_connect("localhost", "root", "", "laporan_harian");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>