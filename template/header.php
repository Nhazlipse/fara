<?php
session_start();
//Mengatasi jika user langsung masuk memnggunakan link,tanpa login
if(empty($_SESSION['id_user']) or empty($_SESSION['username']))
{
  echo "<script>
            alert('Maaf, Untuk mengakses halaman ini, silahkan Login terlebih dahulu..!');
            document.location='index.php';
    </script>";
}

?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
      @media print {
      .hide{
        display:none;
      }
    }
    </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <title class="hide">E-Arsip | BPKAD</title>
  </head>
  <body>
    <!-- Awal Nav / Menu -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-success ">
      <div class="container">
        <a class="navbar-brand" href="#">E-Arsip</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="?">Beranda</a>
            </li>
            <li class="nav-item">
            <a class="nav-link "  href="?halaman=departemen">Data Departemen</a>
            </li>
            <li class="nav-item">
            <a class="nav-link "  href="?halaman=pengirim_surat">Data Pengirim Surat</a>
            </li>
            <li class="nav-item">
            <a class="nav-link"  href="?halaman=arsip_surat">Data Arsip Surat</a>
            </li>
        </ul>
        </div>
    </div>
        </div>
    
    </nav>
<!-- Akhir Nav / Menu -->

<!-- Awal Container -->
<div class="container">