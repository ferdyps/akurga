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
                      <th>Penulis</th>
                      <th>Tanggal Input Notulen</th>
                      <th>Tembusan</th>
                      <th width="10%">Dokumentasi Rapat</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                    foreach ($list_notulen as $row) {
                      ?>
                      <tr>
                        <td><?= str_replace('-','/',$row['no_notulen']); ?></td>
                        <td><?= $row['penulis'] ?></td>
                        <td><?= strftime("%d %B %Y",strtotime($row['tgl_buat'])); ?></td>
                        <td><?= $row['tembusan'] ?></td>
                        <td>
                          <a href="<?= base_url("ketuaRT/dokumentasi_rapat").'/'.$row['no_notulen'];?>" target="_blank" class="d-none d-sm-inline-block btn btn-primary shadow-sm" title="Detail Dokumentasi Rapat"><i class="fas fa-image"></i></a>
                        </td>
                        <td>
                          <a href="<?= base_url("ketuaRT/notulensi_rapat").'/'.$row['no_notulen'];?>" target="_blank" class="d-none d-sm-inline-block btn btn-primary shadow-sm" title="Lihat Isi Uraian Notulensi">Preview<br>Surat</a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
