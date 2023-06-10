<?php

//persiapan function untuk upload file/foto
function upload()

{
    //Deklarasikan variabel kebutuhan
    $namafile = $_FILES['file']['name'];
    $ukuranfile = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $tmpname = $_FILES['file']['tmp_name'];

    //Cek apakah yang diupload adalah file/gambar
    $eksfilevalid = ['jpg', 'jpeg', 'png', 'pdf', 'docx'];
    $eksfile = explode('.', $namafile);
    $eksfile = strtolower(end($eksfile));

    if(!in_array($eksfile, $eksfilevalid)){
        echo "<script> alert('Yang anda Upload bukan Gambar/File PDF..!') </script>";
        return false;
    }
    //cek jika ukuran file terlalu besar
    if($ukuranfile > 1000000){
        echo "<script> alert('Ukuran file anda terlalu besar!') </script>";
        return false;
    }
    //Jika lolos pengecekan file siap di upload
    //generate nama file baru

    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $eksfile;

    move_uploaded_file($tmpname, 'file/'.$namafilebaru);
    return $namafilebaru;
}
?>