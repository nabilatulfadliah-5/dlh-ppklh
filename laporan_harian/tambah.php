<?php
include 'koneksi.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['simpan'])) {

    $tanggal = $_POST['tanggal'];
    $kegiatan = $_POST['kegiatan'];
    $keterangan = $_POST['keterangan'];

    $query = mysqli_query($conn, "INSERT INTO laporan (tanggal, kegiatan, keterangan)
    VALUES ('$tanggal', '$kegiatan', '$keterangan')");

    if (!$query) {
        die("ERROR INSERT: " . mysqli_error($conn));
    }

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Laporan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: #f4f6f9;
            font-family: Arial, sans-serif;
        }

        .container-box{
            width: 500px;
            margin: 50px auto;
        }

        .card-custom{
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .title{
            text-align: center;
            margin-bottom: 25px;
            font-weight: bold;
            color: #1f2937;
        }

        .btn-custom{
            width: 100%;
            padding: 10px;
            font-weight: bold;
        }

        textarea{
            resize: none;
        }
    </style>
</head>

<body>

<div class="container-box">

    <div class="card-custom">

        <h2 class="title">📝 Tambah Laporan Harian</h2>

        <form method="post">

            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kegiatan</label>
                <textarea name="kegiatan" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" name="simpan" class="btn btn-primary btn-custom">
                💾 Simpan Laporan
            </button>

            <a href="index.php" class="btn btn-secondary btn-custom mt-2">
                ← Kembali ke Dashboard
            </a>

        </form>

    </div>

</div>

</body>
</html>