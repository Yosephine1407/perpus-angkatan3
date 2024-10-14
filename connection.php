<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "angkatan3_belajar";

$connection = mysqli_connect($hostname, $username, $password, $dbname);
if (!$connection) {
    echo "Koneksi Gagal";
}
