<?php
include 'header.php';
if(!isset($_GET['id'])){
    die("Error: ID Tidak Dimasukkan");
}

//Ambil data
$query  = $db->prepare("SELECT * FROM supplier w, surat_pesan x, barang y, isi_sp z WHERE z.kd_isi = :kd_isi AND x.no_sp = z.no_sp AND y.kd_brg = z.kd_brg AND w.kd_supplier = x.kd_supplier");
$query1 = $db->prepare("SELECT x.*, y.nm_supplier FROM surat_pesan x, supplier y WHERE x.kd_supplier = y.kd_supplier");
$query2 = $db->prepare("SELECT x.kd_brg, x.nm_brg FROM barang x");
$query->bindParam(":kd_isi", $_GET['id']);
//Jalankan perintah SQL
$query->execute();
$query1->execute();
$query2->execute();
if ($query->rowCount() == 0) {
    //Tidak ada hasil
    die("Error: ID Tidak Ditemukan");
} else {
    // ID Ditemukan, Ambil data
    $data  = $query->fetch();
    $data1 = $query1->fetchAll();
    $data2 = $query2->fetchAll();
}

if(isset($_POST['submit'])){
    // Simpan data yang di inputkan ke POST ke masing-masing variable dan convert semua tag HTML yang mungkin dimasukkan untuk mengindari XSS
    $no_sp   = htmlentities($_POST['no_sp']);
    $kd_brg  = htmlentities($_POST['kd_brg']);
    $jml_psn = htmlentities($_POST['jml_psn']);

    // Prepared statement untuk menambah data
    $query = $db->prepare("UPDATE `isi_sp` SET `no_sp` = :no_sp,`kd_brg` = :kd_brg, `jml_psn` = :jml_psn WHERE kd_isi = :kd_isi");
    $query->bindParam(":no_sp", $no_sp);
    $query->bindParam(":kd_brg", $kd_brg);
    $query->bindParam(":jml_psn", $jml_psn);
    $query->bindParam(":kd_isi", $_GET['id']);
    // Jalankan perintah SQL
    $query->execute();
    // Alihkan ke index.php
    header("location: isi_sp.php");
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
                        <li><a href="../transaksi/isi_sp.php"><i class="fa fa-pencil-square-o fa-fw"></i> Isi Surat Pesan</a></li>
                        <li class="active"><a href="../transaksi/surat_pesan.php"><i class="fa fa-envelope fa-fw"></i> Surat Pesan</a></li>
                        <li><a href="../transaksi/brg_klr.php"><i class="fa fa-shopping-cart fa-fw"></i> Barang Keluar</a></li>
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
                Isi Surat Pesan
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Ubah Isi Surat Pesan</h3>
                        </div>
                        <!-- /.box-header -->
                        <form method=post>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="kd_isi">Nomor Isi Surat Pesan</label>
                                    <input type="text" name="kd_isi" id="kd_isi" class="form-control" value="<?php echo $data['kd_isi'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="no_sp">Kode Surat Pesan, Tanggal Pesan, dan Nama Supplier</label>
                                    <!-- Perulangan Untuk Menampilkan Semua Data yang ada di Variable Data -->
                                    <select class="form-control select2" style="width: 100%;" name="no_sp" id="no_sp" required="">
                                        <option value="<?php echo $data['no_sp'] ?>"><?php echo $data['no_sp'] ?> - <?php echo $data['tgl_sp'] ?> - <?php echo $data['nm_supplier']; ?></option>
                                        <option value="">------------------------------------------------------------------------------------</option>
                                        <?php foreach ($data1 as $value): ?>
                                        <option value="<?php echo $value['no_sp'] ?>"><?php echo $value['no_sp'] ?> - <?php echo $value['tgl_sp'] ?> - <?php echo $value['nm_supplier']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="no_sp">Kode Barang dan Nama Barang</label>
                                    <!-- Perulangan Untuk Menampilkan Semua Data yang ada di Variable Data -->
                                    <select class="form-control select2" style="width: 100%;" name="kd_brg" id="kd_brg" required="">
                                        <option value="<?php echo $data['kd_brg'] ?>"><?php echo $data['kd_brg'] ?> - <?php echo $data['nm_brg']; ?></option>
                                        <option value="">------------------------------------------------------------------------------------</option>
                                        <?php foreach ($data2 as $value): ?>
                                        <option value="<?php echo $value['kd_brg'] ?>"><?php echo $value['kd_brg'] ?> - <?php echo $value['nm_brg']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jml_psn">Jumlah Pesan</label>
                                    <input type="number" name="jml_psn" id="jml_psn" class="form-control" value="<?php echo $data['jml_psn'] ?>" required="">
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
