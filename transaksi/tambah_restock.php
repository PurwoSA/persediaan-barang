<?php
include 'header.php';
//Ambil data
$query  = $db->prepare("SELECT MAX(kd_list) AS palingGede FROM restock");
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
// Ambil semua data dan masukkan ke variable $data
if (isset($_POST['submit'])) {
  // Simpan data yang di inputkan ke POST ke masing-masing variable dan convert semua tag HTML yang mungkin dimasukkan untuk mengindari XSS
  $tgl_list = htmlentities($_POST['tgl_list']);
  // Prepared statement untuk menambah data
  $query = $db->prepare("INSERT INTO `restock`(`kd_list`, `tgl_list`) VALUES (:kd_list, :tgl_list)");
  $query->bindParam(":kd_list", $kode);
  $query->bindParam(":tgl_list", $tgl_list);
  // Jalankan perintah SQL
  $query->execute();
  // Alihkan ke index.php
  header("location: restock.php");
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
              <a href="../transaksi/restock.php">
                <i class="fa fa-list fa-fw"></i> Daftar <i>Restock</i> Barang
              </a>
            </li>
            <li>
              <a href="../transaksi/cek_barang.php">
                <i class="fa fa-check-square fa-fw"></i> Cek Barang
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
              <a href="../laporan/lap_restock.php">
                <i class="fa fa-file-text fa-fw"></i> Laporan Daftar <i>Restock</i> Barang
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
        Daftar <i>Restock</i> Barang
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Daftar <i>Restock</i> Barang</h3>
            </div>
            <!-- /.box-header -->
            <form method=post>
              <div class="box-body">
                <div class="form-group">
                  <label for="kd_list">Kode Daftar <i>Restock</i></label>
                  <input type="text" name="kd_list" id="kd_list" class="form-control" value="<?php echo $kode ?>" readonly>
                </div>
                <div class="form-group">
                  <label>Tanggal Daftar <i>Restock</i></label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" name="tgl_list" value="<?php echo $date ?>" required="">
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
