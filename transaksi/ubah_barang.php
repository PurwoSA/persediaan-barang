<?php
include 'header.php';
if(!isset($_GET['id'])){
  die("Error: ID Tidak Dimasukkan");
}
//Ambil data
$query = $db->prepare("SELECT * FROM `barang` WHERE kd_brg = :kd_brg");
$query->bindParam(":kd_brg", $_GET['id']);
// Jalankan perintah sql
$query->execute();
if($query->rowCount() == 0){
  // Tidak ada hasil
  die("Error: ID Tidak Ditemukan");
}else{
  // ID Ditemukan, Ambil data
  $data = $query->fetch();
}
if(isset($_POST['submit'])){
  // Simpan data yang di inputkan ke POST ke masing-masing variable dan convert semua tag HTML yang mungkin dimasukkan untuk mengindari XSS
  $nm_brg         = htmlentities($_POST['nm_brg']);
  $stok           = htmlentities($_POST['stok']);
  $satuan         = htmlentities($_POST['satuan']);
  $jenis          = htmlentities($_POST['jenis']);
  $tgl_msk        = htmlentities($_POST['tgl_msk']);
  $tgl_kadaluarsa = htmlentities($_POST['tgl_kadaluarsa']);
  // Prepared statement untuk mengubah data
  $query = $db->prepare("UPDATE `barang` SET `nm_brg` = :nm_brg,`stok` = :stok,`satuan` = :satuan, `jenis` = :jenis, `tgl_msk` = :tgl_msk, `tgl_kadaluarsa` = :tgl_kadaluarsa WHERE kd_brg = :kd_brg");
  $query->bindParam(":nm_brg", $nm_brg);
  $query->bindParam(":stok", $stok);
  $query->bindParam(":satuan", $satuan);
  $query->bindParam(":jenis", $jenis);
  $query->bindParam(":tgl_msk", $tgl_msk);
  $query->bindParam(":tgl_kadaluarsa", $tgl_kadaluarsa);
  $query->bindParam(":kd_brg", $_GET['id']);
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
            <li class="active">
              <a href="../transaksi/barang.php">
                <i class="fa fa-archive fa-fw"></i> Barang
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
              <h3 class="box-title">Ubah Barang</h3>
            </div>
            <!-- /.box-header -->
            <form method=post>
              <div class="box-body">
                <div class="form-group">
                  <label for="nm_brg">Kode Barang</label>
                  <input type="text" name="kd_brg" id="kd_brg" class="form-control" value="<?php echo $data['kd_brg'] ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="nm_brg">Nama Barang</label>
                  <input type="text" name="nm_brg" id="nm_brg" class="form-control" value="<?php echo $data['nm_brg'] ?>" required="">
                </div>
                <div class="form-group">
                  <label for="satuan">Stok Barang</label>
                  <input type="number" name="stok" id="stok" class="form-control" value="<?php echo $data['stok'] ?>" required="">
                </div>
                <div class="form-group">
                  <label for="satuan">Satuan Barang</label>
                  <input type="text" name="satuan" id="satuan" class="form-control" value="<?php echo $data['satuan'] ?>" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 96 && event.charCode <= 122) || (event.charCode >= 32 && event.charCode <= 32)" required="">
                </div>
                <div class="form-group">
                  <label for="jenis">Jenis Barang</label>
                  <select class="form-control select2" style="width: 100%;" name="jenis" id="jenis" required="">
                    <option value="<?php echo $data['jenis']?>" selected="selected"><?php echo $data['jenis']?></option>
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
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" name="tgl_msk" value="<?php echo $data['tgl_msk'] ?>" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tgl_kadaluarsa">Tanggal Kadaluarsa</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker1" name="tgl_kadaluarsa" value="<?php echo $data['tgl_kadaluarsa'] ?>" required="">
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-flat" name="submit">Ubah</button>
                <button type="reset" class="btn btn-default btn-flat" name="reset"><i class="fa fa-eraser"></i> Bersihkan</button>
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
