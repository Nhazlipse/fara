<?php 
include "koneksi.php";
include "../layout/header.php";
include "../config/function.php";

?>

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="dashboard.php" class="site_title"><i class="fa fa-graduation-cap"></i> <span>Beasiswa WP</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/1.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>Administrator</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="dashboard.php">Dashboard</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Data <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="alternatif_kriteria.php">Data Alternatif dan Kriteria</a></li>
                      <li><a href="bobot.php">Data Bobot dan Kriteria</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Perhitungan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="perhitungan.php">Hasil</a></li>
                    </ul>
                  </li>
                
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/1.png" alt="">Administrator
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>

              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

<!-- ISI PAGE -->
        <!-- page content -->
        <div class="right_col" role="main">


<?php

// Pengecekan apakah parameter id_arsip ada dalam URL
if(isset($_GET['id_arsip'])) {
  $id_arsip = $_GET['id_arsip'];

  // Query untuk mendapatkan data arsip berdasarkan id_arsip
  $query = "SELECT tbl_arsip.*, tbl_departemen.nama_departemen, tbl_pengirim_surat.nama_pengirim, tbl_pengirim_surat.no_hp
            FROM tbl_arsip
            INNER JOIN tbl_departemen ON tbl_arsip.id_departemen = tbl_departemen.id_departemen
            INNER JOIN tbl_pengirim_surat ON tbl_arsip.id_pengirim = tbl_pengirim_surat.id_pengirim_surat
            WHERE tbl_arsip.id_arsip = '$id_arsip'";
  $result = mysqli_query($koneksi, $query);
  $data = mysqli_fetch_assoc($result);

  // Pengecekan apakah data ditemukan
  if ($data) {
    $vno_surat = $data['no_surat'];
    $vtanggal_surat = $data['tanggal_surat'];
    $vtanggal_diterima = $data['tanggal_diterima'];
    $vperihal = $data['perihal'];
    $vid_departemen = $data['id_departemen'];
    $vnama_departemen = $data['nama_departemen'];
    $vid_pengirim = $data['id_pengirim'];
    $vnama_pengirim = $data['nama_pengirim'];
    $vfile = $data['file'];
  } else {
    echo "Data not found.";
    exit;
  }
} else {
  echo "Invalid parameter.";
  exit;
}

// Proses simpan atau ubah data saat tombol disubmit
if(isset($_POST['bsimpan'])) {
  $no_surat = $_POST['no_surat'];
  $tanggal_surat = $_POST['tanggal_surat'];
  $tanggal_diterima = $_POST['tanggal_diterima'];
  $perihal = $_POST['perihal'];
  $id_departemen = $_POST['id_departemen'];
  $id_pengirim = $_POST['id_pengirim'];
  $file = $_FILES['file'];

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses upload file
    $file_name = upload();
    if ($file_name !== false) {
      // File berhasil diunggah, lanjutkan dengan proses lainnya
      // ...
      // Lanjutkan dengan proses lainnya setelah upload berhasil
      // ...
  
      // Contoh: Tampilkan pesan sukses
      echo "File berhasil diunggah dengan nama: " . $file_name;
    }
  }

  // Query untuk melakukan update data
  $query = "UPDATE tbl_arsip
            SET no_surat = '$no_surat',
                tanggal_surat = '$tanggal_surat',
                tanggal_diterima = '$tanggal_diterima',
                perihal = '$perihal',
                id_departemen = '$id_departemen',
                id_pengirim = '$id_pengirim',
                file = '$file_name'
            WHERE id_arsip = '$id_arsip'";

  $result = mysqli_query($koneksi, $query);

  if ($result) {
    echo "<script>alert('Data updated successfully.');
    window.location.href = 'arsip-surat.php';
    </script>";
  } else {
    echo "<script>alert('Failed to update data.');</script>";
  }
}

?>

<!-- Form Edit Data -->
<div class="card mt-3">
  <div class="card-header bg-warning text-white">
    Form Edit Data Arsip Surat
  </div>
  <div class="card-body">
    <form method="post" action="" enctype="multipart/form-data">
      <div class="form-group">
        <label for="no_surat">No. Surat</label>
        <input type="text" class="form-control" id="no_surat" name="no_surat" value="<?= $vno_surat ?>">
      </div>

      <div class="form-group">
        <label for="tanggal_surat">Tanggal Surat</label>
        <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" value="<?= $vtanggal_surat ?>">
      </div>

      <div class="form-group">
        <label for="tanggal_diterima">Tanggal Diterima</label>
        <input type="date" class="form-control" id="tanggal_diterima" name="tanggal_diterima" value="<?= $vtanggal_diterima ?>">
      </div>

      <div class="form-group">
        <label for="perihal">Perihal</label>
        <input type="text" class="form-control" id="perihal" name="perihal" value="<?= $vperihal ?>">
      </div>

      <div class="form-group">
        <label for="id_departemen">Departemen / Tujuan</label>
        <select class="form-control" name="id_departemen">
          <option value="<?= $vid_departemen ?>"><?= $vnama_departemen ?></option>
          <?php
          $tampil = mysqli_query($koneksi, "SELECT * from tbl_departemen order by nama_departemen asc");
          while ($data = mysqli_fetch_array($tampil)) {
            echo "<option value='$data[id_departemen]'> $data[nama_departemen]</option> ";
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="id_pengirim">Pengirim Surat</label>
        <select class="form-control" name="id_pengirim">
          <option value="<?= $vid_pengirim ?>"><?= $vnama_pengirim ?></option>
          <?php
          $tampil = mysqli_query($koneksi, "SELECT * from tbl_pengirim_surat order by nama_pengirim asc");
          while ($data = mysqli_fetch_array($tampil)) {
            echo "<option value='$data[id_pengirim_surat]'> $data[nama_pengirim]</option> ";
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="file">Pilih File</label>
        <input type="file" class="form-control" id="file" name="file">
      </div>

      <button type="submit" name="bsimpan" class="btn btn-primary mt-3">Simpan</button>
      <a href="arsip-surat.php" class="btn btn-danger mt-3">Batal</a>

    </form>
  </div>
</div>

<?php
include "../layout/footer.php";
?>

</body>
</html>
