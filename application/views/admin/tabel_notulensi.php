<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Riwayat Notulensi Rapat</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Riwayat Riwayat Notulensi Rapat</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="bg-primary text-white text-center">
                      <th>No Notulensi</th>
                      <th>Lampiran</th>
                      <th>Tembusan</th>
                      <th>Uraian Notulensi</th>
                    </tr>
                  </thead>
                  <?php
                    foreach ($list_notulen as $row) {
                  ?>
                  <tbody>
                    <td><?= $row['no_notulen'] ?></td>
                    <td><?= $row['lampiran'] ?></td>
                    <td><?= $row['tembusan'] ?></td>
                    <td><?= $row['uraian_notulen'] ?></td>
                  </tbody>
                <?php } ?>
                </table>
              </div>
            </div>
          </div>
        </div>
