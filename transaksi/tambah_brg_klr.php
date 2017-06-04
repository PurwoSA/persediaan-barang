<?php
include 'header.php';
//Ambil data
$query  = $db->prepare("SELECT MAX(kd_klr) AS palingGede FROM brg_klr");
$query1 = $db->prepare("SELECT nip, nm_staf FROM staf");
//Jalankan perintah SQL
$query->execute();
if ($query->rowCount() == 0) {
  //Tidak ada hasil
  $kode = 1;
} else {
  // ID Ditemukan, Ambil data
  $data = $query->fetch();
  $kode = $data['palingGede'] + 1;
}
$query1->execute();
// Ambil semua data dan masukkan ke variable $data
$data1 = $query1->fetchAll();
if (isset($_POST['submit'])) {
  // Simpan data yang di inputkan ke POST ke masing-masing variable dan convert semua tag HTML yang mungkin dimasukkan untuk mengindari XSS
  $wkt_klr = htmlentities($_POST['wkt_klr']);
  $tgl_klr = htmlentities($_POST['tgl_klr']);
  // Prepared statement untuk menambah data
  $query = $db->prepare("INSERT INTO `brg_klr`(`kd_klr`, `nip`, `wkt_klr`, `tgl_klr`) VALUES (:kd_klr, :nip, :wkt_klr, :tgl_klr)");
  $query->bindParam(":kd_klr", $kode);
  $query->bindParam(":nip", $currentUser['nip']);
  $query->bindParam(":wkt_klr", $wkt_klr);
  $query->bindParam(":tgl_klr", $tgl_klr);
  // Jalankan perintah SQL
  $query->execute();
  // Alihkan ke index.php
  header("location: brg_klr.php");
}
?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li>
          <a href="../index.php">
            <i class="fa fa-home"></i>
            <span>Beranda</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="../master/staf.php">
                <i class="fa fa-users fa-fw"></i> Staf
              </a>
            </li>
            <li>
              <a href="../master/barang.php">
                <i class="fa fa-archive fa-fw"></i> Barang
              </a>
            </li>
            <li>
              <a href="../master/supplier.php">
                <i class="fa fa-building fa-fw"></i> Supplier
              </a>
            </li>
          </ul>
        </li>
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="../transaksi/sp.php">
                <i class="fa fa-envelope fa-fw"></i> Surat Pesan
              </a>
            </li>
            <li>
              <a href="../transaksi/isi_sp.php">
                <i class="fa fa-pencil-square-o fa-fw"></i> Isi Surat Pesan
              </a>
            </li>
            <li>
              <a href="../transaksi/nota.php">
                <i class="fa fa-reply fa-fw"></i> Nota
              </a>
            </li>
            <li>
              <a href="../transaksi/isi_nota.php">
                <i class="fa fa-list fa-fw"></i> Isi Nota
              </a>
            </li>
            <li class="active">
              <a href="../transaksi/brg_klr.php">
                <i class="fa fa-shopping-cart fa-fw"></i> Barang Keluar
              </a>
            </li>
            <li>
              <a href="../transaksi/isi_brg_klr.php">
                <i class="fa fa-cart-plus fa-fw"></i> Isi Barang Keluar
              </a>
            </li>
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
            <li>
              <a href="../laporan/lap_barang_keluar.php">
                <i class="fa fa-file fa-fw"></i> Laporan Barang Keluar
              </a>
            </li>
            <li>
              <a href="../laporan/lap_barang_masuk.php">
                <i class="fa fa-file-text fa-fw"></i> Laporan Barang Masuk
              </a>
            </li>
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
        Barang Keluar
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Barang Keluar</h3>
            </div>
            <!-- /.box-header -->
            <form method=post>
              <div class="box-body">
                <div class="form-group">
                  <label for="kd_klr">Nomor Barang Keluar</label>
                  <input type="text" name="kd_klr" id="kd_klr" class="form-control" value="<?php echo $kode ?>" readonly>
                </div>
                <div class="bootstrap-timepicker">
                  <div class="form-group">
                    <label>Waktu Keluar</label>
                    <div class="input-group">
                      <input type="text" class="form-control timepicker" name="wkt_klr" value="<?php echo $time ?>" required="">
                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>
                <div class="form-group">
                  <label>Tanggal Barang Keluar</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" name="tgl_klr" value="<?php echo $date ?>" required="">
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-flat" name="submit">Tambah</button>
                <button type="reset" class="btn btn-default btn-flat" name="reset">Batal</button>
              </div>
            </form>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'footer.php'; ?>
