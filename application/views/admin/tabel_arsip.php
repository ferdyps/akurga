<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Riwayat Arsip Surat</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Riwayat Riwayat Arsip Surat</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="bg-primary text-white text-center">
                      <th>Kode Surat</th>
                      <th>Nomor Surat</th>
                      <th>Pengirim</th>
                      <th>Tanggal Terima surat</th>
                      <th>Tanggal Surat</th>
                      <th>Gambar Surat</th>
                      <th>Keterangan</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <?php foreach ($list_arsip as $row){ ?>
                  <tbody class="text-center">
                    <td><?= $row['kd_surat'] ?></td>
                    <td><?= $row['no_surat'] ?></td>
                    <td><?= $row['pengirim'] ?></td>
                    <td><?= $row['tgl_terima'] ?></td>
                    <td><?= $row['tgl_surat'] ?></td>
                    <td width="10%"><img class="img-thumbnail img-fluid" src="<?= base_url('./assets/foto/arsip/'. $row['gambar_srt'])?>"></td>
                    <td><?= $row['keterangan'] ?></td>
                    <td></td>
                  </tbody>
                <?php } ?>
                </table>
              </div>
            </div>
          </div>
        </div>
