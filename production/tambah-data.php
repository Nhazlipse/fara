<?php 
include "koneksi.php";
include "../layout/header.php";

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
              <a href="dashboard.php" class="site_title"><i class="fa fa-bolt" style="color: #ffffff;"></i></i> <span>E-Arsip | PLN</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/3.png" alt="..." class="img-circle profile_img">
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
                      <li><a href="instansi.php">Data Instansi</a></li>
                      <li><a href="data-pengirim.php">Data Vendor</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i>Arsip Surat <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="arsip-surat.php">Data</a></li>
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
                    <img src="images/3.png" alt="">Administrator
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="../logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
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
    //panggil function.php untuk upload file
    include "../config/function.php";

    //uji jika klik tombol edit/hapus
    if(isset($_GET['hal']))
  {
    if($_GET['hal'] =="edit") 
    {
      //tampilkan data yang akan di edit
    $tampil = mysqli_query($koneksi, "SELECT 
                                    tbl_arsip.*,
                                    tbl_departemen.nama_departemen,
                                    tbl_pengirim_surat.nama_pengirim, tbl_pengirim_surat
                                    FROM 
                                    tbl_arsip, tbl_departemen, tbl_pengirim_surat 
                                    WHERE 
                                    tbl_arsip.id_departemen = tbl_departemen.id_departemen
                                    and tbl_arsip.id_pengirim = tbl_pengirim_surat.id_pengirim_surat and tbl_arsip.id_arsip='$_GET[id]'");


    $data = mysqli_fetch_array($tampil);
    if($data)
    {
      //jika data ditemukan, maka data di tampung ke dalam variabel
      $vno_surat= $data['no_surat'];
      $vtanggal_surat = $data['tanggal_surat'];
      $vtanggal_diterima = $data['tanggal_diterima'];
      $vperihal = $data['perihal'];
      $vno_spk = $data['no_spk'];
      $vfile = $data['file'];
    }
    }
    elseif($_GET['hal'] == 'hapus')
    {
        $hapus = mysqli_query($koneksi, "DELETE FROM tbl_arsip WHERE id_arsip='$_GET[id]'");
      if($hapus){
        echo "<script>
                    alert('Hapus Data Sukses');
                    document.location='?halaman=arsip_surat';
                    </script>";
      }
    }
    
  }

    //uji jika tombol simpan diklik
    if(isset($_POST['bsimpan']))
    {

      //pengujian apakah data akan di edit/simpan baru
      if(@$_GET['hal'] == "edit" ){
        //perintah edit data
        //ubah data

        //cek apakah user pilih file/gambar atau tidak
        if($_FILES['file']['error'] === 4){
            $file = $vfile;
        }else{
            $file = upload();
        }
        $ubah = mysqli_query($koneksi, "UPDATE tbl_arsip SET no_surat ='$_POST[no_surat]',
                                                                      tanggal_surat = '$_POST[tanggal_surat]',
                                                                      tanggal_diterima = '$_POST[tanggal_diterima]',
                                                                      perihal = '$_POST[perihal]',
                                                                      id_departemen = '$_POST[id_departemen]',
                                                                      id_pengirim = '$_POST[id_pengirim]',
                                                                      file = '$file'   

                                                                      where id_arsip = '$_GET[id]' " );

        if($ubah)
        {
            echo "<script>
                    alert('Ubah Data Sukses');
                    document.location='?halaman=arsip_surat';
                    </script>";
        }
        else
        {
          echo "<script>
                    alert('Ubah Data GAGAL!!');
                    document.location='?halaman=arsip_surat';
                    </script>";
        
        }
      }
      else
      {

        //perintah simpan data baru
        //simpan data
        $file = upload();
        $simpan = mysqli_query($koneksi, "INSERT INTO tbl_arsip (no_surat, tanggal_surat, tanggal_diterima, perihal, no_spk, file) 
        VALUES ('$_POST[no_surat]', '$_POST[tanggal_surat]', '$_POST[tanggal_diterima]', 
                '$_POST[perihal]', '$_POST[no_spk]', '$file')");


        if($simpan)
        {
          echo "<script>
          alert('Simpan Data Sukses');
          window.location.href = 'arsip-surat.php';
        </script>";
  
        }else
        {
          echo "<script>
                    alert('Simpan Data GAGAL!!');
                    document.location='arsip-surat.php';
                    </script>";
        }
      }

        
    }

    

?>


<div class="card mt-3">
<div class="card-header text-white hide" style="background-color: #2a3f54;">
     Form Tambah Data
</div>

  <div class="card-body">
  <form method="post" action="" enctype="multipart/form-data">
  <div class="form-group">
    <label for="no_surat">No. Surat</label>
    <input type="text" class="form-control" id="no_surat" name="no_surat" value="<?=@$vno_surat?>">
  </div>
  
  <div class="form-group">
    <label for="tanggal_surat">Tanggal Surat</label>
    <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" value="<?=@$vtanggal_surat?>">
  </div>

  <div class="form-group">
    <label for="tanggal_diterima">Tanggal Diterima</label>
    <input type="date" class="form-control" id="tanggal_diterima" name="tanggal_diterima" value="<?=@$vtanggal_diterima?>">
  </div>
  
  <div class="form-group">
    <label for="perihal">Perihal</label>
    <input type="text" class="form-control" id="perihal" name="perihal" value="<?=@$vperihal?>">
  </div>

  <div class="form-group">
    <label for="no_spk">no_spk</label>
    <input type="text" class="form-control" id="no_spk" name="no_spk" value="<?=@$vno_spk?>">
  </div>
  
  <div class="form-group">
    <label for="file">Pilih File</label>
    <input type="file" class="form-control" id="file" name="file" value="<?=@$vfile?>">
  </div>

  <button type="submit" name="bsimpan" class="btn btn-primary mt-3">Simpan</button>
  <a href="arsip-surat.php" class="btn btn-danger mt-3">Batal</a>

</form>
  </div>
</div>
        


                <!-- end of weather widget -->
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

    <?php
    include "../layout/footer.php";
    ?>

	
  </body>
</html>
