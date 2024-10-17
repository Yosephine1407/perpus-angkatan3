<?php
$anggota = mysqli_query($connection, "SELECT * FROM anggota ORDER BY id DESC");
?>

<div class="container mt-4 mb-3">
    <fieldset class="border rounded-1 p-5 border border border-4 border border-dark">
        <div class="row justify-content-start mb-3">
            <legend class="float-none w-auto px-3 mb-2">Table Anggota</legend>
            <div align="right" class="mb-3">
                <a href="?pg=tambah-anggota" class="btn btn-primary">Tambah</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered border border-dark">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Anggota</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($rowanggota = mysqli_fetch_assoc($anggota)):
                        ?>

                            <tr>
                                <td> <?php echo $no++ ?></td>
                                <td><?php echo $rowanggota['nama_anggota'] ?></td>
                                <td><?php echo $rowanggota['email'] ?></td>
                                <td><?php echo $rowanggota['telepon'] ?></td>
                                <td><?php echo $rowanggota['alamat'] ?></td>
                                <td><a href="?pg=tambah-anggota&edit=<?php echo $rowanggota['id'] ?>" class="btn btn-success btn-sm">Edit

                                    </a>
                                    <a href="?pg=tambah-anggota&delete=<?php echo $rowanggota['id'] ?>"
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