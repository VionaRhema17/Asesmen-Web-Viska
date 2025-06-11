<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tambah Data Agama</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body class="bg-light">

  <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow rounded-4 p-4" style="width: 100%; max-width: 700px;">
      
      <div class="card-header bg-primary text-white rounded-top-4">
        <h4 class="mb-0 text-center">Form Tambah Agama</h4>
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
            <label for="idagama" class="form-label">Kode Agama</label>
            <input type="text" id="idagama" name="idagama" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="nama_agama" class="form-label">Nama Agama</label>
            <input type="text" id="nama_agama" name="nama_agama" class="form-control" required>
          </div>
          <div class="d-flex justify-content-between">
            <a href="dataagama.php" class="btn btn-secondary">Kembali</a>
            <button type="submit" name="simpan" class="btn btn-primary">Tambah Agama</button>
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
    $idagama = $_POST['idagama'];
    $nama_agama = $_POST['nama_agama'];

    $conn = new mysqli("localhost", "root", "", "sekolah");

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO agama (idagama, nama_agama) VALUES (?, ?)");
    $stmt->bind_param("ss", $idagama, $nama_agama);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Agama berhasil ditambahkan";
    } else {
        $_SESSION['message'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: dataagama.php");
    exit();
}
?>
