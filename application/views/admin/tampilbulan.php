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
                        ?>
                        <tr>
                            <td><?= $no ?></td>
                            <!-- <td>NIK</td> -->
                            <td><?= $row->nama_warga ?></td>
                            <td><?= $row->bulan_januari ?></td>
                            <td><?= $row->bulan_februari ?></td>
                            <td><?= $row->bulan_maret ?></td>
                            <td><?= $row->bulan_april ?></td>
                            <td><?= $row->bulan_mei ?></td>
                            <td><?= $row->bulan_juni ?></td>
                            <td><?= $row->bulan_juli ?></td>
                            <td><?= $row->bulan_agustus ?></td>
                            <td><?= $row->bulan_september ?></td>
                            <td><?= $row->bulan_oktober ?></td>
                            <td><?= $row->bulan_november ?></td>
                            <td><?= $row->bulan_desember ?></td>
                            <td>
                                <?php 
                                if($row->jenis_warga == "Tetap"){
                                    echo (12 * 15000) - $row->jumlah_iuran < 0 ? 
                                        0 : (12 * 15000) - $row->jumlah_iuran;
                                } elseif ($row->jenis_warga == "Sementara") {
                                    echo (12 * 10000) - $row->jumlah_iuran < 0 ? 
                                        0 : (12 * 10000) - $row->jumlah_iuran;
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo anchor('admin/detail_iuran_masuk/'.$row->nik,'Detail');?>
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
