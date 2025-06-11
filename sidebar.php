<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$dataPages = ['datasiswa.php', 'datajurusan.php', 'dataagama.php'];
$dataMenuOpen = in_array($currentPage, $dataPages) ? 'menu-open' : '';
$dataLinkActive = in_array($currentPage, $dataPages) ? 'active' : '';

$formPages = ['tambahsiswa.php', 'tambahjurusan.php', 'tambahagama.php'];
$formMenuOpen = in_array($currentPage, $formPages) ? 'menu-open' : '';
$formLinkActive = in_array($currentPage, $formPages) ? 'active' : '';

$ekstraPages = ['TARI.php', 'PASKIBRA.php', 'PRAMUKA.php', 'layout/sidebar-mini.html', 'layout/fixed-sidebar.html', 'layout/layout-rtl.html'];
$ekstraMenuOpen = in_array($currentPage, $ekstraPages) ? 'menu-open' : '';
$ekstraLinkActive = in_array($currentPage, $ekstraPages) ? 'active' : '';
?>

<!--begin::Sidebar-->
<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <div class="sidebar-brand">
    <a href="./index.php" class="brand-link">
      <img src="dist/assets/img/logosekolah.png" alt="AdminLTE Logo" class="brand-image" />
      <span class="brand-text fw-light">SMKN 6 SURAKARTA</span>
    </a>
  </div>

  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="dashboard.php" class="nav-link <?= $currentPage == 'dashboard.php' ? 'active' : '' ?>">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="Tentang.php" class="nav-link <?= $currentPage == 'Tentang.php' ? 'active' : '' ?>">
            <i class="nav-icon bi bi-patch-check-fill"></i>
            <p>Tentang</p>
          </a>
        </li>

        <!-- Menu Data -->
        <li class="nav-item <?= $dataMenuOpen ?>">
          <a href="#" class="nav-link <?= $dataLinkActive ?>">
            <i class="nav-icon bi bi-table"></i>
            <p>Data<i class="nav-arrow bi bi-chevron-right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="datasiswa.php" class="nav-link <?= $currentPage == 'datasiswa.php' ? 'active' : '' ?>">
                <i class="nav-icon bi bi-circle"></i>
                <p>Data Siswa</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="datajurusan.php" class="nav-link <?= $currentPage == 'datajurusan.php' ? 'active' : '' ?>">
                <i class="nav-icon bi bi-circle"></i>
                <p>Data Jurusan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="dataagama.php" class="nav-link <?= $currentPage == 'dataagama.php' ? 'active' : '' ?>">
                <i class="nav-icon bi bi-circle"></i>
                <p>Data Agama</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Menu Forms -->
        <li class="nav-item <?= $formMenuOpen ?>">
          <a href="#" class="nav-link <?= $formLinkActive ?>">
            <i class="nav-icon bi bi-pencil-square"></i>
            <p>Forms<i class="nav-arrow bi bi-chevron-right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="tambahsiswa.php" class="nav-link <?= $currentPage == 'tambahsiswa.php' ? 'active' : '' ?>">
                <i class="nav-icon bi bi-circle"></i>
                <p>Form Siswa</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="tambahjurusan.php" class="nav-link <?= $currentPage == 'tambahjurusan.php' ? 'active' : '' ?>">
                <i class="nav-icon bi bi-circle"></i>
                <p>Form Jurusan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="tambahagama.php" class="nav-link <?= $currentPage == 'tambahagama.php' ? 'active' : '' ?>">
                <i class="nav-icon bi bi-circle"></i>
                <p>Form Agama</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Menu Ekstrakurikuler -->
        <li class="nav-item <?= $ekstraMenuOpen ?>">
          <a href="#" class="nav-link <?= $ekstraLinkActive ?>">
            <i class="nav-icon bi bi-clipboard-fill"></i>
            <p>
              Ekstrakurikuler
              <span class="nav-badge badge text-bg-secondary me-3">14</span>
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php
            $ekstraList = [
              'TARI.php' => 'SENI TARI',
              'PASKIBRA.php' => 'PASKIBRA',
              'PRAMUKA.php' => 'PRAMUKA',
              'layout/sidebar-mini.html' => 'PMR',
              'layout/fixed-sidebar.html' => 'FUTSAL',
              'layout/fixed-sidebar.html' => 'BOLA VOLI',
              'layout/layout-rtl.html' => 'KIR MADING',
              'layout/fixed-sidebar.html' => 'ROHIS',
              'layout/fixed-sidebar.html' => 'ROHKAT',
              'layout/fixed-sidebar.html' => 'ROHKRIS',
              'layout/fixed-sidebar.html' => 'ELVISKA',
              'layout/fixed-sidebar.html' => 'KMVI',
              'layout/fixed-sidebar.html' => 'NAVISKA'
            ];
            foreach ($ekstraList as $file => $name) {
              $isActive = $currentPage == $file ? 'active' : '';
              echo "<li class='nav-item'>
                      <a href='$file' class='nav-link $isActive'>
                        <i class='nav-icon bi bi-circle'></i>
                        <p>$name</p>
                      </a>
                    </li>";
            }
            ?>
          </ul>
        </li>

        <!-- Akun -->
        <li class="nav-header">Akun</li>
        <li class="nav-item">
          <a href="Profile.php" class="nav-link <?= $currentPage == 'Profile.php' ? 'active' : '' ?>">
            <i class="nav-icon bi bi-patch-check-fill"></i>
            <p>Profil</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#logoutModal">
            <i class="nav-icon bi bi-box-arrow-in-right"></i>
            Keluar
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>

      <!--end::Sidebar-->

      <script>
  function konfirmasiLogout() {
    return confirm("Apakah Anda yakin ingin keluar?");
  }
</script>

<!-- Modal Konfirmasi Logout -->
<!-- Modal Konfirmasi Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-light text-dark border-0 rounded-top-4">
        <h5 class="modal-title d-flex align-items-center gap-2" id="logoutModalLabel">
          <i class="bi bi-box-arrow-right fs-4 text-danger"></i> Konfirmasi Keluar
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body text-center py-4">
        <i class="bi bi-question-circle-fill text-warning fs-1 mb-3"></i>
        <p class="fs-5 mb-0">Apakah Anda yakin ingin keluar?</p>
      </div>
      <div class="modal-footer border-0 d-flex justify-content-center gap-3 pb-4">
        <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Tidak</button>
        <a href="logout.php" class="btn btn-danger px-4">Ya, Keluar</a>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap 5 CSS (jika belum ada) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap 5 JS & dependencies (jika belum ada) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>  