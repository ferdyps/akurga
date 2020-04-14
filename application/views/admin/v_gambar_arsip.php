<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= config_item('web_title');?></title>

  <script src="https://cdn.tiny.cloud/1/qf07roceffujxp358dotjis9e7d3d6n3csrf8hejmf9zusw5/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url('assets/bootstrap4admin/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('assets/bootstrap4admin/css/sb-admin-2.min.css');?>" rel="stylesheet">
  <link href="<?= base_url('assets/bootstrap4admin/vendor/datatables/dataTables.bootstrap4.min.css');?>" rel="stylesheet">
  <link rel="stylesheet" href="<?= config_item('asset_url') . 'pickadate.js-3.6.2/themes/classic.css'; ?>">
  <link rel="stylesheet" href="<?= config_item('asset_url') . 'pickadate.js-3.6.2/themes/classic.date.css'; ?>">
  <link rel="stylesheet" href="<?= config_item('asset_url') . 'pickadate.js-3.6.2/themes/classic.time.css'; ?>">

  <link rel="stylesheet" href="<?= config_item('asset_url') . 'css/main.css'; ?>">

  <?php $this->load->view('admin/_partials/js_core');?>

</head>

  <body id="page-top">

    <div class="container-fluid">
      <?php foreach ($fetch as $row) { ?>
        <img width="1000px" height="800px" class="img-thumbnail img-fluid mx-auto d-block" src="<?= base_url('./assets/foto/arsip/'. $row['gambar_srt'])?>">
      <?php } ?>
    </div>

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
  <script src="<?= base_url('assets/js/canvasjs.min.js')?>"></script>
  <script src="<?= base_url('assets/js/main.js'); ?>"></script>



</body>

</html>
