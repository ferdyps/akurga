<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Riwayat Usulan Rapat Ketua RT/RW</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Riwayat Usulan Rapat Ketua RT/RW</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="bg-primary text-white text-center">
                      <th width="5%">No</th>
                      <th>Usulan Rapat</th>
                      <th>Ditujukan Kepada</th>
                      <th>Tanggal Rapat</th>
                      <th>Tempat Rapat</th>
                      <th>Jam Rapat</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <?php
                  $i = 1;
                  foreach ($list_data as $row) {
                  ?>
                  <tbody class="text-center">
                    <td><?= $i++ ?></td>
                    <td><?= $row['usulan_rpt'] ?></td>
                    <td><?= $row['tujuan_surat'] ?></td>
                    <td><?= $row['tgl_udg'] ?></td>
                    <td><?= $row['tempat_udg'] ?></td>
                    <td><?= $row['jam_udg'] ?></td>
                    <td>
                      <button class="btn btn-primary" onclick="konfirmasi_data('<?= base_url('admin/klik_konfirmasi_usulan_rapat/')?>', '<?= $row['no_udg']; ?>' )">Approval</button>
                    </td>
                  </tbody>
                <?php } ?>
                </table>
              </div>
            </div>
          </div>
        </div>
