<?php
include 'header.php';
//Ambil data
$query1 = $db->prepare("SELECT * FROM restock");
$query2 = $db->prepare("SELECT kd_brg, nm_brg, stok FROM barang");
//Jalankan perintah SQL
$query1->execute();
$query2->execute();
// Ambil semua data dan masukkan ke variable $data
$data1 = $query1->fetchAll();
$data2 = $query2->fetchAll();
if(isset($_POST['submit'])){
  // Simpan data yang di inputkan ke POST ke masing-masing variable dan convert semua tag HTML yang mungkin dimasukkan untuk mengindari XSS
  $kd_list  = htmlentities($_POST['kd_list']);
  $kd_brg  = htmlentities($_POST['kd_brg']);
  $jml_restock = htmlentities($_POST['jml_restock']);
  // Menambah jumlah stok
  $tambah = $db->prepare("SELECT `stok` FROM `barang` WHERE `kd_brg` = :kd_brg");
  $tambah->bindParam(":kd_brg", $kd_brg);
  $tambah->execute();
  $data3 = $tambah->fetch();
  $stok  = $data3['stok'];
  // Prepared statement untuk menambah data
  $query = $db->prepare("INSERT INTO `cek`(`kd_brg`, `kd_list`, `jml_restock`) VALUES (:kd_brg, :kd_list, :jml_restock)");
  $query->bindParam(":kd_list", $kd_list);
  $query->bindParam(":kd_brg", $kd_brg);
  $query->bindParam(":jml_restock", $jml_restock);
  // Menambah jumlah stok
  $stok   = $stok + $jml_restock;
  $query2 = $db->prepare("UPDATE `barang` SET `stok` = :stok WHERE `kd_brg` = :kd_brg");
  $query2->bindParam(":stok", $stok);
  $query2->bindParam(":kd_brg", $kd_brg);
  // Jalankan perintah SQL
  $query->execute();
  $query2->execute();
  // Alihkan ke index.php
  header("location: cek_barang.php");
}
?>
  <!-- Let side column. contains the logo and sidebar -->
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
              <a href="../master/restock.php">
                <i class="fa fa-list fa-fw"></i> Daftar <i>Restock</i> Barang
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
              <a href="../transaksi/barang.php">
                <i class="fa fa-archive fa-fw"></i> Barang
              </a>
            </li>
            <li class="active">
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
        Cek Barang
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Cek Barang</h3>
            </div>
            <!-- /.box-header -->
            <form method=post>
              <div class="box-body">
                <div class="form-group">
                  <label for="kd_list">Kode dan Tanggal <i>Restock</i></label>
                  <!-- Perulangan Untuk Menampilkan Semua Data yang ada di Variable Data -->
                  <select class="form-control select2" style="width: 100%;" name="kd_list" id="kd_list" required="">
                    <option value=""> </option>
                    <?php foreach ($data1 as $value): ?>
                      <option value="<?php echo $value['kd_list'] ?>"><?php echo $value['kd_list'] ?> - <?php echo $value['tgl_list']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="kd_brg">Kode Barang dan Nama Barang</label>
                  <!-- Perulangan Untuk Menampilkan Semua Data yang ada di Variable Data -->
                  <select class="form-control select2" style="width: 100%;" name="kd_brg" id="kd_brg" required="">
                    <option value=""> </option>
                    <?php foreach ($data2 as $value): ?>
                      <option value="<?php echo $value['kd_brg'] ?>"><?php echo $value['kd_brg'] ?> - <?php echo $value['nm_brg']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="jml_restock">Jumlah <i>Restock</i></label>
                  <input type="number" name="jml_restock" id="jml_restock" class="form-control" value="" required="">
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
