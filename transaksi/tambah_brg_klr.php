<?php
include 'header.php';

//Ambil data
$query  = $db->prepare("SELECT MAX(no_klr) AS palingGede FROM barang_klr");
$query1 = $db->prepare("SELECT nip, nm_staf FROM staf");
$query2 = $db->prepare("SELECT kd_brg, nm_brg, stok FROM barang");
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
$query2->execute();
// Ambil semua data dan masukkan ke variable $data
$data1 = $query1->fetchAll();
$data2 = $query2->fetchAll();

if(isset($_POST['submit'])){
    // Simpan data yang di inputkan ke POST ke masing-masing variable dan convert semua tag HTML yang mungkin dimasukkan untuk mengindari XSS
    $kd_brg  = htmlentities($_POST['kd_brg']);
    $jml_klr = htmlentities($_POST['jml_klr']);
    $wkt_klr = htmlentities($_POST['wkt_klr']);
    $tgl_klr = htmlentities($_POST['tgl_klr']);

    $ambil = $db->prepare("SELECT `stok` FROM `barang` WHERE `kd_brg` = :kd_brg");
    $ambil->bindParam(":kd_brg", $kd_brg);
    $ambil->execute();
    $data3 = $ambil->fetch();
    $stok = $data3['stok'];
    if ($jml_klr <= $stok) {
      // Prepared statement untuk menambah data
      $query = $db->prepare("INSERT INTO `barang_klr`(`no_klr`, `nip`, `kd_brg`, `jml_klr`, `wkt_klr`, `tgl_klr`) VALUES (:no_klr, :nip, :kd_brg, :jml_klr, :wkt_klr, :tgl_klr)");
      $query->bindParam(":no_klr", $kode);
      $query->bindParam(":nip", $currentUser['nip']);
      $query->bindParam(":kd_brg", $kd_brg);
      $query->bindParam(":jml_klr", $jml_klr);
      $query->bindParam(":wkt_klr", $wkt_klr);
      $query->bindParam(":tgl_klr", $tgl_klr);
      // Mengurangi jumlah stok
      $stok = $stok - $jml_klr;
      $query2 = $db->prepare("UPDATE `barang` SET `stok` = :stok WHERE `kd_brg` = :kd_brg");
      $query2->bindParam(":stok", $stok);
      $query2->bindParam(":kd_brg", $kd_brg);
      // Jalankan perintah SQL
      $query->execute();
      $query2->execute();
      // Alihkan ke index.php
      header("location: brg_klr.php");
    } else {
      header("location: tambah_brg_klr.php");
    }
}
?>
    <!-- Let side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li><a href="../index.php"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-book"></i> <span>Master</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="../master/staf.php"><i class="fa fa-users fa-fw"></i> Staf</a></li>
                        <li><a href="../master/barang.php"><i class="fa fa-archive fa-fw"></i> Barang</a></li>
                        <li><a href="../master/supplier.php"><i class="fa fa-building fa-fw"></i> Supplier</a></li>
                    </ul>
                </li>
                <li class="treeview active">
                    <a href="#">
                        <i class="fa fa-money"></i>
                        <span>Transaksi</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="../transaksi/brg_klr.php"><i class="fa fa-pencil-square-o fa-fw"></i> Isi Surat Pesan</a></li>
                        <li><a href="../transaksi/surat_pesan.php"><i class="fa fa-envelope fa-fw"></i> Surat Pesan</a></li>
                        <li class="active"><a href="../transaksi/brg_klr.php"><i class="fa fa-shopping-cart fa-fw"></i> Barang Keluar</a></li>
                        <li><a href="../transaksi/ttb.php"><i class="fa fa-reply fa-fw"></i> Tanda Terima Barang</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span>Laporan</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="../laporan/lap_barang_keluar.php"><i class="fa fa-file fa-fw"></i> Laporan Barang Keluar</a></li>
                        <li><a href="../laporan/lap_barang_masuk.php"><i class="fa fa-file-text fa-fw"></i> Laporan Barang Masuk</a></li>
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
                                    <label for="no_klr">Nomor Barang Keluar</label>
                                    <input type="text" name="no_klr" id="no_klr" class="form-control" value="<?php echo $kode ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="no_sp">Kode Barang dan Nama Barang</label>
                                    <!-- Perulangan Untuk Menampilkan Semua Data yang ada di Variable Data -->
                                    <select class="form-control select2" style="width: 100%;" name="kd_brg" id="kd_brg" required="">
                                        <option value=""> </option>
                                        <?php foreach ($data2 as $value): ?>
                                        <option value="<?php echo $value['kd_brg'] ?>"><?php echo $value['kd_brg'] ?> - <?php echo $value['nm_brg']; ?> - <?php echo $value['stok']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jml_klr">Jumlah Keluar</label>
                                    <input type="number" name="jml_klr" id="jml_klr" class="form-control" value="" required="">
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
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary btn-flat" name="submit">Tambah</button>
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
