<?php
include '../connection.php';

if (isset($_GET['no_peminjam'])) {
    $no_peminjam = $_GET['no_peminjam'];

    $query = mysqli_query($connection, "SELECT anggota.nama_anggota, peminjaman.* FROM peminjaman LEFT JOIN anggota on anggota.id  WHERE no_peminjam = '$no_peminjam'");

    $data = mysqli_fetch_assoc($query);
    $id_peminjam = $data['id'];
    $queryDetail = mysqli_query($connection, "SELECT * FROM detail_peminjam LEFT JOIN buku ON buku.id = detail_peminjam.id_buku WHERE id_peminjam='$id_peminjam'");

    $dataDetail = [];
    while ($rowDetail = mysqli_fetch_assoc($queryDetail)) {
        $dataDetail[] = $rowDetail;
    }

    $response = ['data' => $data, 'detail' => $dataDetail];
    echo json_encode($response);
}
