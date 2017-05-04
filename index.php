<?php
    // Lampirkan db dan User
    require_once "koneksi.php";
    require_once "user.php";

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
    <link rel="stylesheet" href="dist/css/style.css" />
    <link rel="stylesheet" href="dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="dist/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="dist/css/fullcalendar.css" />
    <link rel="stylesheet" href="dist/css/matrix-style.css" />
    <link rel="stylesheet" href="dist/css/matrix-media.css" />
    <link rel="stylesheet" href="dist/css/style.css" />
    <link rel="stylesheet" href="dist/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,800" type="text/css">
  </head>

  <body>

    <nav class="navbar navbar-inverted" class="add-top-padding">
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
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>

    <!--sidebar-menu-->
    <div id="sidebar"><a href="#" class="visible-phone"><i class="fa fa-home"></i> Beranda</a>
      <ul>
        <li class="active"><a href="index.html"><i class="fa fa-home fa-fw"></i> <span>Beranda</span></a> </li>
        <li class="submenu"> <a href="#"><i class="fa fa-pencil fa-fw"></i> <span>Master</span></a>
          <ul>
            <li><a href="master/staff.html"><i class="fa fa-user fa-fw"></i> Staf</a></li>
            <li><a href="master/barang.html"><i class="fa fa-archive fa-fw"></i> Barang</a></li>
            <li><a href="master/supplier.html"><i class="fa fa-building fa-fw"></i> Supplier</a></li>
          </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="fa fa-pencil-square fa-fw"></i> <span>Transaksi</span></a>
          <ul>
            <li><a href="transaksi/isi_sp.html"><i class="fa fa-share fa-fw"></i> Isi Surat Pesan</a></li>
            <li><a href="transaksi/surat_pesan.html"><i class="fa fa-envelope fa-fw"></i> Surat Pesan</a></li>
            <li><a href="transaksi/barangkeluar.html"><i class="fa fa-shopping-cart fa-fw"></i> Isi Barang Keluar</a></li>
            <li><a href="transaksi/tandaterima.html"><i class="fa fa-reply fa-fw"></i> Tanda Terima Barang</a></li>
          </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="fa fa-files-o fa-fw"></i> <span>Laporan</span></a>
          <ul>
            <li><a href="laporan/lap_barang_keluar.html"><i class="fa fa-file fa-fw"></i> Laporan Barang Keluar</a></li>
            <li><a href="laporan/lap_barang_masuk.html"><i class="fa fa-file-text fa-fw"></i> Laporan Barang Masuk</a></li>
          </ul>
        </li>
        <li><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Keluar</span></a></li>
      </ul>
    </div>
    <!--sidebar-menu-->

    <!--main-container-part-->
    <div id="content">
      <!--breadcrumbs-->
      <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="fa fa-home"></i> Beranda</a></div>
        <h1>Beranda</h1>
        <hr>
      </div>
      <!--End-breadcrumbs-->

      <!--Action boxes-->
      <div class="container-fluid">
        <h4>Master</h4>
        <hr>
        <div class="quick-actions_homepage">
          <ul class="quick-actions">
            <li class="bg_lb span4">
              <a href="master/staff.html"> <i class="fa fa-user fa-5x"></i><br> Staf</a>
            </li>
            <li class="bg_lg span3">
              <a href="master/barang.html"> <i class="fa fa-archive fa-5x"></i><br> Barang</a>
            </li>
            <li class="bg_ly span3">
              <a href="master/supplier.html"> <i class="fa fa-building fa-5x"></i><br> Supplier</a>
            </li>
          </ul>
        </div>
        <h4>Transaksi</h4>
        <hr>
        <div class="quick-actions_homepage">
          <ul class="quick-actions">
            <li class="bg_lb span6">
              <a href="transaksi/isi_sp.html"> <i class="fa fa-share fa-4x"></i><br> Isi Surat Pesan</a>
            </li>
            <li class="bg_lg span5">
              <a href="transaksi/surat_pesan.html"> <i class="fa fa-envelope fa-4x"></i><br> Surat Pesan</a>
            </li>
            <li class="bg_ly span5">
              <a href="transaksi/barang_keluar.html"> <i class="fa fa-shopping-cart fa-4x"></i><br> Isi Barang Keluar</a>
            </li>
            <li class="bg_ly span6">
              <a href="transaksi/ttb.html"> <i class="fa fa-reply fa-4x"></i><br> Tanda Terima Barang</a>
            </li>
          </ul>
        </div>
        <h4>Laporan</h4>
        <hr>
        <div class="quick-actions_homepage">
          <ul class="quick-actions">
            <li class="bg_lb span6">
              <a href="laporan/lap_barang_keluar.html"> <i class="fa fa-file fa-4x"></i><br> Laporan Barang Keluar</a>
            </li>
            <li class="bg_lg span5">
              <a href="laporan/lap_barang_masuk.html"> <i class="fa fa-file-text fa-4x"></i><br> Laporan Barang Masuk</a>
            </li>
          </ul>
        </div>
      </div>
      <!--End-Action boxes-->
    </div>
    <!--end-main-container-part-->

    <!--Footer-part-->
    <div class="row-fluid">
      <div id="footer" class="span12">2017 &copy; Tugas APSI by <a href="http://fendi.comuv.com">KITA</a></div>
    </div>
    <!--end-Footer-part-->

    <script src="dist/js/excanvas.min.js"></script>
    <script src="dist/js/jquery.min.js"></script>
    <script src="dist/js/jquery.ui.custom.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="dist/js/jquery.flot.min.js"></script>
    <script src="dist/js/jquery.flot.resize.min.js"></script>
    <script src="dist/js/jquery.peity.min.js"></script>
    <script src="dist/js/fullcalendar.min.js"></script>
    <script src="dist/js/matrix.js"></script>
    <script src="dist/js/matrix.dashboard.js"></script>
    <script src="dist/js/matrix.interface.js"></script>
    <script src="dist/js/matrix.chat.js"></script>
    <script src="dist/js/jquery.validate.js"></script>
    <script src="dist/js/matrix.form_validation.js"></script>
    <script src="dist/js/jquery.wizard.js"></script>
    <script src="dist/js/jquery.uniform.js"></script>
    <script src="dist/js/select2.min.js"></script>
    <script src="dist/js/matrix.popover.js"></script>
    <script src="dist/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/matrix.tables.js"></script>

    <script type="text/javascript">
      // This function is called from the pop-up menus to transfer to
      // a different page. Ignore if the value returned is a null string:
      function goPage(newURL) {
        // if url is empty, skip the menu dividers and reset the menu selection to default
        if (newURL != "") {
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-") {
            resetMenu();
          }
          // else, send page to designated URL
          else {
            document.location.href = newURL;
          }
        }
      }
      // resets the menu selection upon entry to this page:
      function resetMenu() {
        document.gomenu.selector.selectedIndex = 2;
      }
    </script>
  </body>
  </html>
