<?php
include 'header.php';
// Buat prepared statement untuk mengambil semua data dari tbBiodata
$query = $db->prepare("SELECT z.*, y.nm_brg, x.tgl_sp FROM surat_pesan x, barang y, isi_sp z WHERE x.no_sp = z.no_sp AND y.kd_brg = z.kd_brg");
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
        <li><a href="../index.php"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
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
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="../transaksi/isi_sp.php"><i class="fa fa-pencil-square-o fa-fw"></i> Isi Surat Pesan</a></li>
            <li><a href="../transaksi/sp.php"><i class="fa fa-envelope fa-fw"></i> Surat Pesan</a></li>
            <li><a href="../transaksi/brg_klr.php"><i class="fa fa-shopping-cart fa-fw"></i> Barang Keluar</a></li>
            <li><a href="../transaksi/ttb.php"><i class="fa fa-reply fa-fw"></i> Tanda Terima Barang</a></li>
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
            <div class="box-header">
              <h3 class="box-title">Data Isi Surat Pesan</h3>
              <a href="tambah_isi_sp.php" class="btn btn-primary btn-flat pull-right"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover table-responsive">
                <thead>
                  <tr>
                    <th>Nomor SP</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Tanggal SP</th>
                    <th>Jumlah Pesan</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Perulangan Untuk Menampilkan Semua Data yang ada di Variable Data -->
                  <?php foreach ($data as $value): ?>
                  <tr>
                    <td>
                      <?php echo $value['no_sp'] ?>
                    </td>
                    <td>
                      <?php echo $value['kd_brg'] ?>
                    </td>
                    <td>
                      <?php echo $value['nm_brg'] ?>
                    </td>
                    <td>
                      <?php echo $value['tgl_sp'] ?>
                    </td>
                    <td>
                      <?php echo $value['jml_psn'] ?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Nomor SP</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Tanggal SP</th>
                    <th>Jumlah Pesan</th>
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
