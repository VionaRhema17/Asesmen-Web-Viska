
<?php
session_start();
include "koneksi.php";
$dp = new database();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}

$userId = $_SESSION['user_id'];
$role = $_SESSION['role']; // Tambahkan baris ini

$updateFields = [];

// Ganti password jika diisi
if (!empty($_POST['password'])) {
    $passwordBaru = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $updateFields[] = "password = '$passwordBaru'";
}

// Ganti foto jika diupload
if (!empty($_FILES['foto']['name'])) {
    $fotoName = uniqid() . '_' . basename($_FILES['foto']['name']);
    $targetPath = "uploads/" . $fotoName;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetPath)) {
        $updateFields[] = "foto = '$fotoName'";
        $_SESSION['foto'] = $fotoName; // Simpan ke session
    }
}

// Lakukan update jika ada data yang diubah
if (!empty($updateFields)) {
    $query = "UPDATE users SET " . implode(", ", $updateFields) . " WHERE id = '$userId'";
    mysqli_query($dp->koneksi, $query);
}

// Redirect ke dashboard sesuai role
if ($role == 'admin') {
    header("Location: dashboard.php");
} else if ($role == 'guru') {
    header("Location: dashboardguru.php");
} else if ($role == 'siswa') {
    header("Location: dashboardsiswa.php");
}
exit;