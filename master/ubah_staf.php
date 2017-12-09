<?php
include 'header.php';
if(!isset($_GET['id'])){
  die("Error: ID Tidak Dimasukkan");
}
//Ambil data
$query = $db->prepare("SELECT * FROM `staf` WHERE nip = :nip");
$query->bindParam(":nip", $_GET['id']);
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
  $nm_staf   = htmlentities($_POST['nm_staf']);
  $almt_staf = htmlentities($_POST['almt_staf']);
  $telp_staf = htmlentities($_POST['telp_staf']);
  $password  = htmlentities($_POST['password']);
  $kpass     = htmlentities($_POST['kpass']);
  //Cocokkan password
  if ($kpass == $password) {
    // Prepared statement untuk mengubah data
    $query = $db->prepare("UPDATE `staf` SET `nm_staf` = :nm_staf,`almt_staf` = :almt_staf,`telp_staf` = :telp_staf, `password` = :password WHERE nip = :nip");
    $query->bindParam(":nm_staf", $nm_staf);
    $query->bindParam(":almt_staf", $almt_staf);
    $query->bindParam(":telp_staf", $telp_staf);
    $query->bindParam(":password", $password);
    $query->bindParam(":nip", $_GET['id']);
    // Jalankan perintah SQL
    $query->execute();
    // Alihkan ke index.php
    header("location: staf.php");
  }
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
            <li class="active">
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
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Staf
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Staf</h3>
            </div>
            <!-- /.box-header -->
            <form method=post>
              <div class="box-body">
                <div class="form-group">
                  <label for="nm_staf">NIP</label>
                  <input type="text" name="nip" id="nip" class="form-control" value="<?php echo $data['nip'] ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="nm_staf">Nama Staf</label>
                  <input type="text" name="nm_staf" id="nm_staf" class="form-control" value="<?php echo $data['nm_staf'] ?>" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 96 && event.charCode <= 122) || (event.charCode >= 32 && event.charCode <= 32)">
                </div>
                <div class="form-group">
                  <label for="almt_staf">Alamat Staf</label>
                  <input type="text" name="almt_staf" id="almt_staf" class="form-control" value="<?php echo $data['almt_staf'] ?>">
                </div>
                <div class="form-group">
                  <label for="telp_staf">Telepon Staf</label>
                  <input type="text" name="telp_staf" id="telp_staf" class="form-control" value="<?php echo $data['telp_staf'] ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" class="form-control" value="" required>
                </div>
                <div class="form-group">
                  <label for="kpass">Konfirmasi Password</label>
                  <input type="password" name="kpass" id="kpass" class="form-control" value="" required>
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
