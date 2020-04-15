<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Komplain</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Komplain</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="bg-primary text-white text-center">
                      <th width="5%">No</th>
                      <th>Nomor Komplain</th>
                      <th>NIK</th>
                      <th>Nama Lengkap</th>
                      <th>Keluhan</th>
                      <th>Lokasi</th>
                      <th>Tanggal Komplain</th>
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
                        <td><?= $row['tanggal_komplain']?></td>
                        <td><a class="btn btn-primary" href="<?= base_url('ketuaRW/inputHasilKomplainRW/'. $row['nomor_komplain'])?>" <?php if($row['status'] == 'selesai') { ?> hidden <?php } ?>>Tindak Lanjut</a></td>
                      </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>