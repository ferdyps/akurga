
  <!-- Bootstrap core JavaScript -->
  <script src="<?= base_url('assets/sweetalert2-9.3.6/dist/sweetalert2.all.min.js'); ?>"></script>
  <script src="<?= base_url('assets/ckeditor/ckeditor.js');?>"></script>

  <script src="<?php echo base_url('assets/user/vendor/magnific-popup/jquery.magnific-popup.min.js');?>"></script>
  <script src="<?= base_url("assets/bootstrap4admin/vendor/datatables/jquery.dataTables.min.js"); ?>"></script>
  <script src="<?= base_url("assets/bootstrap4admin/vendor/datatables/dataTables.bootstrap4.min.js"); ?>"></script>

  <!-- Custom scripts for this template -->
  <script src="<?php echo base_url('assets/user/js/creative.min.js');?>"></script>
  <script src="<?= base_url('assets/sweetalert/sweetalert.min.js'); ?>"></script>
  <script src="<?= base_url('assets/pickadate.js-3.6.2/picker.js'); ?>" charset="utf-8"></script>
  <script src="<?= base_url('assets/pickadate.js-3.6.2/picker.date.js'); ?>" charset="utf-8"></script>
  <script src="<?= base_url('assets/pickadate.js-3.6.2/picker.time.js'); ?>" charset="utf-8"></script>
  <script src="<?= base_url('assets/js/main.js'); ?>"></script>

  <script type="text/javascript">
  $('.datepickerSurat').pickadate({
      selectYears: true,
      selectMonths: true,
      format: 'dd mmmm yyyy',
      formatSubmit: 'yyyy-mm-dd',
      hiddenName: true,
      min: new Date(),
    });

  $('#tabel_notulensi').DataTable({
         "processing":true,
         "serverSide":true,
         "order":[],
         "ajax":{
              url:"<?php echo base_url().'user/fetch_notulensidisplay'; ?>",
              type:"POST"
         },
         "columnDefs":[
              {
                   "targets":[],
                   "orderable":false,
              },
         ],
    });

    // $('#tabel_notulensi').DataTable().search(
    // ).draw();
  </script>

</body>

</html>
