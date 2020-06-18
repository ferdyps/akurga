<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Riwayat Usulan Pembuatan Surat Undangan</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Riwayat Usulan Pembuatan Surat Undangan yang Disetujui</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="bg-primary text-white text-center">
                      <th width="5%">No</th>
                      <th>Jenis Surat</th>
                      <th>Isi Usulan</th>
                      <th>Pihak Yang Diundang</th>
                      <th>Tanggal Pelaksaan Rapat</th>
                      <th>Tempat Rapat</th>
                      <th>Jam Rapat</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                    $i = 1;
                    foreach ($fetch as $row) {
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
                        <td><?= strftime("%d %B %Y",strtotime($row['tgl_udg'])); ?></td>
                        <td><?= $row['tempat_udg'] ?></td>
                        <td><?= $row['jam_udg'] ?></td>
                        <td>

                          <a
                          <?php if ($set == 'RPT') { ?>
                           href="<?= base_url("sekretaris/inputundanganrapat").'/'.$row['no_udg'];?>"
                          <?php }else { ?>
                           href="<?= base_url("sekretaris/inputundangankegiatan").'/'.$row['no_udg'];?>"
                          <?php } ?>
                           class="d-none d-sm-inline-block btn btn-primary shadow-sm" title="Buat Surat Undangan">
                           Buat Surat Undangan
                         </a>
                        </td>
                      </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
