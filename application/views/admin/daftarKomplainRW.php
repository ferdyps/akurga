<?php
setlocale(LC_ALL, 'id-ID', 'id_ID');
?>
<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Pengaduan</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Pengaduan</h6>
            </div>
            <div class="card-body">
              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-pengaduan-tab" data-toggle="tab" href="#nav-pengaduan" role="tab" aria-controls="nav-pengaduan" aria-selected="true">Pengaduan</a>
                  <a class="nav-item nav-link" id="nav-tindak_lanjut-tab" data-toggle="tab" href="#nav-tindak_lanjut" role="tab" aria-controls="nav-tindak_lanjut" aria-selected="false">Tindak Lanjut</a>
                </div>
              </nav>
              <div class="tab-content pt-3" id="nav-tabContent">

                <div class="tab-pane fade show active" id="nav-pengaduan" role="tabpanel" aria-labelledby="nav-pengaduan-tab">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr class="bg-primary text-white text-center">
                          <th class="w-5">No</th>
                          <th>Nomor Komplain</th>
                          <th>NIK</th>
                          <th>Nama Lengkap</th>
                          <th>Keluhan</th>
                          <th>Lokasi</th>
                          <th>Tanggal Komplain</th>
                          <th>Gambar</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      <?php
                        $i=1; 
                        foreach($list_komplain as $row)
                      {?>
                          <tr>
                            <td><?= $i++?></td>
                            <td><?= $row['nomor_komplain']?></td>
                            <td><?= $row['nik']?></td>
                            <td><?= $row['nama']?></td>
                            <td><?= $row['keluhan']?></td>
                            <td><?= $row['lokasi']?></td>
                            <td><?= strftime("%d %B %Y", strtotime($row['tanggal_komplain']))?></td>
                            <td class="text-center"><img width="40%" class="rounded" src="<?= base_url('./assets/foto/komplain/'.$row['gambar'])?>"></td>
                            <td><a class="btn btn-primary" href="<?= base_url('ketuaRW/inputHasilKomplainRW/'. $row['nomor_komplain'])?>" <?php if($row['status'] == 'selesai') { ?> hidden <?php } ?>>Tindak Lanjut</a></td>
                          </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="tab-pane fade show" id="nav-tindak_lanjut" role="tabpanel" aria-labelledby="nav-tindak_lanjut-tab">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dataTable2" width="100%" cellspacing="0">
                      <thead>
                        <tr class="bg-primary text-white text-center">
                          <th class="w-5">No</th>
                          <th>Nomor Komplain</th>
                          <th>Tindak Lanjut</th>
                          <th>Tanggal Tindak Lanjut</th>
                          <th>Gambar</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      <?php
                        $i=1;
                        // setlocale(LC_ALL, 'id-ID', 'id_ID');
                        foreach($list_tindak_lanjut as $row)
                      {?>
                          <tr>
                            <td><?= $i++?></td>
                            <td><?= $row['nomor_komplain']?></td>
                            <td><?= $row['hasil_tindak_lanjut']?></td>
                            <td><?= strftime("%d %B %Y", strtotime($row['tgl_tindak_lanjut']))?></td>
                            <td class="text-center"><img width="40%" class="rounded" src="<?= base_url('./assets/foto/tindak_lanjut/'.$row['gambar'])?>"></td>
                          </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>