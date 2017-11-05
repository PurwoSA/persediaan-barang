<?php
include 'header.php';
//Ambil data
$query  = $db->prepare("SELECT MAX(kd_ubah) AS palingGede FROM ubah_kondisi");
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
  $wkt_ubah = htmlentities($_POST['wkt_ubah']);
  $tgl_ubah = htmlentities($_POST['tgl_ubah']);
  // Prepared statement untuk menambah data
  $query = $db->prepare("INSERT INTO `ubah_kondisi`(`kd_ubah`, `nip`, `wkt_ubah`, `tgl_ubah`) VALUES (:kd_ubah, :nip, :wkt_ubah, :tgl_ubah)");
  $query->bindParam(":kd_ubah", $kode);
  $query->bindParam(":nip", $currentUser['nip']);
  $query->bindParam(":wkt_ubah", $wkt_ubah);
  $query->bindParam(":tgl_ubah", $tgl_ubah);
  // Jalankan perintah SQL
  $query->execute();
  // Alihkan ke index.php
  header("location: ubah_kondisi.php");
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
            <li class="active">
              <a href="../transaksi/ubah_kondisi.php">
                <i class="fa fa-shopping-cart fa-fw"></i> Ubah Kondisi Barang
              </a>
            </li>
            <li>
              <a href="../transaksi/isi_ubah_kondisi.php">
                <i class="fa fa-cart-plus fa-fw"></i> Isi Ubah Kondisi Barang
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
              <a href="../laporan/lap_ubah_kondisi.php">
                <i class="fa fa-file fa-fw"></i> Laporan Ubah Kondisi Barang
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
        Ubah Kondisi Barang
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Ubah Kondisi Barang</h3>
            </div>
            <!-- /.box-header -->
            <form method=post>
              <div class="box-body">
                <div class="form-group">
                  <label for="kd_ubah">Nomor Ubah Kondisi Barang</label>
                  <input type="text" name="kd_ubah" id="kd_ubah" class="form-control" value="<?php echo $kode ?>" readonly>
                </div>
                <div class="bootstrap-timepicker">
                  <div class="form-group">
                    <label>Waktu Keluar</label>
                    <div class="input-group">
                      <input type="text" class="form-control timepicker" name="wkt_ubah" value="<?php echo $time ?>" required="">
                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>
                <div class="form-group">
                  <label>Tanggal Ubah Barang</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" name="tgl_ubah" value="<?php echo $date ?>" required="">
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-flat" name="submit"><i class="fa fa-plus-circle"></i> Tambah</button>
                <button type="reset" class="btn btn-default btn-flat" name="reset"><i class="fa fa-repeat"></i> Batal</button>
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
