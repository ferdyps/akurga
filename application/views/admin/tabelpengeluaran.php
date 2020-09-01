<div class="container-fluid">

<!-- Page Heading -->
<!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
-->
<!-- DataTales Example -->



<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tabel Pengeluaran RT.<?= $this->session->userdata('rt'); ?></h6>
    <center>
    <div class="form-group form-input">
            <form action="" method="GET">
              <table>
                <tr>
                  <td>
                    <select name="bulan" class="form-control" required>
                      <option disabled='' selected=''> Bulan </option>
                      <option value="01"> Januari </option>
                      <option value="02"> Februari </option>
                      <option value="03"> Maret </option>
                      <option value="04"> April </option>
                      <option value="05"> Mei </option>
                      <option value="06"> Juni </option>
                      <option value="07"> Juli </option>
                      <option value="08"> Agustus </option>
                      <option value="09"> September </option>
                      <option value="10"> Oktober </option>
                      <option value="11"> November </option>
                      <option value="12"> Desember </option>
                    </select>
                  </td>
                  <td>
                    <select name="tahun" id="Tahun" class="form-control" required>
                      <option disabled='' selected=''> Tahun </option>
                      <?php
                        $realtimeYear = date('Y');
                        for ($i = $realtimeYear; $i >= 2018; $i--) {
                        ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php
                        }
                      ?>
                    </select>
                  </td>
                  <td>
                    <input class='btn btn-primary' type="submit" value="Cari">
                  </td>
                  <td>
                    <a class='btn btn-warning' href='<?php echo base_url(); ?>Bendahara/tabeldataiurankeluar'> Tampilkan Semua </a>
                    <a class="btn btn-success"  href="<?= base_url(); ?>Bendahara/formpengeluaran"> + Tambah pengeluaran </a>
                  </td>
                </tr>
              </table>
            </form>
            <?php
              if(isset($_GET['tahun'])){
                if($_GET['bulan'] == "01"){
                  $bulan = 'Januari';
                }elseif($_GET['bulan'] == "02"){
                  $bulan = 'Februari';
                }elseif($_GET['bulan'] == "03"){
                  $bulan = 'Maret';
                }elseif($_GET['bulan'] == "04"){
                  $bulan = 'April';
                }elseif($_GET['bulan'] == "05"){
                  $bulan = 'Mei';
                }elseif($_GET['bulan'] == "06"){
                  $bulan = 'Juni';
                }elseif($_GET['bulan'] == "07"){
                  $bulan = 'Juli';
                }elseif($_GET['bulan'] == "08"){
                  $bulan = 'Agustus';
                }elseif($_GET['bulan'] == "09"){
                  $bulan = 'September';
                }elseif($_GET['bulan'] == "10"){
                  $bulan = 'Oktober';
                }elseif($_GET['bulan'] == "11"){
                  $bulan = 'November';
                }elseif($_GET['bulan'] == "12"){
                  $bulan = 'Desember';
                }
                echo "<br><h3> ".$bulan." - ".$_GET['tahun']. "</h3>";
              }
            ?>
    </div>
  </center>
  </div>

  <a href="#" data-toggle="modal"  data-target="#cetakLaporanPengeluaran" target="_BLANK" class="btn btn-primary">Cetak Laporan</a>
  <br>
  <div id="JumlahPengeluaran" style="height: 370px; width: 100%;"></div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <!-- <th>NO Pengeluaran</th> -->
            <!-- <th>Diberikan Kepada</th> -->
            <th>Mata Anggaran</th>
            <th>Tanggal</th>
            <th>Nominal</th>
            <th>Keterangan</th>
            <!-- <th>Gambar</th> -->
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
        <?php
          $no = 1;
          $sum=0;
          foreach($dataiurank as $b){
        ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <!-- <td><?php echo $b['no_pengeluaran']; ?></td>    -->
            <td><?php echo $b['diberikan_kepada']; ?></td>
            <td><?php echo date('d-m-Y', strtotime($b['tanggal'])); ?></td>
            <td>Rp. <?php echo number_format ($b['nominal'],2); ?></td>
            <td><?php echo $b['digunakan_untuk'] ?></td>
            <!-- <td><?php echo $b['gambar'] ?></td> -->
            <!-- <td><img src="<?php echo base_url('/uploads/gambar/'.$b['gambar']);?>" height="50px" width="50px"></td> -->
            <td>
            <?php $sum=$sum+$b['nominal']?>
              <?php echo anchor('Bendahara/edit_iuran_keluar/'.$b['no_pengeluaran'],'Edit'); ?> | |
                 <?php echo anchor('Bendahara/detail_iuran_keluar/'.$b['no_pengeluaran'],'Detail'); ?> | |
                 <?php echo anchor('Bendahara/hapus_iuran_keluar/'.$b['no_pengeluaran'],'Hapus'); ?>
            </td>
          </tr>
        <?php } ?>
        </tbody>
        <p align="right"> <b>Total Pengeluaran </b> : </p> <h3 align="right"> Rp. <?php echo number_format($sum,2) ;?></h3>
      </table>
</div>
  </div>
</div>
</div>

<script>
window.onload = function() {

  var chart = new CanvasJS.Chart("JumlahPengeluaran", {
	title: {
		text: "Pengeluaran RT-<?= $this->session->userdata('rt')?>"
	},
	axisY: {
		title: "Jumlah (Rp.)"
	},
    <?php
    if(!empty($_GET['bulan'])){?>
      axisX: {
    		title: "Tanggal"
    	},
    <?php
    }else{?>
      axisX: {
    		title: "Tahun"
    	},
    <?php
    }?>
	data: [{
		type: "spline",
		dataPoints: <?php echo json_encode($jumlahPengeluaran, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

}
</script>
