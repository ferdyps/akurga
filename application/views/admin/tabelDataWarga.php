<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Warga</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Warga</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Pendidikan</th>
                        <th>Pekerjaan</th>
                        <th>Agama</th>
                        <th>Jenis Kelamin</th>
                        <th>Status</th>
                        <th>Jenis Warga</th>
                        <th>Nomor HP</th>
                        <th>Nomor KK</th>
                        <th>Hubungan Dalam Keluarga</th>
                        <th>Nomor Rumah</th>
                        <th>Gang</th>
                    </tr>
                  </thead>
                  <?php foreach($list_warga_semua as $row){?>
                  <tbody>
                      <tr>
                        <td><?= $row['nik']?></td>
                        <td><?= $row['nama']?></td>
                        <td><?= $row['tempat_lahir']?></td>
                        <td><?= $row['tanggal_lahir']?></td>
                        <td><?= $row['pendidikan']?></td>
                        <td><?= $row['pekerjaan']?></td>
                        <td><?= $row['agama']?></td>
                        <td><?= $row['jk']?></td>
                        <td><?= $row['status']?></td>
                        <td><?= $row['jenis_warga']?></td>
                        <td><?= $row['nohp']?></td>
                        <td><?= $row['nokk']?></td>
                        <td><?= $row['hub_dlm_kel']?></td>
                        <td><?= $row['no_rumah']?></td>
                        <td><?= $row['gang']?></td>
                      </tr>
                  </tbody>
                  <?php } ?>
                </table>
              </div>
            </div>
          </div>

        </div>