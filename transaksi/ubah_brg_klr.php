<?php
include 'header.php';

if(!isset($_GET['id'])){
    die("Error: ID Tidak Dimasukkan");
}

//Ambil data
$query  = $db->prepare("SELECT * FROM staf x, barang y, barang_klr z WHERE z.no_klr = :no_klr AND x.nip = z.nip AND y.kd_brg = z.kd_brg");
$query1 = $db->prepare("SELECT nip, nm_staf FROM staf");
$query2 = $db->prepare("SELECT kd_brg, nm_brg FROM barang");
$query->bindParam(":no_klr", $_GET['id']);
//Jalankan perintah SQL
$query->execute();
$query1->execute();
$query2->execute();
if ($query->rowCount() == 0) {
    //Tidak ada hasil
    die("Error: ID Tidak Ditemukan");
} else {
    // ID Ditemukan, Ambil data
    $data = $query->fetch();
    $data1 = $query1->fetchAll();
    $data2 = $query2->fetchAll();
}

if(isset($_POST['submit'])){
    // Simpan data yang di inputkan ke POST ke masing-masing variable dan convert semua tag HTML yang mungkin dimasukkan untuk mengindari XSS
    $kd_brg  = htmlentities($_POST['kd_brg']);
    $jml_klr = htmlentities($_POST['jml_klr']);
    $wkt_klr = htmlentities($_POST['wkt_klr']);
    $tgl_klr = htmlentities($_POST['tgl_klr']);

    // Prepared statement untuk menambah data
    $query = $db->prepare("UPDATE `barang_klr` SET `nip` = :nip,`kd_brg` = :kd_brg, `jml_klr` = :jml_klr, `wkt_klr` = :wkt_klr, `tgl_klr` = :tgl_klr WHERE no_klr = :no_klr");
    $query->bindParam(":nip", $currentUser['nip']);
    $query->bindParam(":kd_brg", $kd_brg);
    $query->bindParam(":jml_klr", $jml_klr);
    $query->bindParam(":wkt_klr", $wkt_klr);
    $query->bindParam(":tgl_klr", $tgl_klr);
    $query->bindParam(":no_klr", $_GET['id']);
    // Jalankan perintah SQL
    $query->execute();
    // Alihkan ke index.php
    header("location: brg_klr.php");
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
                            <h3 class="box-title">Ubah Barang Keluar</h3>
                        </div>
                        <!-- /.box-header -->
                        <form method=post>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="no_klr">Nomor Barang Keluar</label>
                                    <input type="text" name="no_klr" id="no_klr" class="form-control" value="<?php echo $data['no_klr'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="no_sp">Kode Barang dan Nama Barang</label>
                                    <!-- Perulangan Untuk Menampilkan Semua Data yang ada di Variable Data -->
                                    <select class="form-control select2" style="width: 100%;" name="kd_brg" id="kd_brg" required="">
                                        <option value="<?php echo $data['kd_brg'] ?>"><?php echo $data['kd_brg'] ?> - <?php echo $data['nm_brg']; ?></option>
                                        <?php foreach ($data2 as $value): ?>
                                        <option value="<?php echo $value['kd_brg'] ?>"><?php echo $value['kd_brg'] ?> - <?php echo $value['nm_brg']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jml_klr">Jumlah Keluar</label>
                                    <input type="number" name="jml_klr" id="jml_klr" class="form-control" value="<?php echo $data['jml_klr'] ?>" required="">
                                </div>
                                <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                        <label>Waktu Keluar</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control timepicker" name="wkt_klr" value="<?php echo $data['wkt_klr'] ?>" required="">
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
                                    <input type="text" class="form-control pull-right" id="datepicker" name="tgl_klr" value="<?php echo $data['tgl_klr'] ?>" required="">
                                  </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary btn-flat" name="submit">Ubah</button>
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