<?php
session_start();
include('../config.php');

// Cek apakah pengguna sudah login dan role adalah "calonsiswa"
if ($_SESSION['role'] != "calonsiswa") {
    header("location:gagal_login.php");
    exit;
}

// Query untuk mengambil data pendaftaran pengguna
$username = $_SESSION['username'];
$stmt = $db->prepare("SELECT * FROM pendaftaran WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Periksa apakah data ditemukan
if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan.";
    exit();
}
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Status Pendaftaran</title>
    <link rel="stylesheet" type="text/css" href="../assets/style.css">
    <style>
        /* Styling untuk tampilan vertikal */
        .status-container {
            width: 50%;
            margin: auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .status-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .status-item:last-child {
            border-bottom: none;
        }
        .status-label {
            font-weight: bold;
            color: #333;
        }
        .status-value {
            color: #555;
        }

        /* Styling untuk modal pop-up */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }
        .modal-content {
            margin: 5% auto;
            padding: 20px;
            width: 80%;
            max-width: 600px;
            background-color: white;
            border-radius: 8px;
            position: relative;
        }
        .close {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 25px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="status-container">
        <h2>Status Pendaftaran</h2>

        <div class="status-item">
            <span class="status-label">Nama:</span>
            <span class="status-value"><?php echo htmlspecialchars($data['nama']); ?></span>
        </div>

        <div class="status-item">
            <span class="status-label">NISN:</span>
            <span class="status-value"><?php echo htmlspecialchars($data['nisn']); ?></span>
        </div>

        <div class="status-item">
            <span class="status-label">Jurusan:</span>
            <span class="status-value"><?php echo htmlspecialchars($data['jurusan']); ?></span>
        </div>

        <div class="status-item">
            <span class="status-label">Email:</span>
            <span class="status-value"><?php echo htmlspecialchars($data['email']); ?></span>
        </div>

        <div class="status-item">
            <span class="status-label">No HP:</span>
            <span class="status-value"><?php echo htmlspecialchars($data['nohp']); ?></span>
        </div>

        <div class="status-item">
            <span class="status-label">Alamat:</span>
            <span class="status-value"><?php echo htmlspecialchars($data['alamat']); ?></span>
        </div>

        <div class="status-item">
            <span class="status-label">Nilai Rata-Rata:</span>
            <span class="status-value"><?php echo htmlspecialchars($data['ratanilai']); ?></span>
        </div>

        <div class="status-item">
            <span class="status-label">Status:</span>
            <span class="status-value"><?php echo htmlspecialchars($data['statuscs']); ?></span>
        </div>

        <div class="status-item">
            <span class="status-label">KTP:</span>
            <span class="status-value"><a href="#" onclick="openModal()">Lihat File</a></span>
        </div>
    </div>

    <!-- Modal untuk menampilkan file KTP -->
    <div id="ktpModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>File KTP</h2>
            <img src="../uploads/<?php echo htmlspecialchars($data['ktp']); ?>" alt="KTP" style="width: 100%; border-radius: 8px;">
        </div>
    </div>

    <script>
        // Fungsi untuk membuka modal
        function openModal() {
            document.getElementById("ktpModal").style.display = "block";
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            document.getElementById("ktpModal").style.display = "none";
        }

        // Menutup modal jika pengguna mengklik di luar area modal
        window.onclick = function(event) {
            var modal = document.getElementById("ktpModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
