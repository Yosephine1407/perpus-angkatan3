<?php
include '../connection.php';

if (isset($_GET['no_peminjam'])) {
    $no_peminjam = $_GET['no_peminjam'];

    $query = mysqli_query($connection, "SELECT * FROM peminjaman LEFT JOIN anggota ON anggota.id = peminjaman.id_anggota 
    WHERE no_peminjam='$no_peminjam'");

    $data = mysqli_fetch_assoc($query);
    $response = ['data' => $data, 'message' => 'Fetch success'];
    echo json_encode($response);
}
