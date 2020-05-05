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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <div class="form-group form-input">
                        <label for="tahun">Tahun</label>
                        <select name="tahun" id="Tahun" class="form-control">
                            <option selected disabled>-- Pilih Tahun--</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <!-- <option value="Kesehatan">Kesehatan</option>
                            <option value="Duka Cita">Duka Cita</option>
                            <option value="Kebersihan">Kebersihan</option> -->
                            <!-- <option value="DIPLOMA II">DIPLOMA II</option>
                            <option value="AKADEMI/DIPLOMA III/S. MUDA">AKADEMI/DIPLOMA III/S. MUDA</option>
                            <option value="DIPLOMA IV/STRATA I">DIPLOMA IV/STRATA I</option>
                            <option value="STRATA II">STRATA II</option>
                            <option value="STRATA III">STRATA III</option> -->
                        </select>
                    </div>

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
                                <?php echo anchor('Bendahara/detail_iuran_masuk/'.$row->nik,'Detail');?>
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
