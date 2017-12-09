    <footer class="main-footer">
      <strong>Umar Bakery &copy; <?php echo $year; ?></strong> Hak cipta dilindungi.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Create the tabs -->
      <ul class="nav nav-tabs nav-justified control-sidebar-tabs"></ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
          <!-- /.control-sidebar-menu -->
        </div>
        <!-- /.tab-pane -->
      </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->
  <!-- jQuery 2.2.3 -->
  <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <!-- Select2 -->
  <script src="../plugins/select2/select2.full.min.js"></script>
  <!-- DataTables -->
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
  <!-- bootstrap datepicker -->
  <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
  <!-- SlimScroll -->
  <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="../plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/app.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- page script -->
  <script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    //Initialize DataTable
    $("#example1").DataTable({
      language: {
        url: '../dist/Indonesian.json'
      }
    });
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format   : 'yyyy-mm-dd'
    });
    $('#datepicker1').datepicker({
      autoclose: true,
      format   : 'yyyy-mm-dd'
    });
    //Timepicker
    $(".timepicker").timepicker({
      showInputs  : false,
      showSeconds : true,
      showMeridian: false,
      maxHours    : 24,
      secondStep  : 1,
      minuteStep  : 1,
    });
  });
    </script>
</body>

</html>
