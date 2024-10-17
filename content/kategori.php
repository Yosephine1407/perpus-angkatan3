<?php
$kategori = mysqli_query($connection, "SELECT * FROM kategori ORDER BY id DESC");
?>

<div class="container mt-4 mb-3">
    <fieldset class="border rounded-1 p-5 border border border-4 border border-dark">
        <div class="row justify-content-start mb-3">
            <legend class="float-none w-auto px-3 mb-2">Data Kategori</legend>
            <div align="right" class="mb-3">
                <a href="?pg=tambah-kategori" class="btn btn-primary">Tambah</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered border border-dark">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($rowKategori = mysqli_fetch_assoc($kategori)):
                        ?>

                            <tr>
                                <td> <?php echo $no++ ?></td>
                                <td><?php echo $rowKategori['nama_kategori'] ?></td>
                                <td><a href="?pg=tambah-kategori&edit=<?php echo $rowKategori['id'] ?>" class="btn btn-success btn-sm">Edit

                                    </a>
                                    <a href="?pg=tambah-kategori&delete=<?php echo $rowKategori['id'] ?>"
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