<?php
if (isset($_POST['simpan'])) {
    $no_peminjam = $_POST['no_peminjam'];
    $id_anggota = $_POST['id_anggota'];
    $tgl_peminjam = $_POST['tgl_peminjam'];
    $tgl_pengembalian = $_POST['tgl_pengembalian'];
    $id_buku = $_POST['id_buku'];


    // sql=structur query language / DML=data manipulation language
    // select, insert, update, delete
    $insert = mysqli_query($connection, "INSERT INTO peminjaman
    (no_peminjam, id_anggota, tgl_peminjam, tgl_pengembalian) VALUES 
    ('$no_peminjam', '$id_anggota','$tgl_peminjam','$tgl_pengembalian')");
    $id_peminjam = mysqli_insert_id($connection);


    foreach ($id_buku as $key => $buku) {
        $id_buku = $_POST['id_buku'][$key];
        $insertDetail = mysqli_query($connection, "INSERT into detail_peminjam(id_peminjam, id_buku) VALUES ('','$id_buku')");
    }

    header("location:?pg=peminjaman&tambah=berhasil");
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
    $delete = mysqli_query($connection, "DELETE FROM peminjaman WHERE id='$id'");
    header('location:?pg=peminjaman&hapus=berhasil');
}


$queryBuku = mysqli_query($connection, "SELECT * FROM buku");
$queryanggota = mysqli_query($connection, "SELECT * FROM anggota");

$queryKodePnjm = mysqli_query($connection, "SELECT  MAX(id) AS id_pinjam FROM peminjaman");
$rowPeminjaman = mysqli_fetch_assoc($queryKodePnjm);
$id_pinjam = $rowPeminjaman['id_pinjam'];
$id_pinjam++;

$kode_pinjam = "PJM/" . date('dmy') . "/" . sprintf("%03s", $id_pinjam);

?>
<div class="container mt-4 mb-3">
    <fieldset class="border rounded-1 p-5 border border border-4 border border-dark">
        <div class="d-flex justify-content-start mb-3">
        </div>

        <legend class="float-none w-auto px-3"><?php echo isset($_GET['detail']) ? 'Detail' : 'Tambah' ?> Peminjaman</legend>
        <form action="" method="post">
            <div class="mb-3 row">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="">No Peminjaman</label>
                        <input required type="text" class="form-control" name="no_peminjam" value="<?php echo isset($_GET['detail']) ? $rowpeminjaman['no_peminjam'] : $kode_pinjam ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="">Tanggal Peminjaman</label>
                        <input required type="date" class="form-control" name="tgl_peminjam" value="<?php echo isset($_GET['detail']) ? $rowpeminjaman['tgl_peminjam'] : '' ?>" readonly>
                    </div>
                    <?php if (empty($_GET['detail'])): ?>
                        <div class="mb-3">
                            <label for="" class="form-label">Nama Buku</label>
                            <select requird name="" id="id_buku" class="form-control">
                                <?php while ($rowBuku = mysqli_fetch_assoc($queryBuku)): ?>
                                    <option value="<?php echo $rowBuku['id'] ?>">
                                        <?php echo $rowBuku['nama_buku']; ?>
                                    </option>
                                <?php endwhile ?>
                            </select>
                        </div>
                    <?php endif ?>
                </div>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="" class="form-label">Nama Anggota</label>
                        <?php if (!isset($_GET['detail'])): ?>
                            <select required name="id_anggota" class="form-control">
                                <option value="">Pilih Anggota</option>
                                <?php while ($rowAnggota = mysqli_fetch_assoc($queryanggota)): ?>
                                    <option value="<?php echo $rowAnggota['id'] ?>"> <?php echo $rowAnggota['nama_anggota']; ?>
                                    </option>
                                <?php endwhile ?>
                            </select>
                        <?php else: ?>
                            <input type="text" class="form-control" readonly value="<?php echo $rowpeminjaman['nama_anggota']; ?>">
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="">Tanggal Pengembalian</label>
                        <input required type="date" class="form-control" name="tgl_pengembalian" value="<?php echo isset($_GET['detail']) ? $rowpeminjaman['tgl_pengembalian'] : '' ?>" readonly>
                    </div>
                </div>
                <?php if (empty($_GET['detail'])): ?>
                    <div align="right" class="mb-3">
                        <button type="button" id="add-row" class="btn btn-primary">Tambah Row</button>
                    </div>
                <?php endif ?>
                <!-- table data dari query dengan php -->
                <?php if (isset($_GET['detail'])): ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Buku</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            while ($rowdetail_peminjam = mysqli_fetch_assoc($querydetail_peminjam)): ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $rowdetail_peminjam['nama_buku'] ?></td>

                                </tr>
                            <?php endwhile ?>
                        </tbody>

                    </table>
                    <!-- ini table data dari js -->
                <?php else: ?>
                    <table id="table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Buku</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-row">
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                <?php endif ?>
        </form>
    </fieldset>
</div>