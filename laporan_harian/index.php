<?php
include 'koneksi.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// DATA
$data = mysqli_query($conn, "SELECT * FROM laporan");
$total = mysqli_num_rows($data);

// DATA GRAFIK (per bulan)
$jan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM laporan WHERE MONTH(tanggal)=1"));
$feb = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM laporan WHERE MONTH(tanggal)=2"));
$mar = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM laporan WHERE MONTH(tanggal)=3"));
$apr = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM laporan WHERE MONTH(tanggal)=4"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Laporan Harian</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f4f6f9;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background: #111827;
            position: fixed;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 12px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #374151;
        }

        .content {
            margin-left: 230px;
            padding: 20px;
        }

        .card-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h4 class="text-center">📊 MENU</h4>
    <a href="index.php">Dashboard</a>
    <a href="tambah.php">Tambah Data</a>
</div>

<!-- CONTENT -->
<div class="content">

    <h2>Dashboard Laporan Harian</h2>

    <!-- CARD TOTAL -->
    <div class="card-box">
        <h4>Total Laporan</h4>
        <h2><?= $total ?></h2>
    </div>

    <!-- GRAFIK -->
    <div class="card-box">
        <h4>📊 Grafik Laporan Bulanan</h4>
        <canvas id="myChart"></canvas>
    </div>

    <!-- TABLE -->
    <div class="card-box">
        <h4>Data Laporan</h4>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kegiatan</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $no = 1;
            while ($d = mysqli_fetch_array($data)) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['tanggal'] ?></td>
                    <td><?= $d['kegiatan'] ?></td>
                    <td><?= $d['keterangan'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $d['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus.php?id=<?= $d['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr'],
        datasets: [{
            label: 'Jumlah Laporan',
            data: [<?= $jan ?>, <?= $feb ?>, <?= $mar ?>, <?= $apr ?>],
            backgroundColor: ['#3b82f6','#10b981','#f59e0b','#ef4444']
        }]
    }
});
</script>

</body>
</html>