<?php
include 'header.php';
// Buat prepared statement untuk mengambil semua data dari tbBiodata
$query = $db->prepare("SELECT b.*, s.nm_staf FROM barang b, staf s WHERE b.nip = s.nip");
// Jalankan perintah SQL
$query->execute();
// Ambil semua data dan masukkan ke variable $data
$data = $query->fetchAll();
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
        <a href="tambah_barang.php" class="btn btn-primary btn-flat pull-right">
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
              <h3 class="box-title">Data Barang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover table-responsive">
                <thead>
                  <tr>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Jenis</th>
                    <th>Tanggal Masuk</th>
                    <th>Kadaluarsa</th>
                    <th>Pengentry</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Perulangan Untuk Menampilkan Semua Data yang ada di Variable Data -->
                  <?php foreach ($data as $value): ?>
                  <tr>
                    <td>
                      <?php echo $value['kd_brg'] ?>
                    </td>
                    <td>
                      <?php echo $value['nm_brg'] ?>
                    </td>
                    <?php if ($value['stok'] <= 5) {
                      ?>
                      <td class="danger">
                        <?php echo $value['stok'] ?>
                      </td>
                    <?php } elseif ($value['stok'] <= 10) { ?>
                      <td class="warning">
                        <?php echo $value['stok'] ?>
                      </td>
                    <?php } else { ?>
                      <td>
                        <?php echo $value['stok'] ?>
                      </td>
                    <?php } ?>
                    <td>
                      <?php echo $value['satuan'] ?>
                    </td>
                    <td>
                      <?php echo $value['jenis'] ?>
                    </td>
                    <td>
                      <?php echo $value['tgl_msk']; ?>
                    </td>
                    <?php if (((strtotime($date)-(strtotime($value['tgl_kadaluarsa'])))/(60*60*24)) >= -3) { ?>
                      <td class="danger">
                    <?php } elseif (((strtotime($date)-(strtotime($value['tgl_kadaluarsa'])))/(60*60*24)) >= -5) { ?>
                      <td class="warning">
                    <?php } else { ?>
                      <td>
                    <?php }
                      echo (strtotime($date)-(strtotime($value['tgl_kadaluarsa'])))/(60*60*24)?>
                    </td>
                    <td>
                      <?php echo $value['nm_staf'] ?>
                    </td>
                    <td>
                      <a href="ubah_barang.php?id=<?php echo $value['kd_brg']?>" class="btn btn-warning btn-flat"><i class="fa fa-pencil"></i></a>
                      <a href="hapus_barang.php?id=<?php echo $value['kd_brg']?>" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Jenis</th>
                    <th>Tanggal Masuk</th>
                    <th>Kadaluarsa</th>
                    <th>Pengentry</th>
                    <th>Aksi</th>
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
