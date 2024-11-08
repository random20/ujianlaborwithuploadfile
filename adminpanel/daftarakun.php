<!DOCTYPE html>
<html>

<head>
    <title>Daftar Akun</title>
    <link rel="stylesheet" type="text/css" href="../assets/style.css">
    <style>
        /* Modal Style */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-header {
            font-size: 18px;
            font-weight: bold;
        }

        .form-input {
            margin-bottom: 10px;
        }
    </style>
</head>

<?php
session_start();

// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['role'] == "calonsiswa" || $_SESSION['role'] == "") {
    header("location:gagal_login");
}

?>

<body>
    <div class="datadaftar">
        <p class="tulisan_menu" style="color:black;">Daftar Akun</p>
        <br>
        <br>

        <table border="1" align="center">
            <thead>
                <th>No</th>
                <th>Username</th>
                <th>Role</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                include '../config.php';
                $no = 1;
                $sql = mysqli_query($db, "SELECT * FROM user");
                while ($query = mysqli_fetch_array($sql)) {
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $query['username']; ?></td>
                        <td><?php echo $query['role']; ?></td>
                        <td>
                            <button class="tomboltabel" onclick="openModal(<?php echo $query['id']; ?>)">DETAIL</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal HTML -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="modal-header">Detail Akun</div>
            <div id="modal-body">
                <!-- Data akan dimuat di sini menggunakan Ajax -->
            </div>
            <div id="modal-actions">
                <!-- Form untuk mengedit atau menghapus user -->
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk membuka modal
        function openModal(id) {
            // Menampilkan modal
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
            
            // Mengambil detail akun menggunakan Ajax
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "detailuser.php?id=" + id, true);
            xhr.onload = function () {
                if (xhr.status == 200) {
                    var data = JSON.parse(xhr.responseText); // Parsing JSON data
                    document.getElementById("modal-body").innerHTML = `
                        <p><strong>Username:</strong> ${data.username}</p>
                        <p><strong>Role:</strong> ${data.role}</p>
                    `;
                    document.getElementById("modal-actions").innerHTML = `
                        <button onclick="deleteUser(${id})">Hapus User</button>
                        <button onclick="showEditForm(${id}, '${data.username}', '${data.role}')">Edit User</button>
                    `;
                }
            };
            xhr.send();
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        // Fungsi untuk menghapus user
        function deleteUser(id) {
            if (confirm("Apakah Anda yakin ingin menghapus user ini?")) {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "delete_user.php?id=" + id, true);
                xhr.onload = function () {
                    if (xhr.status == 200) {
                        alert("User berhasil dihapus!");
                        closeModal();
                        location.reload(); // Refresh halaman untuk melihat perubahan
                    } else {
                        alert("Terjadi kesalahan saat menghapus user.");
                    }
                };
                xhr.send();
            }
        }

        // Fungsi untuk menampilkan form edit
        function showEditForm(id, username, role) {
            var modalBody = document.getElementById("modal-body");
            modalBody.innerHTML = `
                <form action="edit_user.php" method="POST">
                    <input type="hidden" name="id" value="${id}">
                    <div class="form-input">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="${username}" required>
                    </div>
                    <div class="form-input">
                        <label for="role">Role:</label>
                        <select id="role" name="role" required>
                            <option value="admin" ${role === "admin" ? "selected" : ""}>Admin</option>
                            <option value="calonsiswa" ${role === "calonsiswa" ? "selected" : ""}>Calon Siswa</option>
                        </select>
                    </div>
                    <div class="form-input">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" placeholder="Leave blank if no change">
                    </div>
                    <button type="submit">Update</button>
                </form>
            `;
        }

        // Menutup modal jika klik di luar modal
        window.onclick = function (event) {
            var modal = document.getElementById("myModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>

</html>
