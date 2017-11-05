<?php
include 'header.php';
// Buat prepared statement untuk mengambil semua data dari tbBiodata
$query = $db->prepare("SELECT x.*, y.nm_staf FROM ubah_kondisi x, staf y WHERE x.nip = y.nip");
// Jalankan perintah SQL
$query->execute();
// Ambil semua data dan masukkan ke variable $data
$data  = $query->fetchAll();
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
        <a href="tambah_ubah_kondisi.php" class="btn btn-primary btn-flat pull-right">
          <i class="fa fa-plus"></i> Tambah Data
        </a>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Ubah Kondisi Barang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover table-responsive">
                <thead>
                  <tr>
                    <th>Nomor Ubah Kondisi Barang</th>
                    <th>Nama Staf</th>
                    <th>Waktu Keluar</th>
                    <th>Tanggal Keluar</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Perulangan Untuk Menampilkan Semua Data yang ada di Variable Data -->
                  <?php foreach ($data as $value): ?>
                  <tr>
                    <td>
                      <?php echo $value['kd_ubah']; ?>
                    </td>
                    <td>
                      <?php echo $value['nm_staf'] ?>
                    </td>
                    <td>
                      <?php echo $value['wkt_ubah'] ?>
                    </td>
                    <td>
                      <?php echo $value['tgl_ubah'] ?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Nomor Ubah Kondisi Barang</th>
                    <th>Nama Staf</th>
                    <th>Waktu Keluar</th>
                    <th>Tanggal Keluar</th>
                  </tr>
                </tfoot>
              </table>
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
