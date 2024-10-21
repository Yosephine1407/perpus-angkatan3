<?php
if (isset($_POST['simpan'])) {

    $id_peminjam = $_POST['id_peminjam'];
    $querypeminjaman = mysqli_query($connection, "SELECT id, no_peminjam FROM peminjaman WHERE no_peminjam = '$id_peminjam'");
    $rowpeminjaman = mysqli_fetch_assoc($querypeminjaman);
    $id_peminjam = $rowpeminjaman['id'];
    $denda = $_POST['denda'];
    if ($denda == 0) {
    } else {
        $status = 1;
    }

    // sql=structur query language / DML=data manipulation language
    // select, insert, update, delete
    $insert = mysqli_query($connection, "INSERT INTO pengembalian
    (id_peminjam, status, denda) VALUES ('$id_peminjam', '$status', '$denda')");

    $updatepeminjaman = mysqli_query($connection, "UPDATE peminjaman SET status ='Di Kembalikan' WHERE id='$id_peminjam'");


    header("location:?pg=pengembalian&tambah=berhasil");
}



$id = isset($_GET['detail']) ? $_GET['detail'] : '';
$querypeminjaman = mysqli_query(
    $connection,
    "SELECT anggota.nama_anggota, peminjaman.* FROM peminjaman LEFT JOIN anggota ON anggota.id = peminjaman.id_anggota WHERE peminjaman.id = '$id'"
);

$rowpeminjaman = mysqli_fetch_assoc($querypeminjaman);

$querydetail_peminjam = mysqli_query($connection, "SELECT buku.nama_buku, detail_peminjam.* FROM detail_peminjam LEFT JOIN buku ON buku.id = detail_peminjam.id_buku WHERE  id_peminjam ='$id'");


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($connection, "UPDATE peminjaman  SET deleted_at = 1 WHERE id='$id'");
    header('location:?pg=peminjaman&hapus=berhasil');
}


$queryBuku = mysqli_query($connection, "SELECT * FROM buku");
$queryanggota = mysqli_query($connection, "SELECT * FROM anggota");

$queryKodePnjm = mysqli_query($connection, "SELECT  * FROM peminjaman WHERE status = 'Di Pinjam'");



?>
<div class="container mt-4 mb-3">
    <fieldset class="border rounded-1 p-5 border border border-4 border border-dark">
        <div class="d-flex justify-content-start mb-3">
        </div>

        <legend class="float-none w-auto px-3"><?php echo isset($_GET['detail']) ? 'Detail' : 'Tambah' ?> Pengembalian</legend>
        <form action="" method="post">
            <div class="mb-3 row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="">No Peminjaman</label>
                        <select name="id_peminjam" id="id_peminjam" class="form-control">
                            <!-- data option ngambil dari tabel peminjaman -->
                            <option value="">No Peminjaman</option>
                            <?php while ($rowpeminjaman = mysqli_fetch_assoc($queryKodePnjm)): ?>
                                <option value="<?php echo $rowpeminjaman['no_peminjam'] ?>"> <?php echo $rowpeminjaman['no_peminjam'] ?></option>
                            <?php endwhile ?>
                        </select>
                    </div>


                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                Data Peminjaman
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="">No Peminjaman</label>
                                            <input type="text" readonly id="no_peminjam" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="">Nama Anggota</label>
                                            <input type="text" readonly id="nama_anggota" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Tanggal Peminjaman</label>
                                        <input type="text" readonly id="tgl_peminjam" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Denda</label>
                                        <input type="text" readonly id="denda" name="denda" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Tanggal Pengembalian</label>
                                        <input type="text" readonly id="tgl_pengembalian" class="form-control">
                                    </div>



                                    <!-- table data dari query dengan php -->

                                    <table id="table-pengembalian" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama Buku</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-row">
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </fieldset>
</div>