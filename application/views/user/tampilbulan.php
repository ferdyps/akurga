<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Rekap Bulan  </h6>
          
        </div>
        <div class="card-body">
        <center>
            <div class="form-group form-input">
                    <form action="" method="GET">
                      <table>
                        <tr>
                          <td>

                            <select name="tahun" id="Tahun" class="form-control">
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
                            <input class='btn btn-primary' type="submit" value="Find">
                          </td>
                          <td>
                            <a class='btn btn-warning' href='<?php echo base_url(); ?>user/tampilbulan'> Show All </a>
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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                  <?php
                  ini_set( "display_errors", 0);
                  if(isset($_GET['tahun'])){
              ?>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <!-- <th>NIK</th> -->
                            <th>Nama</th>
                            <th>Januari</th>
                            <th>Februari</th>
                            <th>Maret</th>
                            <th>April</th>
                            <th>Mei</th>
                            <th>Juni</th>
                            <th>Juli</th>
                            <th>Agustus</th>
                            <th>September</th>
                            <th>Oktober</th>
                            <th>November</th>
                            <th>Desember</th>
                            <th>Tunggakan</th>
                            <th>Aksi</th>
                            <!-- <th>Aksi</th> -->
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($iuranTahun as $row) { 
                        // $bulan = date('m');
                        ?>
                        <tr>
                            <td><?= $no ?></td>
                            <!-- <td>NIK</td> -->
                            <td><?= $row->nama_warga ?></td>
                            <td><?= $row->bulan_januari  ?></td>
                            <td><?= $row->bulan_februari  ?></td>
                            <td><?= $row->bulan_maret  ?></td>
                            <td><?= $row->bulan_april  ?></td>
                            <td><?= $row->bulan_mei  ?></td>
                            <td><?= $row->bulan_juni  ?></td>
                            <td><?= $row->bulan_juli  ?></td>
                            <td><?= $row->bulan_agustus  ?></td>
                            <td><?= $row->bulan_september  ?></td>
                            <td><?= $row->bulan_oktober  ?></td>
                            <td><?= $row->bulan_november  ?></td>
                            <td><?= $row->bulan_desember  ?></td>
                            <td>
                                 <?php
                                            $tarif = $this->m_user->tampilTarif($row->jenis_warga)->result();
                                            $tahunsekarang = date('Y');
                                            if($row->tahun < $tahunsekarang){
                                              $bulan = 12;
                                              $jumlahharusdibayar = $bulan * $tarif[0]->nominal;
                                              $total = $row->jumlah_iuran - $jumlahharusdibayar;
                                                echo "Rp. ". $total;
                                            }else{
                                            $bulan = date('n');
                                            $jumlahharusdibayar = $bulan * $tarif[0]->nominal;
                                            $total = $row->jumlah_iuran - $jumlahharusdibayar;
                                              echo "Rp. ".$total;
                                            }
                                  ?>
                            </td>
                            <td>
                            <a href="<?php echo base_url(); ?>user/detail_iuran_masuk?nik=<?php echo $row->nik;?>&tahun=<?php echo $row->tahun; ?>"> Detail     
                            </td>
                        </tr>
                        <?php
                        $no++;
                        } 
                       }else{  ?>
                       <thead>
                              <tr>
                                  <th>NO</th>
                                  <th>Nama</th>
                                  <th>Jumlah Iuran</th>
                                  <th>Tunggakan</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                                  ini_set( "display_errors", 0);
                                  $no = 1;
                                  foreach ($iuran as $row) {
                                  ?>
                                  <tr>
                                      <td><?= $no ?></td>
                                      <!-- <td>NIK</td> -->
                                      <td><?= $row->nama_warga ?></td>
                                      <td><?= $row->jumlah_iuran ?></td>
                                      <td>
                                          <?php
                                            $batas = date_create('2018-01-01');
                                            $waktusekarang = date_create(date('Y-m-d'));
                                            $selisih = date_diff($batas, $waktusekarang);
                                            $jumlahbulan = (($selisih->y * 12) + ($selisih->m+1));

                                            $tarif = $this->m_admin->tampilTarif($row->jenis_warga)->result();

                                            if($row->jenis_warga = "Tetap"){
                                                $jumlahharusdibayar = $jumlahbulan * $tarif[0]->nominal;
                                                $total = $row->jumlah_iuran - $jumlahharusdibayar;
                                                echo "Rp. ".$total;
                                            }else{
                                              $total = $jumlahbulan * $tarif[0]->nominal;
                                              $total = $row->jumlah_iuran - $jumlahharusdibayar;
                                              echo "Rp. ".$total;
                                            }
                                          ?>
                                      </td>
                                  </tr>
                                  <?php
                                  $no++;
                                  }
                                }
                                  ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
