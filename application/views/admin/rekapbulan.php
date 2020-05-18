<div class="container-fluid">

<!-- Page Heading -->
<!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
-->
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Laporan Keuangan</h6>
    <center>
    <div class="form-group form-input">
            <form action="" method="GET">
              <table>
                <tr>
                  <td>

                    <select name="tahun" id="Tahun" class="form-control">
                      <?php
                        if(isset($_GET['tahun'])){
                          echo "<option selected='".$_GET['tahun']. "'>".$_GET['tahun']."</option>";
                        }else{
                      ?>
                      <option disabled='' selected=''> Tahun </option>

                      <?php
                        }
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
                    <input class='btn btn-primary' type="submit" value="Find">
                  </td>
                  <td>
                    <a class='btn btn-warning' href='<?php echo base_url(); ?>Bendahara/rekapbulan'> Show All </a>
                  </td>
                </tr>
              </table>
            </form>
            <?php
              if(isset($_GET['tahun'])){
                echo "<br><h3>Tahun ".$_GET['tahun']. "</h3>";
              }
            ?>
    </div>
  </center>
  </div>

  <div class="row px-3 my-3">

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Bulan</th>
            <th>Tahun </th>
            <th>Uang Masuk</th>
            <th>Uang Keluar</th>
            <th>Total</th>
          </tr>
        </thead>

        <tbody>
        <?php
        error_reporting(0);
          $no = 1;
          $total = 0;
          $totalsisa = 0;
         foreach ($masuk as $row) { ?>
           <tr>
             <td><?= $no ?> </td>

             <?php

             if($row->bulan == "01"){
               $bulan = 'Januari';
             }elseif($row->bulan == "02"){
               $bulan = 'Februari';
             }elseif($row->bulan == "03"){
               $bulan = 'Maret';
             }elseif($row->bulan == "04"){
               $bulan = 'April';
             }elseif($row->bulan == "05"){
               $bulan = 'Mei';
             }elseif($row->bulan == "06"){
               $bulan = 'Juni';
             }elseif($row->bulan == "07"){
               $bulan = 'Juli';
             }elseif($row->bulan == "08"){
               $bulan = 'Agustus';
             }elseif($row->bulan == "09"){
               $bulan = 'September';
             }elseif($row->bulan == "10"){
               $bulan = 'Oktober';
             }elseif($row->bulan == "11"){
               $bulan = 'November';
             }elseif($row->bulan == "12"){
               $bulan = 'Desember';
             }

            ?>
             <td><?= $bulan;?> </td>
             <td><?= $row->tahun;?></td>
             <?php
             // if($row->bulan == "Januari"){
             //   $bulan = '01';
             // }elseif($row->bulan == "Februari"){
             //   $bulan = '02';
             // }elseif($row->bulan == "Maret"){
             //   $bulan = '03';
             // }elseif($row->bulan == "April"){
             //   $bulan = '04';
             // }elseif($row->bulan == "Mei"){
             //   $bulan = '05';
             // }elseif($row->bulan == "Juni"){
             //   $bulan = '06';
             // }elseif($row->bulan == "Juli"){
             //   $bulan = '07';
             // }elseif($row->bulan == "Agustus"){
             //   $bulan = '08';
             // }elseif($row->bulan == "September"){
             //   $bulan = '09';
             // }elseif($row->bulan == "Oktober"){
             //   $bulan = '10';
             // }elseif($row->bulan == "November"){
             //   $bulan = '11';
             // }elseif($row->bulan == "Desember"){
             //   $bulan = '12';
             // }

             $filterMasuk = $this->m_admin->filteriuranmasuk($row->bulan,$row->tahun)->result();
             $filterKeluar = $this->m_admin->filteriurankeluar($row->bulan,$row->tahun)->result(); ?>

             <td>Rp. <?= number_format($filterMasuk[0]->nominal,2)?></td>
             <td>Rp. <?= number_format($filterKeluar[0]->nominal,2) ?></td>

             <?php

             $total = $filterMasuk[0]->nominal - $filterKeluar[0]->nominal;

             $totalsisa += $total;
             ?>

             <td>Rp. <?= number_format($totalsisa,2) ?></td>
           </tr>
        <?php
       $no++;
       }

      ?>
        </tbody>
        <?php
        if(empty($_GET['tahun'])){
        ?>
                  <p align=right> Sisa Saldo <h2 align=right><b> Rp. <?= number_format($totalsisa,2); ?> </b> </h2></p>
        <?php
        }
        ?>
      </table>

    </div>
      </div>
    </div>
    </div>
</div>
