<?php
session_start();
include "./production/koneksi.php";

//contoh login sederhana,bisa dikembangkan lagi

//pasword diamankan dengan enkripsi kriptografi MD5
@$pass = md5($_POST['password']);

//mysqli_escape_string fungsinya untuk mengamankan karakter aneh yang diinputkan user,seperti sql injection
@$username = mysqli_escape_string($koneksi, $_POST['username']);
@$password = mysqli_escape_string($koneksi, $pass);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        // Jika captcha response tidak kosong
        $captcha = $_POST['g-recaptcha-response'];
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret' => '6LfHIrIkAAAAACdbYQDpJocuyEAIgSBPSC1lrWaI',
            'response' => $captcha
        ];
        $options = [
            'http' => [
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $response = json_decode($result);

        if ($response->success) {
            $login = mysqli_query($koneksi, "SELECT * from tbl_user WHERE username='$username' and password = '$password'");
            $data = mysqli_fetch_array($login);
            
            if ($data) {
                $_SESSION['id_user'] = $data['id_user'];
                $_SESSION['username'] = $data['username'];
                header('location:./production/dashboard.php');
            } else {
                echo "<script>
                    alert('Maaf, Login GAGAL, pastikan username dan password anda Benar..!');
                    document.location='index.php';
                </script>";
            }
        } else {
            // Jika captcha tidak valid
            echo "<script>
                alert('Captcha tidak valid');
                document.location='index.php';
            </script>";
        }
    } else {
        // Jika captcha response kosong
        echo "<script>
            alert('Silahkan isi captcha');
            document.location='index.php';
        </script>";
    }
}
?>
