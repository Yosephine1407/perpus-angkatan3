<?php
session_start();
if (empty($_SESSION['NAMA'])) {
  header("location:login.php?access=failed");
}
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Perpus</title>
  <link rel="stylesheet" href="assets/bootstrap/bootstrap-5.3.3/dist/css/bootstrap.min.css" />
</head>

<body>
  <div class="wrapper">
    <?php include 'navbar.php'; ?>

    <div class="content">
      <?php
      if (isset($_GET['pg'])) {
        if (file_exists('content/' . $_GET['pg'] . '.php')) {
          include 'content/' . $_GET['pg'] . '.php';
        }
      } else {
        include 'content/dashboard.php';
      }
      ?>
    </div>


    <footer class="text-center border-top fixed-bottom p-3" style="background-color: #4a5a4a">Copyright &copy; 2024 PPKD - Jakarta Pusat.</footer>
    <script src="app.js"></script>
    <script src="assets/bootstrap/bootstrap-5.3.3/dist/js/jquery-3.7.1.min.js"></script>
    <script>
      $("#id_peminjam").change(function() {
        let no_peminjam = $(this).find('option:selected').val();
        $.ajax({
          url: "ajax/getPeminjam.php?no_peminjam=" + no_peminjam,
          type: "get",
          dataType: "json",
          success: function(res) {
            $('#no_peminjam').val(res.data.no_peminjam);
            $('#tgl_peminjam').val(res.data.tgl_peminjam);
            $('#tgl_pengembalian').val(res.data.tgl_pengembalian);
            $('#nama_anggota').val(res.data.nama_anggota);
          }
        });
      });
    </script>
  </div>
</body>

</html>