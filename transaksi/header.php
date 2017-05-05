<?php
    // Lampirkan db dan User
    require_once "../koneksi.php";
    require_once "../user.php";

    // Buat object user
    $user = new User($db);

    // Jika belum login
    if (!$user->isLoggedIn()) {
        header("location: login.php"); //Redirect ke halaman login
    }

    // Ambil data user saat ini
    $currentUser = $user->getUser();

 ?>
  <!DOCTYPE html>
  <html lang="id">

  <head>
    <title>Amanda Reload</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../dist/css/bootstrap-responsive.min.css" />
  <link rel="stylesheet" href="../dist/css/uniform.css" />
  <link rel="stylesheet" href="../dist/css/select2.css" />
  <link rel="stylesheet" href="../dist/css/matrix-style.css" />
  <link rel="stylesheet" href="../dist/css/matrix-media.css" />
  <link rel="stylesheet" href="../dist/css/style.css" />
  <link href="../dist/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet" type="text/css">
  </head>

  <body>

    <nav class="navbar navbar-inverted">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Amanda Reload</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><i class="fa fa-user-circle"></i> <?php echo $currentUser['nm_staf'] ?></a></li>
        <li><a href="logout.php"><i class="fa fa-sign-out"></i> Keluar</a></li>
      </ul>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>