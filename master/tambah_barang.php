<?php
include 'header.php';
//Ambil data
$query  = $db->prepare("SELECT MAX(kd_brg) AS palingGede FROM barang");
$query1 = $db->prepare("SELECT nip FROM staf");
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
if(isset($_POST['submit'])){
  // Simpan data yang di inputkan ke POST ke masing-masing variable dan convert semua tag HTML yang mungkin dimasukkan untuk mengindari XSS
  $nm_brg         = htmlentities($_POST['nm_brg']);
  $stok           = htmlentities($_POST['stok']);
  $satuan         = htmlentities($_POST['satuan']);
  $jenis          = htmlentities($_POST['jenis']);
  $tgl_msk        = htmlentities($_POST['tgl_msk']);
  $tgl_kadaluarsa = htmlentities($_POST['tgl_kadaluarsa']);
  // Prepared statement untuk menambah data
  $query = $db->prepare("INSERT INTO barang(kd_brg, nip, nm_brg, stok, satuan, jenis, tgl_msk, tgl_kadaluarsa) VALUES (:kd_brg, :nip, :nm_brg, :stok, :satuan, :jenis, :tgl_msk, :tgl_kadaluarsa)");
  $query->bindParam(":kd_brg", $kode);
  $query->bindParam(":nip", $currentUser['nip']);
  $query->bindParam(":nm_brg", $nm_brg);
  $query->bindParam(":stok", $stok);
  $query->bindParam(":satuan", $satuan);
  $query->bindParam(":jenis", $jenis);
  $query->bindParam(":tgl_msk", $tgl_msk);
  $query->bindParam(":tgl_kadaluarsa", $tgl_kadaluarsa);
  // Jalankan perintah SQL
  $query->execute();
  // Alihkan ke index.php
  header("location: barang.php");
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
        <li class="treeview active">
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
            <li class="active">
              <a href="../master/barang.php">
                <i class="fa fa-archive fa-fw"></i> Barang
              </a>
            </li>
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
            <li>
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
        Barang
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Barang</h3>
            </div>
            <!-- /.box-header -->
            <form method=post>
              <div class="box-body">
                <div class="form-group">
                  <label for="nm_brg">Kode Barang</label>
                  <input type="text" name="kd_brg" id="kd_brg" class="form-control" value="<?php echo $kode ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="nm_brg">Nama Barang</label>
                  <input type="text" name="nm_brg" id="nm_brg" class="form-control" value="" required="">
                </div>
                <div class="form-group">
                  <label for="satuan">Stok Barang</label>
                  <input type="number" name="stok" id="stok" class="form-control" value="" required="">
                </div>
                <div class="form-group">
                  <label for="satuan">Satuan Barang</label>
                  <input type="text" name="satuan" id="satuan" class="form-control" value="">
                </div>
                <div class="form-group">
                  <label for="jenis">Jenis Barang</label>
                  <select class="form-control select2" style="width: 100%;" name="jenis" id="jenis" required="">
                    <option value=""> </option>
                    <option value="Buah">Buah</option>
                    <option value="Gula">Gula</option>
                    <option value="Pengembang">Pengembang</option>
                    <option value="Perisa">Perisa</option>
                    <option value="Pewarna">Pewarna</option>
                    <option value="Sagu">Sagu</option>
                    <option value="Telur">Telur</option>
                    <option value="Tepung kanji">Tepung kanji</option>
                    <option value="Tepung terigu">Tepung terigu</option>
                    <option value="Lainnya">Lainnya</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="tgl_msk">Tanggal Masuk</label>
                  <input type="date" name="tgl_msk" id="tgl_msk" class="form-control" value="" required="">
                </div>
                <div class="form-group">
                  <label for="tgl_kadaluarsa">Tanggal Kadaluarsa</label>
                  <input type="date" name="tgl_kadaluarsa" id="tgl_kadaluarsa" class="form-control" value="" required="">
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
