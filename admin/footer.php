</div><!-- end container-fluid" -->
</main><!-- end page-content" -->
</div><!-- end page-wrapper -->

<!-- Modal Exit -->
<div class="modal fade" id="Exit" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0">
      <div class="modal-body text-center">
        <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
        <h3 class="mb-4">Apakah anda yakin ingin keluar ?</h3>
        <button type="button" class="btn btn-secondary px-4 mr-2" data-dismiss="modal">Batal</button>
        <a href="keluar.php" class="btn btn-primary px-4">Keluar</a>
      </div>
    </div>
  </div>
  <!-- end Modal Exit -->



  <!-- link js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="../assets/js/sidebar.js"></script>
  <script src="../assets/vendor/datatables/jquery-3.5.1.js"></script>
  <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="../assets/vendor/datatables/dataTables.responsive.min.js"></script>
  <script src="../assets/vendor/datatables/responsive.bootstrap4.min.js"></script>
  <script src="assets/js/sidebar.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#table').DataTable();
    });
    $('#cart').dataTable({
      searching: false,
      paging: false,
      info: false
    });
  </script>
  <script>
    function reloadpage() {
      location.reload()
    }
  </script>

  <!-- Swal -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
  <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
  <script type="text/javascript" src="../assets/js/sweetalert.js"></script>
  <!-- javascript datetime -->
  <script type="text/javascript" src="../assets/js/datetime.js"></script>
  <script type="text/javascript">
    window.onload = date_time('date_time');
  </script>
  </body>

  </html>