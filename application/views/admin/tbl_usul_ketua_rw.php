<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Riwayat Usulan Rapat Ketua RW</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Riwayat Usulan Rapat Ketua RW</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="bg-primary text-white text-center">
                      <th width="5%">No</th>
                      <th>Jenis Surat</th>
                      <th>Usulan Rapat</th>
                      <th>Pihak Yang Diundang</th>
                      <th>Tanggal Rapat</th>
                      <th>Tempat Rapat</th>
                      <th>Jam Rapat</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                    $i = 1;
                    foreach ($list_data as $row) {
                      ?>
                      <tr>
                        <td><?= $i++ ?></td>
                        <?php $set = substr($row['no_udg'],4,3); ?>
                        <?php if ($set == 'RPT') { ?>
                          <td><?php echo "Surat Undangan Rapat"; ?></td>
                        <?php }else { ?>
                          <td><?php echo "Surat Undangan Kegiatan"; ?></td>
                        <?php } ?>
                        <td><?= $row['usulan_rpt'] ?></td>
                        <td><?= $row['tujuan_surat'] ?></td>
                        <td><?= $row['tgl_udg'] ?></td>
                        <td><?= $row['tempat_udg'] ?></td>
                        <td><?= $row['jam_udg'] ?></td>
                        <td>
                          <button class="btn btn-primary" onclick="konfirmasi_data('<?= base_url('ketuaRW/klik_hapus_usulan_rapatRW/')?>', '<?= $row['no_udg']; ?>' )">Hapus Data</button>
                        </td>
                      </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
