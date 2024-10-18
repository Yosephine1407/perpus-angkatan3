<?php
$query = mysqli_query($connection, "SELECT peminjaman.no_peminjam, pengembalian.* FROM pengembalian LEFT JOIN peminjaman ON peminjaman.id = pengembalian.id_peminjam ORDER BY id DESC");
?>

<div class="container mt-4 mb-3">
    <fieldset class="border rounded-1 p-5 border border border-4 border border-dark">
        <div class="row justify-content-start mb-3">
            <legend class="float-none w-auto px-3 mb-2">Data Pengembalian</legend>
            <div align="right" class="mb-3">
                <a href="?pg=tambah-pengembalian" class="btn btn-primary">Tambah</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered border border-dark">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Peminjaman</th>
                            <th>Status</th>
                            <th>Denda</th>
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
                                <td><?php echo $pengembalian['no_peminjam'] ?></td>
                                <td><?php echo $pengembalian['status'] ?></td>
                                <td><?php echo $pengembalian['status'] ?></td>
                                <td><?php echo $pengembalian['denda'] ?></td>



                                <a href="?pg=tambah-pengembalian&delete=<?php echo $pengembalian['id'] ?>"
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