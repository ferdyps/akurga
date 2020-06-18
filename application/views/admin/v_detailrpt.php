<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Preview Rapat</title>

  <!-- Font Awesome Icons -->
  <link href="<?php echo base_url('assets/user/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="<?php echo base_url('assets/user/vendor/magnific-popup/magnific-popup.css');?>" rel="stylesheet">

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="<?php echo base_url('assets/user/css/creative.min.css');?>" rel="stylesheet">
  <link rel="stylesheet" href="<?= config_item('asset_url') . 'pickadate.js-3.6.2/themes/classic.css'; ?>">
  <link rel="stylesheet" href="<?= config_item('asset_url') . 'pickadate.js-3.6.2/themes/classic.date.css'; ?>">
  <link rel="stylesheet" href="<?= config_item('asset_url') . 'pickadate.js-3.6.2/themes/classic.time.css'; ?>">

  <link rel="stylesheet" href="<?= config_item('asset_url') . 'css/main.css'; ?>">
  <?php $this->load->view('user/_partials/js_core');?>

  <style>
    .notulensi-text{
      color: #000000;
    }
    .bgaja{
      background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%), url("../assets/user/img/desa-indah.jpg");
    }
  </style>
</head>
<body>
<header class="masthead h-100">
  <div class="container-fluid">
    <div class="row">
      <div class="container-fluid">
        <?php foreach ($fetch as $row) { ?>
          <?php config_item('setlocal'); ?>
          <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
              <div class="jumbotron jumbotron-fluid border border-dark">
                <div class="container-fluid">
                  <div class="card notulensi-text">
                    <div class="card-body ">
                      <div class="container-fluid">
                        <h2 class="display-4 notulensi-text">Surat undangan rapat nomor <?= str_replace('-','/',$row['no_udg']) ?></h2>
                        <hr class="my-4 border-dark">
                        <?php if ($row['lampiran_udg'] == '_') {
                          $lampir = '-';
                        }else {
                          $lampir = $row['lampiran_udg'];
                        } ?>
                        <h6 class="lead notulensi-text">Lampiran : <?= $lampir; ?></h6>
                        <h6 class="lead notulensi-text">Sifat <span style="display:inline-block; width: 40px;"></span> : <?= $row['sifat_udg'] ?></h6>
                        <h6 class="lead notulensi-text">Hal <span style="display:inline-block; width: 52px;"></span> : <?= $row['perihal_udg'] ?></h6><br>
                        <h6 class="lead notulensi-text">Kepada</h6>
                        <h6 class="lead notulensi-text"><?= $row['tujuan_surat'] ?></h6><br>
                        <h6 class="lead notulensi-text text-justify"><?= $row['isi_surat'] ?></h6><br>
                        <h6 class="lead notulensi-text"><span style="display:inline-block; width: 50px;"></span> Hari, tanggal : <?= strftime("%A, %d %B %Y",strtotime($row['tgl_udg'])) ?></h6>
                        <h6 class="lead notulensi-text"><span style="display:inline-block; width: 50px;"></span> Waktu <span style="display:inline-block; width: 63px;"></span>: <?= 'Jam '. strftime("%R",strtotime($row['jam_udg'])) .' s/d selesai' ?></h6>
                        <h6 class="lead notulensi-text"><span style="display:inline-block; width: 50px;"></span> Tempat <span style="display:inline-block; width: 50px;"></span>: <?= $row['tempat_udg']; ?></h6>
                        <h6 class="lead notulensi-text"><span style="display:inline-block; width: 50px;"></span> Agenda <span style="display:inline-block; width: 52px;"></span>: <?= $row['acara_udg']; ?></h6><br>
                        <h6 class="lead notulensi-text text-justify">Demikian disampaikan untuk dapat dimaklumi, atas kehadirannya diucapkan terima kasih agar menjadi maklum yang berkepentingan mengetahuinya.</h6><br>
                        <h6 class="lead notulensi-text text-right">Salam Hormat</h6><br>
                        <?php if (substr($row['no_udg'],8,2) == 'RW') { ?>
                          <h6 class="lead notulensi-text text-right">Ketua RW 01</h6>
                        <?php
                        }elseif (substr($row['no_udg'],8,2) == 'RT') { ?>
                          <h6 class="lead notulensi-text text-right">Ketua <?= $row['rt']; ?></h6>
                        <?php } ?>
                        <br><br>
                        <?php foreach ($fetch_ketua as $ketua) {?>
                          <h6 class="lead notulensi-text text-right"><?= $ketua['nama']; ?></h6>
                        <?php } ?>
                        <hr class="my-3 border-dark">

                        <?php
                        if ($row['tembusan'] == '_') {
                          $temb = '-';
                        }else {
                          $temb = $row['tembusan'];
                        }
                        $exp = explode("-", $row['no_udg']);
                        if ($exp[1] == 'KGT') {
                          if ($row['catatan'] == '_') {
                            $ctt = '-';
                          }else {
                            $ctt = $row['catatan'];
                          }
                        ?>
                          <h6 class="lead notulensi-text">Catatan : <?= $ctt;?></h6>
                        <?php } ?>
                        <h6 class="lead notulensi-text">Tembusan : <?= $temb;?></h6>
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
    </div>
  </div>
</header>


  <!-- Bootstrap core JavaScript -->
  <script src="<?= base_url('assets/sweetalert2-9.3.6/dist/sweetalert2.all.min.js'); ?>"></script>

  <script src="<?php echo base_url('assets/user/vendor/magnific-popup/jquery.magnific-popup.min.js');?>"></script>

  <!-- Custom scripts for this template -->
  <script src="<?php echo base_url('assets/user/js/creative.min.js');?>"></script>
  <script src="<?= base_url('assets/sweetalert/sweetalert.min.js'); ?>"></script>

</body>

</html>
