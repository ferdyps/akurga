

  <script src="<?= base_url('assets/sweetalert2-9.3.6/dist/sweetalert2.all.min.js'); ?>"></script>
  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url('assets/bootstrap4admin/js/sb-admin-2.min.js');?>"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url('assets/bootstrap4admin/vendor/chart.js/Chart.min.js');?>"></script>

  <!-- Page level custom scripts -->
  <?php if($title == 'Dashboard') { ?>
  <script src="<?php echo base_url('assets/bootstrap4admin/js/demo/chart-area-demo.js');?>"></script>
  <script src="<?php echo base_url('assets/bootstrap4admin/js/demo/chart-pie-demo.js');?>"></script>
  <?php } ?>
  <script src="<?= base_url("assets/bootstrap4admin/vendor/datatables/jquery.dataTables.min.js"); ?>"></script>
  <script src="<?= base_url("assets/bootstrap4admin/vendor/datatables/dataTables.bootstrap4.min.js"); ?>"></script>
  <script src="<?= base_url('assets/ckeditor/ckeditor.js');?>"></script>
  <script src="<?= base_url('assets/bootstrap4admin/js/demo/datatables-demo.js')?>"></script>
  <script src="<?= base_url('assets/sweetalert/sweetalert.min.js'); ?>"></script>
  <script src="<?= base_url('assets/pickadate.js-3.6.2/picker.js'); ?>" charset="utf-8"></script>
  <script src="<?= base_url('assets/pickadate.js-3.6.2/picker.date.js'); ?>" charset="utf-8"></script>
  <script src="<?= base_url('assets/pickadate.js-3.6.2/picker.time.js'); ?>" charset="utf-8"></script>

  <script src="<?= base_url('assets/js/main.js'); ?>"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      var tgl_dipilih;
      var bool;

      $('.timepicker').pickatime({

        format: 'HH:i',
        formatSubmit: 'HH:i',
        hiddenName: true
      });

      var picker = $('.timepicker').pickatime().pickatime('picker');

      $('.datepicker').pickadate({
        selectYears: true,
        selectMonths: true,
        min: true,
        format: 'dd mmmm yyyy',
        formatSubmit: 'yyyy-mm-dd',
        hiddenName: true,
        onSet: function() {
          tgl_dipilih = $('input[type=hidden]').attr('name', 'tgl_surat').val();
          var tgl = new Date();
          var tgl_sekarang = tgl.getFullYear() + "-" + (tgl.getMonth()+1) + "-0" + tgl.getDate();

          if (tgl_dipilih == tgl_sekarang) {
            picker.set('min', true);
          } else {
            picker.set('min', [6,0]);
            picker.set('max', [22,0]);
          }
        }
      });
    });
  </script>


</body>

</html>
