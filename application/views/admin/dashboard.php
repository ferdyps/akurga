  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <!-- <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Warga Yang belum Approval</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php foreach($semuaWarga as $row){echo $row['total'];}?></div><br>
            <a href="<?php echo base_url('ketuaRW/konfirmasiDataWarga'); ?>" class="btn btn-primary">Lihat Warga</a>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div> -->



  <!-- Earnings (Monthly) Card Example -->
  <!-- <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Pengeluaran</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <?php
                $sum = 0;
                foreach($dataiurank as $b) {
                  $sum += $b['nominal'];
                }
                ?>
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $sum ?></div>
              </div>
              <div class="col">
                <div class="progress progress-sm mr-2">
                  <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div> -->

  <!-- Pending Requests Card Example -->
  <!-- <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Pembayaran</div>
            <?php
                $sum = 0;
                foreach($dataiuranmsk as $b) {
                  $sum += $b['nominal'];
                }
                ?>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sum ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-comments fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div> -->
</div>
<div class="row">

  <div class="col-xl-12 col-lg-5">
    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
  </div>


  <div class="col-xl-12 col-lg-5">
    <div id="chartPengeluaranPemasukan" style="height: 300px; width: 100%;"></div>
  </div>

  <!-- Pie Chart -->
  <div class="col-xl-6 col-lg-5">
    <br><br><br>
    <div id="education"></div>
  </div>

  <!-- Pie Chart -->
  <div class="col-xl-6 col-lg-5">
    <br><br><br>
    <div id="job"></div>
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
		text: "Pendidikan"
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
		text: "Pekerjaan"
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

var chart = new CanvasJS.Chart("chartContainer", {
	theme:"light2",
	animationEnabled: true,
	title:{
		text: "Tren Pemasukkan & Pengeluaran RT - <?= $this->session->userdata('rt')?>"
	},
	axisY :{
		includeZero: false,
		title: "Jumlah (Rp.)"
	},
	toolTip: {
		shared: "true"
	},
	legend:{
		cursor:"pointer",
		itemclick : toggleDataSeries
	},
  data: [{
		type: "spline",
    name: "Pemasukan",
    markerSize: 5,
    showInLegend: true,
		visible: true,
		yValueFormatString: "Rp#,##0.##",
		dataPoints: <?php echo json_encode($jumlahPemasukan, JSON_NUMERIC_CHECK); ?>
	},
  {
		type: "spline",
    name: "Pengeluaran",
    markerSize: 5,
    showInLegend: true,
		visible: true,
		yValueFormatString: "Rp#,##0.##",
		dataPoints: <?php echo json_encode($jumlahPengeluaran, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();


var chart = new CanvasJS.Chart("chartPengeluaranPemasukan", {
	animationEnabled: true,
	title:{
    text: "Laporan Pemasukkan & Pengeluaran RT - <?= $this->session->userdata('rt')?>"
	},
	axisY: {
		title: "Jumlah (Rp.)",
		titleFontColor: "#4F81BC",
		lineColor: "#4F81BC",
		labelFontColor: "#4F81BC",
		tickColor: "#4F81BC"
	},
	// axisY2: {
	// 	title: "Millions of Barrels/day",
	// 	titleFontColor: "#C0504E",
	// 	lineColor: "#C0504E",
	// 	labelFontColor: "#C0504E",
	// 	tickColor: "#C0504E"
	// },
	toolTip: {
		shared: true
	},
	legend: {
		cursor:"pointer",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "column",
		name: "Pemasukan",
    markerSize: 5,
    showInLegend: true,
		visible: true,
		yValueFormatString: "Rp#,##0.##",
		dataPoints: <?php echo json_encode($jumlahPemasukan, JSON_NUMERIC_CHECK); ?>
	},
	{
		type: "column",
    name: "Pengeluaran",
    markerSize: 5,
    showInLegend: true,
		visible: true,
		yValueFormatString: "Rp#,##0.##",
		dataPoints: <?php echo json_encode($jumlahPengeluaran, JSON_NUMERIC_CHECK); ?>

	}]
});
chart.render();


function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible ){
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	chart.render();
}

}
</script>
