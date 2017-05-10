<?php include 'header.php';?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li><a href="../index.php"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
      <li class="treeview active">
        <a href="#">
          <i class="fa fa-book"></i> <span>Master</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="../master/staf.php"><i class="fa fa-users fa-fw"></i> Staf</a></li>
          <li><a href="../master/barang.php"><i class="fa fa-archive fa-fw"></i> Barang</a></li>
          <li class="active"><a href="../master/supplier.php"><i class="fa fa-building fa-fw"></i> Supplier</a></li>
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
          <li><a href="../transaksi/isi_sp.php"><i class="fa fa-pencil-square-o fa-fw"></i> Isi Surat Pesan</a></li>
          <li><a href="../transaksi/surat_pesan.php"><i class="fa fa-envelope fa-fw"></i> Surat Pesan</a></li>
          <li><a href="../transaksi/barangkeluar.php"><i class="fa fa-shopping-cart fa-fw"></i> Isi Barang Keluar</a></li>
          <li><a href="../transaksi/tandaterima.php"><i class="fa fa-reply fa-fw"></i> Tanda Terima Barang</a></li>
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
      Supplier
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Supplier</h3>
            <a href="#" class="btn btn-primary btn-flat pull-right"><i class="fa fa-plus"></i> Tambah Data</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-hover table-responsive">
              <thead>
                <tr>
                  <th>Kode Supplier</th>
                  <th>Nama Supplier</th>
                  <th>Alamat Supplier</th>
                  <th>Telepon Supplier</th>
                </tr>
              </thead>
              <tbody>
                <?php
                class TableRows extends RecursiveIteratorIterator
                {
                    public function __construct($it)
                    {
                        parent::__construct($it, self::LEAVES_ONLY);
                    }

                    public function current()
                    {
                        return "<td>" . parent::current(). "</td>";
                    }

                    public function beginChildren()
                    {
                        echo "<tr>";
                    }

                    public function endChildren()
                    {
                        echo "</tr>" . "\n";
                    }
                }
                try {
                    $stmt = $db->prepare("SELECT * FROM barang");
                    $stmt->execute();

                    // set the resulting array to associative
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                        echo $v;
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                $db = null;
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Kode Supplier</th>
                  <th>Nama Supplier</th>
                  <th>Alamat Supplier</th>
                  <th>Telepon Supplier</th>
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