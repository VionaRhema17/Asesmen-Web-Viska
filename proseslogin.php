<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['nama']) && !empty($_POST['password']) && !empty($_POST['role'])) {
        // Bersihkan dan normalisasi input
        $nama = strtolower(trim($_POST['nama']));
        $password = $_POST['password'];
        $role = strtolower(trim($_POST['role']));

        // Buat objek dari class database
        $db = new database();

        // Escape string untuk keamanan
        $nama = mysqli_real_escape_string($db->koneksi, $nama);
        $role = mysqli_real_escape_string($db->koneksi, $role);

        // Query dengan pencocokan case-insensitive
        $sql = "SELECT * FROM users WHERE LOWER(nama)='$nama' AND LOWER(role)='$role'";
        $result = mysqli_query($db->koneksi, $sql);

        if ($result && mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['role'] = $user['role'];

                // Redirect berdasarkan role
                switch (strtolower($user['role'])) {
                    case 'admin':
                        header("Location: dashboard.php");
                        break;
                    case 'guru':
                        header("Location: dashboardguru.php");
                        break;
                    case 'siswa':
                        header("Location: dashboardsiswa.php");
                        break;
                    default:
                        echo "Peran tidak dikenali.";
                }
                exit;
            } else {
                echo "Password salah!";
            }
        } else {
            echo "Akun tidak ditemukan atau peran salah.";
        }
    } else {
        echo "Semua field harus diisi.";
    }
} else {
    echo "Akses ditolak.";
}
?>
