<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Iuran Bulanan  </h6>
          
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
                            <a class='btn btn-warning' href='<?php echo base_url(); ?>user/tampilbulanuser'> Show All </a>
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
                            <th>No Rumah</th>
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
                            <!-- <th>Aksi</th> -->
                            <!-- <th>Aksi</th> -->
                        </tr>
                    </thead>

                    <tbody>
                            <?php
                            $no = 1;
                            foreach ($iuranTahun as $row) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <!-- <td>NIK</td> -->
                                    <td><?= $row->no_rumah ?></td>
                                    <td>Rp. <?= number_format($row->bulan_januari, 2); ?></td>
                                    <td>Rp. <?= number_format($row->bulan_februari, 2); ?></td>
                                    <td>Rp. <?= number_format($row->bulan_maret, 2); ?></td>
                                    <td>Rp. <?= number_format($row->bulan_april, 2); ?></td>
                                    <td>Rp. <?= number_format($row->bulan_mei, 2); ?></td>
                                    <td>Rp. <?= number_format($row->bulan_juni, 2); ?></td>
                                    <td>Rp. <?= number_format($row->bulan_juli, 2); ?></td>
                                    <td>Rp. <?= number_format($row->bulan_agustus, 2); ?></td>
                                    <td>Rp. <?= number_format($row->bulan_september, 2); ?></td>
                                    <td>Rp. <?= number_format($row->bulan_oktober, 2); ?></td>
                                    <td>Rp. <?= number_format($row->bulan_november, 2); ?></td>
                                    <td>Rp. <?= number_format($row->bulan_desember, 2); ?></td>
                                    <td>
                                        <?php

                                        $tarif = $this->m_admin->tampilTarif($row->jenis_warga)->result();
                                        $tahunsekarang = date('Y');
                                        $selisihterbayar = 0;
                                        $januari = 0;
                                        $februari = 0;
                                        $maret = 0;
                                        $april = 0;
                                        $mei = 0;
                                        $juni = 0;
                                        $juli = 0;
                                        $agustus = 0;
                                        $september = 0;
                                        $oktober = 0;
                                        $november = 0;
                                        $desember = 0;
                                        $tunggakan = 0;
                                        $dataTunggakan = $this->m_admin->getTunggakanPerPeriode('01', $selectedTahun, $row->jenis_warga)->row()->nominal;

                                        if ($row->bulan_januari == null && ((int) date('m') >= 1 || (int) date('Y') != $selectedTahun)) {
                                            // $januari = $tarif[0]->nominal-$row->bulan_januari;
                                            $tunggakan += $this->m_admin->getTunggakanPerPeriode('01', $selectedTahun, $row->jenis_warga)->row()->nominal;
                                        }
                                        if ($row->bulan_februari == null && ((int) date('m') >= 2 || (int) date('Y') != $selectedTahun)) {
                                            // $februari = $tarif[0]->nominal-$row->bulan_februari;
                                            $tunggakan += $this->m_admin->getTunggakanPerPeriode('02', $selectedTahun, $row->jenis_warga)->row()->nominal;
                                        }
                                        if ($row->bulan_maret == null && ((int) date('m') >= 3 || (int) date('Y') != $selectedTahun)) {
                                            // $maret = $tarif[0]->nominal-$row->bulan_maret;
                                            $tunggakan += $this->m_admin->getTunggakanPerPeriode('03', $selectedTahun, $row->jenis_warga)->row()->nominal;
                                        }
                                        if ($row->bulan_april == null && ((int) date('m') >= 4 || (int) date('Y') != $selectedTahun)) {
                                            // $april = $tarif[0]->nominal-$row->bulan_april;
                                            $tunggakan += $this->m_admin->getTunggakanPerPeriode('04', $selectedTahun, $row->jenis_warga)->row()->nominal;
                                        }
                                        if ($row->bulan_mei == null && ((int) date('m') >= 5 || (int) date('Y') != $selectedTahun)) {
                                            // $mei = $tarif[0]->nominal-$row->bulan_mei;
                                            $tunggakan += $this->m_admin->getTunggakanPerPeriode('05', $selectedTahun, $row->jenis_warga)->row()->nominal;
                                        }
                                        if ($row->bulan_juni == null && ((int) date('m') >= 6 || (int) date('Y') != $selectedTahun)) {
                                            // $juni = $tarif[0]->nominal-$row->bulan_juni;
                                            $tunggakan += $this->m_admin->getTunggakanPerPeriode('06', $selectedTahun, $row->jenis_warga)->row()->nominal;
                                        }
                                        if ($row->bulan_juli == null && ((int) date('m') >= 7 || (int) date('Y') != $selectedTahun)) {
                                            // $juli = $tarif[0]->nominal-$row->bulan_juli;
                                            $tunggakan += $this->m_admin->getTunggakanPerPeriode('07', $selectedTahun, $row->jenis_warga)->row()->nominal;
                                        }
                                        if ($row->bulan_agustus == null && ((int) date('m') >= 8 || (int) date('Y') != $selectedTahun)) {
                                            // $agustus = $tarif[0]->nominal-$row->bulan_agustus;
                                            $tunggakan += $this->m_admin->getTunggakanPerPeriode('08', $selectedTahun, $row->jenis_warga)->row()->nominal;
                                        }
                                        if ($row->bulan_september == null && ((int) date('m') >= 9 || (int) date('Y') != $selectedTahun)) {
                                            // $september = $tarif[0]->nominal-$row->bulan_september;
                                            $tunggakan += $this->m_admin->getTunggakanPerPeriode('09', $selectedTahun, $row->jenis_warga)->row()->nominal;
                                        }
                                        if ($row->bulan_oktober == null && ((int) date('m') >= 10 || (int) date('Y') != $selectedTahun)) {
                                            // $oktober = $tarif[0]->nominal-$row->bulan_oktober;
                                            $tunggakan += $this->m_admin->getTunggakanPerPeriode('10', $selectedTahun, $row->jenis_warga)->row()->nominal;
                                        }
                                        if ($row->bulan_november == null && ((int) date('m') >= 11 || (int) date('Y') != $selectedTahun)) {
                                            // $november = $tarif[0]->nominal-$row->bulan_november;
                                            $tunggakan += $this->m_admin->getTunggakanPerPeriode('11', $selectedTahun, $row->jenis_warga)->row()->nominal;
                                        }
                                        if ($row->bulan_desember == null && ((int) date('m') >= 12 || (int) date('Y') != $selectedTahun)) {
                                            // $desember = $tarif[0]->nominal-$row->bulan_desember;
                                            $tunggakan += $this->m_admin->getTunggakanPerPeriode('12', $selectedTahun, $row->jenis_warga)->row()->nominal;
                                        }

                                        $selisihterbayar = $januari + $februari + $maret + $april + $mei + $juni + $juli + $agustus + $september + $oktober + $november + $desember;

                                        if ($row->tahun < $tahunsekarang) {
                                            if ($tarif[0]->nominal != null) {
                                                $bulan = 12;
                                                $jumlahharusdibayar = $bulan * $tarif[0]->nominal;
                                                $total = ($row->jumlah_iuran - $jumlahharusdibayar) + $selisihterbayar;
                                                echo "Rp. " . number_format($tunggakan, 2);
                                            } else {
                                                echo "Tarif Tidak Tersedia";
                                            }
                                        } else {
                                            if ($tarif[0]->nominal != null) {
                                                $bulan = date('n');
                                                $jumlahharusdibayar = $bulan * $tarif[0]->nominal;
                                                $total = ($row->jumlah_iuran - $jumlahharusdibayar) + $selisihterbayar;
                                                echo "Rp. " . number_format($tunggakan, 2);
                                            } else {
                                                echo "Tarif Tidak Tersedia";
                                            }
                                        }
                                        ?>
                                    </td>
                                    <!-- <td>
                                        <a href="<?php echo base_url(); ?>user/detail_iuran_masuk?norumah=<?php echo $row->no_rumah; ?>&tahun=<?php echo $row->tahun; ?>"> Detail
                                    </td> -->
                                </tr>
                            <?php
                                $no++;
                            }
                        } else { ?>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <!-- <th>NIK</th> -->
                                    <th>No Rumah</th>
                                    <th>Jumlah Iuran</th>
                                    <!-- <th>Tunggakan</th> -->
                                    <!-- <th>Aksi</th> -->
                                </tr>
                            </thead>
                        <tbody>
                            <?php
                            ini_set("display_errors", 0);
                            $no = 1;
                            foreach ($iuran as $row) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <!-- <td>NIK</td> -->
                                    <td><?= $row->no_rumah ?></td>
                                    <td>Rp. <?= number_format($row->jumlah_iuran, 2); ?></td>
                                    <td>
                                        <?php

                                        $batas = date_create('2020-12-01');
                                        $waktusekarang = date_create(date('Y-m-d'));
                                        $selisih = date_diff($waktusekarang, $batas);
                                        $tarif = $this->m_admin->tampilTarif($row->jenis_warga)->result();

                                        $realtimeYear = date('Y');
                                        $januari = 0;
                                        $februari = 0;
                                        $maret = 0;
                                        $april = 0;
                                        $mei = 0;
                                        $juni = 0;
                                        $juli = 0;
                                        $agustus = 0;
                                        $september = 0;
                                        $oktober = 0;
                                        $november = 0;
                                        $desember = 0;
                                        $jumlahselisih = 0;
                                        $tunggakan = 0;

                        //                 for ($i = 2018; $i <= $realtimeYear; $i++) {
                        //                     $cekbelumbayar = $this->m_admin->detailBulan($row->no_rumah, $i)->result();
                        //                     if ($cekbelumbayar[0]->bulan_januari == null && ($realtimeYear <= (int) date('Y') && date('m') < 1)) {
                        //                         $januari += $tarif[0]->nominal;
                        //                         $tunggakan += $this->m_admin->getTunggakanPerPeriode('01', $realtimeYear, $row->jenis_warga)->row()->nominal;
                        //                     }
                        //                     if ($cekbelumbayar[0]->bulan_februari == null && ($realtimeYear <= (int) date('Y') && date('m') < 2)) {
                        //                         $februari += $tarif[0]->nominal;
                        //                         $tunggakan += $this->m_admin->getTunggakanPerPeriode('02', $realtimeYear, $row->jenis_warga)->row()->nominal;
                        //                     }
                        //                     if ($cekbelumbayar[0]->bulan_maret == null && ($realtimeYear <= (int) date('Y') && date('m') < 3)) {
                        //                         $maret += $tarif[0]->nominal;
                        //                         $tunggakan += $this->m_admin->getTunggakanPerPeriode('03', $realtimeYear, $row->jenis_warga)->row()->nominal;
                        //                     }
                        //                     if ($cekbelumbayar[0]->bulan_april == null && ($realtimeYear <= (int) date('Y') && date('m') < 4)) {
                        //                         $april += $tarif[0]->nominal;
                        //                         $tunggakan += $this->m_admin->getTunggakanPerPeriode('04', $realtimeYear, $row->jenis_warga)->row()->nominal;
                        //                     }
                        //                     if ($cekbelumbayar[0]->bulan_mei == null && ($realtimeYear <= (int) date('Y') && date('m') < 5)) {
                        //                         $mei += $tarif[0]->nominal;
                        //                         $tunggakan += $this->m_admin->getTunggakanPerPeriode('05', $realtimeYear, $row->jenis_warga)->row()->nominal;
                        //                     }
                        //                     if ($cekbelumbayar[0]->bulan_juni == null && ($realtimeYear <= (int) date('Y') && date('m') < 6)) {
                        //                         $juni += $tarif[0]->nominal;
                        //                         $tunggakan += $this->m_admin->getTunggakanPerPeriode('06', $realtimeYear, $row->jenis_warga)->row()->nominal;
                        //                     }
                        //                     if ($cekbelumbayar[0]->bulan_juli == null && ($realtimeYear <= (int) date('Y') && date('m') < 7)) {
                        //                         $juli += $tarif[0]->nominal;
                        //                         $tunggakan += $this->m_admin->getTunggakanPerPeriode('07', $realtimeYear, $row->jenis_warga)->row()->nominal;
                        //                     }
                        //                     if ($cekbelumbayar[0]->bulan_agustus == null && ($realtimeYear <= (int) date('Y') && date('m') < 8)) {
                        //                         $agustus += $tarif[0]->nominal;
                        //                         $tunggakan += $this->m_admin->getTunggakanPerPeriode('08', $realtimeYear, $row->jenis_warga)->row()->nominal;
                        //                     }
                        //                     if ($cekbelumbayar[0]->bulan_september == null && ($realtimeYear <= (int) date('Y') && date('m') < 9)) {
                        //                         $september += $tarif[0]->nominal;
                        //                         $tunggakan += $this->m_admin->getTunggakanPerPeriode('09', $realtimeYear, $row->jenis_warga)->row()->nominal;
                        //                     }
                        //                     if ($cekbelumbayar[0]->bulan_oktober == null && ($realtimeYear <= (int) date('Y') && date('m') < 10)) {
                        //                         $oktober += $tarif[0]->nominal;
                        //                         $tunggakan += $this->m_admin->getTunggakanPerPeriode('10', $realtimeYear, $row->jenis_warga)->row()->nominal;
                        //                     }
                        //                     if ($cekbelumbayar[0]->bulan_november == null && ($realtimeYear <= (int) date('Y') && date('m') < 11)) {
                        //                         $november += $tarif[0]->nominal;
                        //                         $tunggakan += $this->m_admin->getTunggakanPerPeriode('11', $realtimeYear, $row->jenis_warga)->row()->nominal;
                        //                     }
                        //                     if ($cekbelumbayar[0]->bulan_desember == null && ($realtimeYear <= (int) date('Y') && date('m') < 12)) {
                        //                         $desember += $tarif[0]->nominal;
                        //                         $tunggakan += $this->m_admin->getTunggakanPerPeriode('12', $realtimeYear, $row->jenis_warga)->row()->nominal;
                        //                     }
                        //                 }

                        //                 $jumlahbulan = (($selisih->y * 12) + ($selisih->m + 1));
                        //                 $jumlahselisih = $jumlahbulan * $tarif[0]->nominal;

                        //                 $jumlahharusdibayar = ($januari + $februari + $maret + $april + $mei + $juni + $juli + $agustus + $september + $oktober + $november + $desember) - $jumlahselisih;



                        //                 if ($tarif[0]->nominal != null) {
                        //                     // $total = $row->jumlah_iuran - $jumlahharusdibayar;
                        //                     echo "Rp. - " . number_format($tunggakan, 2);
                        //                 } else {
                        //                     echo "Tarif Tidak Tersedia";
                        //                 }

                        //                 ?>
                                   <!-- </td> -->
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