<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Surat Pengantar</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Pengajuan Surat Pengantar RT <?= $this->rt;?></h6>
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
                      <th>Status</th>
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
                        <td><?= $row['status']?></td>
                        <td>
                          <button class="btn btn-primary" onclick="konfirmasi_data('<?= base_url('ketuaRT/klik_konfirmasi_surat_pengantar/')?>', '<?= $row['nomor_surat']; ?>')" <?php if($row['status'] == 'diterima' || $row['status'] == 'ditolak') { ?> hidden <?php } ?>><i class="fas fa-check"></i></button>
                          <button class="btn btn-danger" data-target="#input-message" data-toggle="modal" onclick="decline_surat('<?= $row['nomor_surat']; ?>')" <?php if($row['status'] == 'diterima' || $row['status'] == 'ditolak') { ?> hidden <?php } ?> <?= $row['nomor_surat']; ?>><i class="fas fa-times"></i></button>
                        </td>
                      </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

<div class="modal fade" id="input-message" tabindex="-1" role="dialog" aria-labelledby="editDataWargaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editDataWargaModalLabel">Keterangan Penolakan Surat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('ketuaRT/declineSuratPengantar', ['id' => 'default-form', 'log' => 'Input Pesan Surat Pengantar'])?>
      
            <div class="row px-3 my-3">
                <div class="col">
                    <div class="form-group form-input">
                      <label for="input-nomor_surat"></label>
                      <input type="text" name="nomor_surat" id="input-nomor_surat" value=""  readonly class="form-control">
                    </div>
                    <div class="form-group form-input">
                        <label for="input-pesan">Keterangan</label>
                        <textarea id="input-pesan"  class="form-control" name="pesan" placeholder="Pesan..."></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group text-center">
                    <input type="submit" value="Submit" class="btn btn-primary">
                    <input type="reset" value="Reset" class="btn btn-danger">
                </div>
            </div>
        <?= form_close();?>
    </div>
  </div>
</div>

<script>
  function decline_surat(nomor_surat) {
    console.log(nomor_surat);
    console.log($('#input-nomor_surat'));

    $('#input-nomor_surat').val(nomor_surat);

  }
</script>
        