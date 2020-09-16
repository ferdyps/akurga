  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">RW 01</h1>
      <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row">

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Approval Request (Warga) </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php foreach ($semuaWarga as $row) {
                                                                      echo $row['total'];
                                                                    } ?></div><br>
                <a href="<?php echo base_url('ketuaRW/konfirmasiDataWarga'); ?>" class="btn btn-primary">Lihat Warga</a>
              </div>
              <div class="col-auto">
                <i class="fas fa-users fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Pengeluaran</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <?php
                    $sum = 0;
                    foreach ($dataiurank as $b) {
                      $sum += $b['nominal'];
                    }
                    ?>
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $sum ?></div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Pending Requests Card Example -->


      <div class="col-xl-3 col-md-6 mb-4">



        <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
          <!-- Position it -->
          <div style="position: absolute; top: 0; right: 0;">

            <!-- Then put toasts within -->
            <?php if ($whos == 'Ketua RW' && $notifikasi_jam_udg_num > 0) { ?>
              <?php foreach ($notifikasi_jam_udg as $notify) { ?>
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false" data-animation="true">
                  <div class="toast-header">
                    <strong class="mr-auto">Notification</strong>
                    <small class="text-muted"><?= strftime("%d %B %Y %T", strtotime($notify['notif_datetime'])) ?></small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="toast-body">
                    <?= $notify['notif_msg'] ?> <?= $notify['atr_pk'] ?> dari <?= strftime("%R", strtotime($notify['old_time_val'])) ?> menjadi <?= strftime("%R", strtotime($notify['new_time_val'])) ?>
                  </div>
                </div>
              <?php } ?>
            <?php } else {
            } ?>



          </div>
        </div>

      </div>
    </div>

    <div class="row">
      <div class="col text-center">
        <h3>Data Kependudukan RW 01</h3>
      </div>
    </div>
    <!-- Content Row -->

    <div class="row">
      <div class="card-body">
        <div class="chart-area" id="warga">
        </div>
      </div>
      <div class="card-body">
        <div class="chart-area" id="education">
        </div>
      </div>
      <div class="card-body">
        <div class="chart-area" id="job">
        </div>
      </div>
    </div>
    <!-- <div class="row"></div> -->
    <div class="row">
      <div class="card-body">
        <div class="chart-area" id="agama">
        </div>
      </div>
      <div class="card-body">
        <div class="chart-area" id="status">
        </div>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->
  <script>
    window.onload = function() {

      var chartPendidikan = new CanvasJS.Chart("education", {
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        exportEnabled: true,
        animationEnabled: true,
        title: {
          text: "Berdasarkan Pendidikan"
        },
        data: [{
          type: "pie",
          startAngle: 25,
          toolTipContent: "<b>{label}</b>: {y}",
          showInLegend: "true",
          legendText: "{label}",
          indexLabelFontSize: 16,
          indexLabel: "{label} ({y})",
          dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chartPendidikan.render();

      var chartKerjaan = new CanvasJS.Chart("job", {
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        exportEnabled: true,
        animationEnabled: true,
        title: {
          text: "Berdasarkan Pekerjaan"
        },
        data: [{
          type: "pie",
          startAngle: 25,
          toolTipContent: "<b>{label}</b>: {y}",
          showInLegend: "true",
          legendText: "{label}",
          indexLabelFontSize: 16,
          indexLabel: "{label} ({y})",
          dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chartKerjaan.render();

      var chartJumlahWarga = new CanvasJS.Chart("warga", {
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        exportEnabled: true,
        animationEnabled: true,
        title: {
          text: "Berdasarkan RT"
        },
        data: [{
          type: "pie",
          startAngle: 25,
          toolTipContent: "<b>{label}</b>: {y}",
          showInLegend: "true",
          legendText: "RT {label}",
          indexLabelFontSize: 16,
          indexLabel: "RT {label} ({y} Orang)",
          dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chartJumlahWarga.render();

      var chartAgama = new CanvasJS.Chart("agama", {
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        exportEnabled: true,
        animationEnabled: true,
        title: {
          text: "Berdasarkan Agama"
        },
        data: [{
          type: "pie",
          startAngle: 25,
          toolTipContent: "<b>{label}</b>: {y}",
          showInLegend: "true",
          legendText: "{label}",
          indexLabelFontSize: 16,
          indexLabel: "{label} ({y} Orang)",
          dataPoints: <?php echo json_encode($dataAgama, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chartAgama.render();

      var chartStatus = new CanvasJS.Chart("status", {
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        exportEnabled: true,
        animationEnabled: true,
        title: {
          text: "Berdasarkan Status"
        },
        data: [{
          type: "pie",
          startAngle: 25,
          toolTipContent: "<b>{label}</b>: {y}",
          showInLegend: "true",
          legendText: "{label}",
          indexLabelFontSize: 16,
          indexLabel: "{label} ({y} Orang)",
          dataPoints: <?php echo json_encode($dataStatus, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chartStatus.render();

    }
    $('.toast').toast('show');
  </script>