<?php
require_once 'koneksi.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// CEK ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID tidak ditemukan!");
}

$id = $_GET['id'];

// AMBIL DATA
$data = mysqli_query($conn, "SELECT * FROM laporan WHERE id='$id'");

if (!$data) {
    die("Query error: " . mysqli_error($conn));
}

$d = mysqli_fetch_assoc($data);

// PROSES UPDATE
if (isset($_POST['update'])) {

    $tanggal = $_POST['tanggal'];
    $kegiatan = $_POST['kegiatan'];
    $keterangan = $_POST['keterangan'];

    $update = mysqli_query($conn, "UPDATE laporan SET 
        tanggal='$tanggal',
        kegiatan='$kegiatan',
        keterangan='$keterangan'
        WHERE id='$id'
    ");

    if (!$update) {
        die("ERROR UPDATE: " . mysqli_error($conn));
    }

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Laporan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: #f4f6f9;
            font-family: Arial, sans-serif;
        }

        .container-box{
            width: 550px;
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

        <h2 class="title">✏️ Edit Laporan Harian</h2>

        <form method="post">

            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" 
                       name="tanggal" 
                       class="form-control"
                       value="<?= $d['tanggal'] ?>" 
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kegiatan</label>
                <textarea name="kegiatan" 
                          class="form-control" 
                          rows="4" 
                          required><?= $d['kegiatan'] ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" 
                          class="form-control" 
                          rows="3"><?= $d['keterangan'] ?></textarea>
            </div>

            <button type="submit" 
                    name="update" 
                    class="btn btn-warning btn-custom">
                💾 Update Laporan
            </button>

            <a href="index.php" 
               class="btn btn-secondary btn-custom mt-2">
               ← Kembali ke Dashboard
            </a>

        </form>

    </div>

</div>

</body>
</html>