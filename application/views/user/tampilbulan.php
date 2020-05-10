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
                        foreach ($iuran as $row) { 
                        $bulan = date('m');
                        ?>
                        <tr>
                            <td><?= $no ?></td>
                            <!-- <td>NIK</td> -->
                            <td><?= $row->nama_warga ?></td>
                            <td><?= $bulan >= 1 ? $row->bulan_januari : null ?></td>
                            <td><?= $bulan >= 2 ? $row->bulan_februari : null ?></td>
                            <td><?= $bulan >= 3 ? $row->bulan_maret : null ?></td>
                            <td><?= $bulan >= 4 ? $row->bulan_april : null ?></td>
                            <td><?= $bulan >= 5 ? $row->bulan_mei : null ?></td>
                            <td><?= $bulan >= 6 ? $row->bulan_juni : null ?></td>
                            <td><?= $bulan >= 7 ? $row->bulan_juli : null ?></td>
                            <td><?= $bulan >= 8 ? $row->bulan_agustus : null ?></td>
                            <td><?= $bulan >= 9 ? $row->bulan_september : null ?></td>
                            <td><?= $bulan >= 10 ? $row->bulan_oktober : null ?></td>
                            <td><?= $bulan >= 11 ? $row->bulan_november : null ?></td>
                            <td><?= $bulan >= 12 ? $row->bulan_desember : null ?></td>
                            <td>
                                <?php 
                                if($row->jenis_warga == "Tetap"){
                                    echo ($bulan * 15000) - $row->jumlah_iuran < 0 ? 
                                        0 : ($bulan * 15000) - $row->jumlah_iuran;
                                } elseif ($row->jenis_warga == "Sementara") {
                                    echo ($bulan * 10000) - $row->jumlah_iuran < 0 ? 
                                        0 : ($bulan * 10000) - $row->jumlah_iuran;
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo anchor('user/detail_iuran_masuk/'.$row->nik,'Detail');?>
                            </td>
                        </tr>
                        <?php
                        $no++;
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
