<!--Footer-part-->

    <div class="row-fluid">
      <div id="footer" class="span12">2017 &copy; Tugas APSI by <a href="http://fendi.comuv.com">KITA</a></div>
    </div>

    <!--end-Footer-part-->

    <script src="../dist/js/jquery.min.js"></script>
    <script src="../dist/js/jquery.ui.custom.js"></script>
    <script src="../dist/js/bootstrap.min.js"></script>
    <script src="../dist/js/jquery.uniform.js"></script>
    <script src="../dist/js/select2.min.js"></script>
    <script src="../dist/js/jquery.dataTables.min.js"></script>
    <script src="../dist/js/matrix.js"></script>
    <script src="../dist/js/matrix.tables.js"></script>

    <script type="text/javascript">
      // This function is called from the pop-up menus to transfer to
      // a different page. Ignore if the value returned is a null string:
      function goPage(newURL) {

        // if url is empty, skip the menu dividers and reset the menu selection to default
        if (newURL != "") {

          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-") {
            resetMenu();
          }
          // else, send page to designated URL
          else {
            document.location.href = newURL;
          }
        }
      }

      // resets the menu selection upon entry to this page:
      function resetMenu() {
        document.gomenu.selector.selectedIndex = 2;
      }
    </script>
  </body>

  </html>