<?php include 'header.php'; ?>
<!-- Let side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li>
        <a href="../index.php"><i class="fa fa-home"></i>
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
          <li>
            <a href="../master/supplier.php">
              <i class="fa fa-building fa-fw"></i> Supplier
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
            <a href="../transaksi/sp.php">
              <i class="fa fa-envelope fa-fw"></i> Surat Pesan
            </a>
          </li>
          <li>
            <a href="../transaksi/isi_sp.php">
              <i class="fa fa-pencil-square-o fa-fw"></i> Isi Surat Pesan
            </a>
          </li>
          <li>
            <a href="../transaksi/nota.php">
              <i class="fa fa-reply fa-fw"></i> Nota
            </a>
          </li>
          <li>
            <a href="../transaksi/isi_nota.php">
              <i class="fa fa-list fa-fw"></i> Isi Nota
            </a>
          </li>
          <li>
            <a href="../transaksi/brg_klr.php">
              <i class="fa fa-shopping-cart fa-fw"></i> Barang Keluar
            </a>
          </li>
          <li>
            <a href="../transaksi/isi_brg_klr.php">
              <i class="fa fa-cart-plus fa-fw"></i> Isi Barang Keluar
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
            <a href="../laporan/lap_barang_keluar.php">
              <i class="fa fa-file fa-fw"></i> Laporan Barang Keluar
            </a>
          </li>
          <li>
            <a href="../laporan/lap_barang_masuk.php">
              <i class="fa fa-file-text fa-fw"></i> Laporan Barang Masuk
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
      Laporan Barang Keluar
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Buat Laporan Barang Keluar</h3>
          </div>
          <!-- /.box-header -->
          <form action="cetak_barang_keluar.php" method=post>
            <div class="box-body">
              <div class="form-group">
                <label>Bulan</label>
                <select class="form-control select2" style="width: 100%" name="bln" id="bln" required="">
                  <option value=""> </option>
                  <option value="01">Januari</option>
                  <option value="02">Februari</option>
                  <option value="03">Maret</option>
                  <option value="04">April</option>
                  <option value="05">Mei</option>
                  <option value="06">Juni</option>
                  <option value="07">Juli</option>
                  <option value="08">Agustus</option>
                  <option value="09">September</option>
                  <option value="10">Oktober</option>
                  <option value="11">November</option>
                  <option value="12">Desember</option>
                </select>
              </div>
              <div class="form-group">
                <label>Tahun</label>
                <!-- Perulangan Untuk Menampilkan Tahun -->
                <select class="form-control select2" style="width: 100%;" name="thn" id="thn" required="">
                  <option value=""> </option>
                  <?php
                  $thn = 2017;
                  while ($thn <= $year) {
                      ?>
                  <option value="<?php echo $thn; ?>"><?php echo $thn; ?></option>
                    <?php
                    $thn++;
                  }
                  ?>
                </select>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-flat" name="submit">Lihat</button>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </form>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.content-wrapper -->
  </section>
  <!-- /.content -->
  <?php include 'footer.php'; ?>
