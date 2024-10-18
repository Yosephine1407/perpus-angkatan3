<?php
$query = mysqli_query($connection, "SELECT anggota.nama_anggota, peminjaman.* FROM  peminjaman LEFT JOIN anggota ON anggota.id = peminjaman.id_anggota WHERE deleted_at = 0 
ORDER BY id DESC");
?>

<div class="container mt-4 mb-3">
    <fieldset class="border rounded-1 p-5 border border border-4 border border-dark">
        <div class="row justify-content-start mb-3">
            <legend class="float-none w-auto px-3 mb-2">Data Peminjaman</legend>
            <div align="right" class="mb-3">
                <a href="?pg=tambah-peminjaman" class="btn btn-primary">Tambah</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered border border-dark">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Anggota</th>
                            <th>No Peminjaman</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($peminjaman = mysqli_fetch_assoc($query)):
                        ?>

                            <tr>
                                <td> <?php echo $no++ ?></td>
                                <td><?php echo $peminjaman['nama_anggota'] ?></td>
                                <td><?php echo $peminjaman['no_peminjam'] ?></td>
                                <td><?php echo date('d-m-Y', strtotime($peminjaman['tgl_peminjam'])) ?></td>
                                <td><?php echo date('d-m-Y', strtotime($peminjaman['tgl_pengembalian'])) ?></td>
                                <td><?php echo $peminjaman['status'] ?></td>
                                <td><a href="?pg=tambah-peminjaman&detail=<?php echo $peminjaman['id'] ?>" class="btn btn-success btn-sm">Detail

                                    </a>
                                    <a href="?pg=tambah-peminjaman&delete=<?php echo $peminjaman['id'] ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">Delete</a>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>

                </table>
            </div>
    </fieldset>
</div>
</div>