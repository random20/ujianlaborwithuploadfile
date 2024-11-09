<?php
session_start();

// cek apakah yang mengakses halaman ini sudah login dan sebagai admin
if ($_SESSION['role'] != "admin") {
    header("location:gagal_login.php");
    exit();
}

include '../config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Daftar Pendaftar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .laporan {
            width: 90%;
            margin: auto;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        td img {
            width: 60px; /* Ukuran kecil untuk foto KTP */
            height: auto;
            display: block;
            margin: 0 auto;
            border-radius: 5px;
        }

        .tombol-cetak {
            margin: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .tombol-cetak:hover {
            background-color: #45a049;
        }

        h2 {
            color: #333;
        }
    </style>
</head>
<body>

<div class="laporan">
    <h2>Laporan Daftar Pendaftar</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NISN</th>
                <th>Jurusan</th>
                <th>Email</th>
                <th>No. HP</th>
                <th>Alamat</th>
                <th>Rata-rata Nilai</th>
                <th>Foto KTP</th>
                <th>Status Pendaftaran</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $sql = mysqli_query($db, "SELECT * FROM pendaftaran");
            while ($query = mysqli_fetch_assoc($sql)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($query['nama']) . "</td>";
                echo "<td>" . htmlspecialchars($query['nisn']) . "</td>";
                echo "<td>" . htmlspecialchars($query['jurusan']) . "</td>";
                echo "<td>" . htmlspecialchars($query['email']) . "</td>";
                echo "<td>" . htmlspecialchars($query['nohp']) . "</td>";
                echo "<td>" . htmlspecialchars($query['alamat']) . "</td>";
                echo "<td>" . htmlspecialchars($query['ratanilai']) . "</td>";
                
                // Menampilkan foto KTP jika ada
                $ktpPath = $query['ktp'] ?? '';
                if (file_exists($ktpPath) && !empty($ktpPath)) {
                    echo "<td><img src='" . htmlspecialchars($ktpPath) . "' alt='Foto KTP'></td>";
                } else {
                    echo "<td><p>Tidak ada foto</p></td>";
                }

                echo "<td>" . htmlspecialchars($query['statuscs']) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Tombol untuk mencetak halaman -->
<button onclick="window.print()" class="tombol-cetak">Cetak Laporan</button>

</body>
</html>
