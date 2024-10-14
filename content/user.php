<?php
$user = mysqli_query($connection, "SELECT * FROM user ORDER BY id DESC");
?>

<div class="container mt-4 mb-3">
    <fieldset class="border rounded-1 p-5 border border border-4 border border-dark">
        <div class="row justify-content-start mb-3">
            <legend class="float-none w-auto px-3 mb-2">Table Anggota</legend>
            <div align="right" class="mb-3">
                <a href="?pg=tambah-user" class="btn btn-primary">Tambah</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered border border-dark">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Telepon</th>
                            <th>Nama</th>
                            <th> Email</th>
                            <th> Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($rowUser = mysqli_fetch_assoc($user)):
                        ?>

                            <tr>
                                <td> <?php echo $no++ ?></td>
                                <td><?php echo $rowUser['telepon'] ?></td>
                                <td><?php echo $rowUser['nama'] ?></td>
                                <td><?php echo $rowUser['email'] ?></td>
                                <td><?php echo $rowUser['jenis_kelamin'] ?></td>
                                <td><a href="?pg=tambah-user&edit=<?php echo $rowUser['id'] ?>" class="btn btn-success btn-sm">Edit

                                    </a>
                                    <a href="?pg=tambah-user&delete=<?php echo $rowUser['id'] ?>"
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