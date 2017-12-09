<?php
include 'header.php';
$bln = $_POST['bln'];
$thn = $_POST['thn'];
// Buat prepared statement untuk mengambil semua data dari tbBiodata
$query = $db->prepare("SELECT r.*, c.*, b.nm_brg FROM restock r, cek c, barang b WHERE YEAR(r.tgl_list) = '$thn' AND MONTH(r.tgl_list) = '$bln' AND r.kd_list = c.kd_list AND c.kd_brg = b.kd_brg");
// Jalankan perintah SQL
$query->execute();
// Ambil semua data dan masukkan ke variable $data
$data = $query->fetchAll();
// Pilih nama bulan
if ($bln == "01") {
  $nmbln = "Januari";
} elseif ($bln == "02") {
  $nmbln = "Februari";
} elseif ($bln == "03") {
  $nmbln = "Maret";
} elseif ($bln == "04") {
  $nmbln = "April";
} elseif ($bln == "05") {
  $nmbln = "Mei";
} elseif ($bln == "06") {
  $nmbln = "Juni";
} elseif ($bln == "07") {
  $nmbln = "Juli";
} elseif ($bln == "08") {
  $nmbln = "Agustus";
} elseif ($bln == "09") {
  $nmbln = "September";
} elseif ($bln == "10") {
  $nmbln = "Oktober";
} elseif ($bln == "11") {
  $nmbln = "November";
} elseif ($bln == "12") {
  $nmbln = "Desember";
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
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active">
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
        Laporan Daftar <i>Restock</i> Barang
        <a onClick="window.print()" class="btn btn-primary btn-flat pull-right"><i class="fa fa-print"></i> Cetak</a>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Umar Bakery</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <p>Laporan Daftar <i>Restock</i> Barang Bulan <strong><?php echo $nmbln; ?></strong> Tahun <strong><?php echo $thn; ?></strong></p>
              <table id="example1" class="table table-bordered table-hover table-responsive">
                <thead>
                  <tr>
                    <th>Kode <i>Restock</i></th>
                    <th>Nama Barang</th>
                    <th>Tanggal <i>Restock</i></th>
                    <th>Jumlah <i>Restock</i></th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Perulangan Untuk Menampilkan Semua Data yang ada di Variable Data -->
                  <?php foreach ($data as $value): ?>
                  <tr>
                    <td>
                      <?php echo $value['kd_list'] ?>
                    </td>
                    <td>
                      <?php echo $value['nm_brg'] ?>
                    </td>
                    <td>
                      <?php echo $value['tgl_list'] ?>
                    </td>
                    <td>
                      <?php echo $value['jml_restock'] ?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <p class="text-right">Mengetahui</p><br><br><br>
              <p class="text-right"><strong>Umar Bakrie</strong></p>
              <p class="text-right">Pemilik Umar Bakery</p>
            </div>
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
