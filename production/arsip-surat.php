<?php 
// Validasi Login agar file tidak dapat diakses sebelum melakukan Login Terlebih dahulu
session_start();
if (!isset($_SESSION['username'])) {
    header("location:../index.php");
}


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
                      <li><a href="data-pengirim.php">Data Pengirim Surat</a></li>
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
          
          
        <style>
  .inverted-hide{
    display: none;
  }

  @media print {
  .hide{
    display:none;
  }

  .inverted-hide{
    display: block;
  }

  .judul{
    border-bottom: 2px solid black;
  }

  .judul_img{
  height:100px;
  width:90.06578826904297px;
  left:60px;
  top:70px;
  position:absolute;
  }

  .judul_text{
  color:#000000;
  text-align:center;
  /* vertical-align:text-top; */
  /* font-size:20px; */
  font-family:Inter;
  /* line-height:auto; */
  border-style:hidden;
  outline:none;
  /* left:221px;
  top:34px; */
  /* position:absolute; */
  width:75%;
  /* margin-bottom: 50px;
  margin-left: 150px; */
  margin: 0 0 25px 140px; 
  }

  .judul_text p{
    font-size: 14px;
    font-weight: 100; 
  }
}
</style>
<div class="judul">
<p class="inverted-hide">
  <img id='judul_img' class='judul_img' src='data:image/png;base64,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'/></img>
</p>  
  <div id='rectangle2' class='rectangle2'></div>
  <div id='judul_text' class='judul_text'>
  </div>
</div>
  <h6 class="inverted-hide my-3" style="text-align: center;">Laporan Data Arsip Surat</h6>
<div class="card mt-3">
<div class="card-header text-white hide" style="background-color: #2a3f54;">
     Data Arsip Surat
</div>

  <div class="card-body">
  <a href="tambah-data.php" class="btn btn-primary mb-3 hide">Tambah Data</a>

    <!-- <table class="table table-borderd table-hovered table-striped "> -->
 
    <!-- <a href="#" onclick="window.print();" class="btn btn-success mb-3 hide" >Cetak Data</a> -->

    <a href=""></a>
    <!-- <table class="table table-borderd table-hovered table-striped"> -->

    <table class="table table-borderd table-hovered table-striped">
        <tr>
            <th>No</th>
            <th>No RKS</th>
            <th>Tanggal</th>
            <th>No Pekerjaan</th>
            <th>No SPK</th>
            <th>Tanggal SPK</th>
            <th class="hide">File</th>
            <th class="hide">Aksi</th>
        
        </tr>
        <?php

            $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_arsip");

            $no = 1;
            while($data = mysqli_fetch_array($tampil)) :
        ?>
        <tr>
            <td><?=$no++?></td>
            <td><?=$data['no_surat']?></td>
            <td><?=$data['tanggal_surat']?></td>
            <td><?=$data['perihal']?></td>
            <td><?=$data['no_spk']?></td>
            <td><?=$data['tanggal_diterima']?>
            <td class="hide">
              <?php
                //uji apakah file nya ada atau tidak 
                if(empty($data['file'])){
                  echo " - ";
                }else{
                  ?>
                <a href="./file/<?=$data['file']?>" target="$_blank"> Lihat File </a>
              <?php
              
               }
              ?>
            </td>

            
            <td class="hide">
            <a href="edit-data.php?id_arsip=<?= $data['id_arsip'] ?>"
        class="btn btn-warning btn-sm d-sm-inline-block mb-3 mb-sm-1"><i
            class="fa fa-edit"></i>Edit</a>
            
              <a href="hapus-data.php?id_arsip=<?= $data['id_arsip'] ?>"
        class="btn btn-danger btn-sm d-sm-inline-block mb-3 mb-sm-1"
        onclick="return confirm('Yakin ingin menghapus data ini?')"><i
            class="fa fa-trash"></i>Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

                                    
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
