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
  <style>
    .notulensi-text{
      color: #000000;
    }
  </style>
</head>

  <body id="page-top">

    <div class="container-fluid">
      <?php foreach ($fetch as $row) { ?>
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="jumbotron jumbotron-fluid border border-dark">
              <div class="container-fluid">
                <div class="card notulensi-text">
                  <div class="card-body ">
                    <div class="container-fluid">
                      <h2 class="display-4 notulensi-text">Notulensi Rapat dengan undangan rapat nomor <?= str_replace('-','/',$row['no_udg']) ?></h2>
                      <hr class="my-4 border-dark">
                      <h6 class="lead notulensi-text">Nomor notulensi <?= str_replace('-','/',$row['no_notulen']) ?></h6>

                      <h6 class="lead notulensi-text">Notulensi By <?= substr($row['penulis'],0,10).' '.$row['rt']; ?></h6>
                      <?php config_item('setlocal'); ?>
                      <h6 class="lead notulensi-text">Diunggah pada tanggal <?= strftime("%d %B %Y",strtotime($row['tgl_buat'])); ?></h6><br>

                      <img width="1000px" height="800px" class="img-thumbnail img-fluid mx-auto d-block" src="<?= base_url('./assets/foto/notulensi/'. $row['dokumentasi_rpt'])?>">
                      <div class="media">
                        <div class="media-body">
                          <h6 class="mt-0 ml-5 mb-5 text-muted"><?= $row['keterangan_dokumentasi'] ?></h6>
                        </div>
                      </div>

                      <h6 class="lead notulensi-text">Rapat dilaksanakan pada :</h6>
                      <h6 class="lead notulensi-text">Tanggal : <?= strftime("%d %B %Y",strtotime($row['tgl_udg'])); ?></h6>
                      <h6 class="lead notulensi-text">Waktu : Jam <?= strftime("%R",strtotime($row['jam_udg'])); ?> s/d selesai</h6>
                      <h6 class="lead notulensi-text">Tempat : <?= $row['tempat_udg']; ?></h6>
                      <h6 class="lead notulensi-text">Agenda : <?= $row['acara_udg']; ?></h6>
                      <hr class="my-3 border-dark">
                      <h6 class="notulensi-text">HASIL PERTEMUAN :</h6>
                      <?= $row['uraian_notulen']; ?>
                      <hr class="my-4 border-dark">
                      <?php if ($row['tembusan'] == '_') {
                        $tembusan = '-';
                      }else {
                        $tembusan = $row['tembusan'];
                      } ?>
                      <h6>Tembusan : <?= $tembusan;?> </h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2"></div>
        </div>


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
