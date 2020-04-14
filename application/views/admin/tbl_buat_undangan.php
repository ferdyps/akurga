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
                      <th>Tanggal Rapat</th>
                      <th>Tempat Rapat</th>
                      <th>Jam Rapat</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <?php
                  $i = 1;
                  foreach ($fetch as $row) {
                  ?>
                  <tbody class="text-center">
                    <td><?= $i++ ?></td>
                    <?php $set = substr($row['no_udg'],5,3); ?>
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
                      <a href="<?= base_url("sekretaris/inputundangan").'/'.$row['no_udg'];?>" class="d-none d-sm-inline-block btn btn-primary shadow-sm" title="Buat Surat Undangan"><i class="fas fa-plus-circle"></i></a>
                    </td>
                  </tbody>
                <?php } ?>
                </table>
              </div>
            </div>
          </div>
        </div>
