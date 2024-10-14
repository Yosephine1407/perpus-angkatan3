<?php
session_start();
include 'connection.php';

$email = $_POST['email'];
$password = sha1($_POST['password']);

$queryLogin = mysqli_query($connection, "SELECT * FROM user WHERE email='$email'");
if (mysqli_num_rows($queryLogin) > 0) {
    $rowUser = mysqli_fetch_assoc($queryLogin);
    if ($rowUser['password'] == $password) {
        $_SESSION['NAMA'] = $rowUser['nama'];
        $_SESSION['ID'] = $rowUser['id'];
        header("location:index.php?login=berhasil");
    }
} else {
    header("location:index.php?error=login");
}
