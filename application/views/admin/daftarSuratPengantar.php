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
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="bg-primary text-white text-center">
                      <th width="5%">No</th>
                      <th>Nomor Surat</th>
                      <th>NIK</th>
                      <th>Nama Lengkap</th>
                      <th>Keperluan</th>
                      <th>Tanggal Diperlukan</th>
                      <th>Validasi</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                  <?php
                    $i=1; 
                    foreach($list_surat_pengantar as $row)
                  {?>
                      <tr>
                        <td><?= $i++?></td>
                        <td><?= $row['nomor_surat']?></td>
                        <td><?= $row['nik']?></td>
                        <td><?= $row['nama']?></td>
                        <td><?= $row['keperluan']?></td>
                        <td><?= $row['tanggal_surat']?></td>
                        <td>
                          <?php if ($row['valid'] == 1) {
                                echo "Sudah Valid";
                              }else {
                                echo "Belum Valid";
                          }?>
                        </td>
                        <td>
                          <button class="btn btn-primary" onclick="konfirmasi_data('<?= base_url('admin/klik_konfirmasi_surat_pengantar/')?>', '<?= $row['nomor_surat']; ?>')">Aprroval</button>
                        </td>
                      </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>