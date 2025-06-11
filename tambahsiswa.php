<?php
include "koneksi.php";
$dp = new database();

// Validasi admin login (opsional jika login diaktifkan)
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: index.html");
    exit;
}

// Proses form
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'nisn'          => $_POST['nisn'],
        'nama'          => $_POST['nama'],
        'jenis_kelamin' => $_POST['jenis_kelamin'],
        'kode_jurusan'  => $_POST['kode_jurusan'],
        'kelas'         => strtoupper($_POST['kelas']),
        'alamat'        => $_POST['alamat'],
        'agama'         => $_POST['agama'],
        'nohp'          => $_POST['nohp']
    ];

    if ($dp->simpan_siswa($data)) {
        header("Location: datasiswa.php");
        exit;
    } else {
        $error = "Gagal menyimpan data siswa.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: #f1f4f9;
      font-family: 'Segoe UI', sans-serif;
    }
    .container {
      max-width: 600px;
      margin: 40px auto;
    }
    .card {
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    .form-control:focus {
      box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    #alert-box {
      position: fixed;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      background-color: #dc3545;
      color: white;
      padding: 15px 25px;
      border-radius: 8px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.2);
      z-index: 9999;
      display: none;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="card p-4">
    <h3 class="mb-3 text-center text-primary">Form Tambah Data Siswa</h3>
    
    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form action="" method="post" id="formSiswa">
      <div class="mb-3">
        <label for="nisn" class="form-label">NISN</label>
        <input type="text" class="form-control" id="nisn" name="nisn" required>
      </div>
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Jenis Kelamin</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="L" required>
          <label class="form-check-label" for="laki">Laki-laki</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P" required>
          <label class="form-check-label" for="perempuan">Perempuan</label>
        </div>
      </div>
      <div class="mb-3">
        <label for="kode_jurusan" class="form-label">Kode Jurusan (1-12)</label>
        <input type="text" class="form-control" id="kode_jurusan" name="kode_jurusan" required>
      </div>
      <div class="mb-3">
        <label for="kelas" class="form-label">Kelas (X/XI/XII)</label>
        <input type="text" class="form-control" id="kelas" name="kelas" required>
      </div>
      <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat" required>
      </div>
      <div class="mb-3">
        <label for="agama" class="form-label">Agama (1-7)</label>
        <input type="text" class="form-control" id="agama" name="agama" required>
      </div>
      <div class="mb-3">
        <label for="nohp" class="form-label">No HP</label>
        <input type="text" class="form-control" id="nohp" name="nohp" required>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-success">
          <i class="bi bi-plus-circle"></i> Tambah Siswa
        </button>
      </div>
    </form>
  </div>
</div>

<div id="alert-box"></div>

<script>
  const form = document.getElementById("formSiswa");
  const alertBox = document.getElementById("alert-box");

  function showAlert(message) {
    alertBox.innerHTML = message;
    alertBox.style.display = "block";
    setTimeout(() => {
      alertBox.style.display = "none";
    }, 4000);
  }

  form.addEventListener("submit", function (e) {
    const jurusan = document.getElementById("kode_jurusan").value.trim();
    const agama = document.getElementById("agama").value.trim();
    const kelas = document.getElementById("kelas").value.trim().toUpperCase();
    const alamat = document.getElementById("alamat").value.trim();
    const nohp = document.getElementById("nohp").value.trim();

    let errors = [];

    const jurusanNum = parseInt(jurusan);
    if (isNaN(jurusanNum) || jurusanNum < 1 || jurusanNum > 12) {
      errors.push("Kode jurusan harus antara 1–12.");
    }

    const agamaNum = parseInt(agama);
    if (isNaN(agamaNum) || agamaNum < 1 || agamaNum > 7) {
      errors.push("ID agama harus antara 1–7.");
    }

    const validKelas = ["X", "XI", "XII"];
    if (!validKelas.includes(kelas)) {
      errors.push("Kelas harus X, XI, atau XII.");
    }

    const regexAlamat = /^[a-zA-Z\s]{5,}$/;
    if (!regexAlamat.test(alamat)) {
      errors.push("Alamat minimal 5 huruf dan spasi.");
    }

    const regexNoHp = /^\d{10,}$/;
    if (!regexNoHp.test(nohp)) {
      errors.push("No HP harus minimal 10 digit angka.");
    }

    if (errors.length > 0) {
      e.preventDefault();
      showAlert(errors.join("<br>"));
    } else {
      document.getElementById("kelas").value = kelas;
    }
  });
</script>

</body>
</html>
