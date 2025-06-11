<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Jurusan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow rounded-4 p-4" style="width: 100%; max-width: 700px;">

            <div class="card-header bg-primary text-white rounded-top-4">
                <h4 class="mb-0 text-center">Form Tambah Jurusan</h4>
            </div>

            <div class="card-body">
                <?php
                if (isset($_SESSION['message'])) {
                    echo '<div class="alert alert-info">'.$_SESSION['message'].'</div>';
                    unset($_SESSION['message']);
                }
                ?>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="kode_jurusan" class="form-label">Kode Jurusan</label>
                        <input type="text" id="kode_jurusan" name="kode_jurusan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
                        <input type="text" id="nama_jurusan" name="nama_jurusan" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="datajurusan.php" class="btn btn-secondary">Kembali</a>
                        <button type="submit" name="simpan" class="btn btn-primary">Tambah Jurusan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_jurusan = $_POST['kode_jurusan'];
    $nama_jurusan = $_POST['nama_jurusan'];

    // Koneksi ke database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sekolah";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Gunakan prepared statement
    $stmt = $conn->prepare("INSERT INTO jurusan (kode_jurusan, nama_jurusan) VALUES (?, ?)");
    $stmt->bind_param("ss", $kode_jurusan, $nama_jurusan);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Jurusan berhasil ditambahkan";
    } else {
        $_SESSION['message'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: datajurusan.php");
    exit();
}
?>
