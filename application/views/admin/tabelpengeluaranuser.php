<div class="container-fluid">

<!-- Page Heading -->
<!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
-->
<!-- DataTales Example -->
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>

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
                    <a class='btn btn-warning' href='<?php echo base_url(); ?>Bendahara/tabeldataiurankeluaruser'> Tampilkan Semua </a>
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
                echo "<br><h3>".$bulan." - ".$_GET['tahun']."</h3>";
              }
            ?>
    </div>
  </center>
  </div>
  <br>
  <div id="JumlahPengeluaran" style="height: 370px; width: 100%;"></div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Anggaran</th>
            <th>Tanggal</th>
            <th>Nominal </th>
            <th>Keterangan</th>
            <th>Gambar</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $no = 1;
          $sum = 0;
          foreach($dataiurank as $b){
        ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $b['diberikan_kepada']; ?></td>
            <td><?= date('d-m-Y', strtotime($b['tanggal'])); ?></td>
            <td>Rp. <?= number_format ($b['nominal'],2); ?></td>
            <td><?= $b['digunakan_untuk'] ?></td>
            <td>
              <img id="myImg<?= $b['no_pengeluaran']?>" src="<?= base_url('/uploads/gambar/'.$b['gambar']);?>" alt="<?= $b['digunakan_untuk']?>" height="50px" width="50px" style="cursor:pointer">
            </td>
          </tr>
          <script>
          var modal = document.getElementById("myModal");

          // Get the image and insert it inside the modal - use its "alt" text as a caption
          var img = document.getElementById("myImg<?= $b['no_pengeluaran']?>");
          var modalImg = document.getElementById("img01");
          var captionText = document.getElementById("caption");
          img.onclick = function(){
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
          }

          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("close")[0];

          // When the user clicks on <span> (x), close the modal
          span.onclick = function() {
            modal.style.display = "none";
          }
          </script>
        <?php
        $sum += $b['nominal'];
        }
        ?>
        </tbody>
        <p align="right"> <b>Total Pengeluaran </b> : </p> <h3 align="right"> Rp. <?php echo number_format($sum,2) ;?></h3>
      </table>
    </div>
  </div>
</div>
</div>
<style>
/* Style the Image Used to Trigger the Modal */
    #myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
    }

    #myImg:hover {opacity: 0.7;}

    /* The Modal (background) */
    .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    /* z-index: 1; /* Sit on top */ */
    padding-top: 100px; /* Location of the box */
    left : 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    /* Modal Content (Image) */
    .modal-content {
    margin: auto;
    display: block;
    width: 100%;
    max-width: 800px;
    border-radius: 25px;
    }

    /* Caption of Modal Image (Image Text) - Same Width as the Image */
    #caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
    }

    /* Add Animation - Zoom in the Modal */
    .modal-content, #caption {
    animation-name: zoom;
    animation-duration: 0.6s;
    }

    @keyframes zoom {
    from {transform:scale(0)}
    to {transform:scale(1)}
    }

    /* The Close Button */
    .close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
    }

    .close:hover,
    .close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
    .modal-content {
      width: 100%;
    }
    }
</style>
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
