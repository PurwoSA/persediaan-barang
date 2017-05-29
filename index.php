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
  <html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Amanda Reload | Beranda</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>R</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Amanda</b>Reload</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li><a href="#"><i class="fa fa-user-circle"></i> <?php echo $currentUser['nm_staf'] ?></a></li>
              <li><a href="logout.php"><i class="fa fa-sign-out"></i> Keluar</a></li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="active"><a href="index.php"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i> <span>Master</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="master/staf.php"><i class="fa fa-users"></i> Staf</a></li>
                <li><a href="master/barang.php"><i class="fa fa-archive"></i> Barang</a></li>
                <li><a href="master/supplier.php"><i class="fa fa-building"></i> Supplier</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-money"></i>
                <span>Transaksi</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="transaksi/sp.php"><i class="fa fa-envelope"></i> Surat Pesan</a></li>
                <li><a href="transaksi/isi_sp.php"><i class="fa fa-pencil-square-o"></i> Isi Surat Pesan</a></li>
                <li><a href="transaksi/nota.php"><i class="fa fa-reply"></i> Nota</a></li>
                <li><a href="transaksi/isi_nota.php"><i class="fa fa-list"></i> Isi Nota</a></li>
                <li><a href="transaksi/brg_klr.php"><i class="fa fa-shopping-cart"></i> Barang Keluar</a></li>
                <li><a href="transaksi/isi_brg_klr.php"><i class="fa fa-cart-plus"></i> Isi Barang Keluar</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Laporan</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="laporan/lap_barang_keluar.php"><i class="fa fa-file"></i> Laporan Barang Keluar</a></li>
                <li><a href="laporan/lap_barang_masuk.php"><i class="fa fa-file-text"></i> Laporan Barang Masuk</a></li>
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Beranda
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-book"></i> Master</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-lg-4 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h4>Staf</h4><br>
                    </div>
                    <div class="icon">
                      <i class="fa fa-users"></i>
                    </div>
                    <a href="master/staf.php" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h4>Barang</h4><br>
                    </div>
                    <div class="icon">
                      <i class="fa fa-archive"></i>
                    </div>
                    <a href="master/barang.php" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-yellow">
                    <div class="inner">
                      <h4>Supplier</h4><br>
                    </div>
                    <div class="icon">
                      <i class="fa fa-building"></i>
                    </div>
                    <a href="master/supplier.php" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-money"></i> Transaksi</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-lg-4 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-red">
                    <div class="inner">
                      <h4>Surat Pesan</h4><br>
                    </div>
                    <div class="icon">
                      <i class="fa fa-envelope"></i>
                    </div>
                    <a href="transaksi/sp.php" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-gray">
                    <div class="inner">
                      <h4>Isi Surat Pesan</h4><br>
                    </div>
                    <div class="icon">
                      <i class="fa fa-pencil-square-o"></i>
                    </div>
                    <a href="transaksi/isi_sp.php" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-navy">
                    <div class="inner">
                      <h4>Nota</h4><br>
                    </div>
                    <div class="icon">
                      <i class="fa fa-reply"></i>
                    </div>
                    <a href="transaksi/nota.php" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-teal">
                    <div class="inner">
                      <h4>Isi Nota</h4><br>
                    </div>
                    <div class="icon">
                      <i class="fa fa-list"></i>
                    </div>
                    <a href="transaksi/isi_nota.php" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-purple">
                    <div class="inner">
                      <h4>Barang Keluar</h4><br>
                    </div>
                    <div class="icon">
                      <i class="fa fa-shopping-cart"></i>
                    </div>
                    <a href="transaksi/brg_klr.php" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-orange">
                    <div class="inner">
                      <h4>Isi Barang Keluar</h4><br>
                    </div>
                    <div class="icon">
                      <i class="fa fa-cart-plus"></i>
                    </div>
                    <a href="transaksi/isi_brg_klr.php" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
              </div>
            </div>
          </div>

          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-files-o"></i> Laporan</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-lg-6 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-maroon">
                    <div class="inner">
                      <h4>Laporan Barang Keluar</h4><br>
                    </div>
                    <div class="icon">
                      <i class="fa fa-file"></i>
                    </div>
                    <a href="laporan/lap_barang_keluar.php" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-black">
                    <div class="inner">
                      <h4>Laporan Barang Masuk</h4><br>
                    </div>
                    <div class="icon">
                      <i class="fa fa-file-text"></i>
                    </div>
                    <a href="laporan/lap_barang_masuk.php" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.8
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <!-- /.control-sidebar-menu -->
          </div>
          <!-- /.tab-pane -->
        </div>
      </aside>
      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
  </body>

  </html>
