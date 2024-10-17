<?php
$buku = mysqli_query($connection, "SELECT kategori.nama_kategori, buku. *
 FROM buku LEFT JOIN kategori ON kategori.id = buku.id_kategori ORDER BY id DESC");
?>

<div class="container mt-4 mb-3">
    <fieldset class="border rounded-1 p-5 border border border-4 border border-dark">
        <div class="row justify-content-start mb-3">
            <legend class="float-none w-auto px-3 mb-2">Data buku</legend>
            <div align="right" class="mb-3">
                <a href="?pg=tambah-buku" class="btn btn-primary">Tambah</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered border border-dark">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Nama Buku</th>
                            <th>Penerbit</th>
                            <th>Tahun Penerbit</th>
                            <th>Pengarang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($rowbuku = mysqli_fetch_assoc($buku)):
                        ?>

                            <tr>
                                <td> <?php echo $no++ ?></td>
                                <td><?php echo $rowbuku['nama_kategori'] ?></td>
                                <td><?php echo $rowbuku['nama_buku'] ?></td>
                                <td><?php echo $rowbuku['penerbit'] ?></td>
                                <td><?php echo $rowbuku['tahun_penerbit'] ?></td>
                                <td><?php echo $rowbuku['pengarang'] ?></td>
                                <td><a href="?pg=tambah-buku&edit=<?php echo $rowbuku['id'] ?>" class="btn btn-success btn-sm">Edit

                                    </a>
                                    <a href="?pg=tambah-kategori&delete=<?php echo $rowbuku['id'] ?>"
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