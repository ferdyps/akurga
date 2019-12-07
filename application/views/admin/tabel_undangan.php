<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Riwayat Surat Undangan</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Riwayat Surat Undangan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="bg-primary text-white text-center">
                      <th>No Surat Rapat</th>
                      <th>Lampiran</th>
                      <th>Sifat</th>
                      <th>Hal</th>
                      <th>Tujuan Surat</th>
                      <th>Tempat Rapat</th>
                      <th>Tembusan</th>
                      <th>Isi Surat</th>
                      <th>Tanggal Surat</th>
                      <th>Jam Rapat</th>
                      <th>Acara Rapat</th>
                      <th>Status Approval</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <?php
                    foreach ($list_surat_udg as $row) {
                  ?>
                  <tbody>
                    <td><?= $row['no_udg'] ?></td>
                    <td><?= $row['lampiran_udg'] ?></td>
                    <td><?= $row['sifat_udg'] ?></td>
                    <td><?= $row['perihal_udg'] ?></td>
                    <td><?= $row['tujuan_surat'] ?></td>
                    <td><?= $row['tempat_udg'] ?></td>
                    <td><?= $row['tembusan'] ?></td>
                    <td><?= $row['isi_surat'] ?></td>
                    <td><?= $row['tgl_udg'] ?></td>
                    <td><?= $row['jam_udg'] ?></td>
                    <td><?= $row['acara_udg'] ?></td>
                    <td>
                      <?php if ($row['status'] == 1) {
                        echo "Sudah Approval";
                      }else {
                        echo "Belum Approval";
                      }?>
                    </td>
                    <td></td>
                  </tbody>
                  <?php } ?>
                </table>
              </div>
            </div>
          </div>
        </div>
