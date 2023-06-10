<?php
require_once 'koneksi.php';

// hapus data pengungjung
$id = $_GET['id_arsip'];
$sql = "DELETE FROM tbl_arsip WHERE id_arsip = $id";
$koneksi->query($sql);

if ($koneksi) {
    header("location:arsip-surat.php");
} else {
    // Notification Using Script
    echo "<script>alert('Data Gagal Diupdate');window.location='arsip-surat.php';</script>";
}
?>

