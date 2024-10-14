<?php
session_start();
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
    <footer class="text-center border-top fixed-bottom p-3">Copyright &copy; 2024 PPKD - Jakarta Pusat.</footer>
  </div>
</body>

</html>