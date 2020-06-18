<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Edit Gambar Dokumentasi Rapat & Dokumentasi Presensi</h1>
  </div>
  <div class="container">
    <div class="bg-white rounded shadow border-left-primary">
      <br>
      <?= form_open_multipart('sekretaris/editDokRapatNotulen', ['id' => 'edit-formrpt', 'log' => 'Edit Notulensi']);?>
      <?php foreach ($fetch as $row) { ?>

        <div class="col">
            <div class="form-group form-input">
                <label for="edit-no_notulen">No Notulensi Rapat</label>
                <input type="text" name="no_notulen" id="edit-no_notulen" class="form-control" value="<?= $row['no_notulen'] ?>" readonly>
                <div class="invalid-feedback"></div>
            </div>
        </div>
      <div class="row px-3 my-3">


          <div class="col">
            <div class="form-group form-input">
                <label for="dokumentasi_rpt">Dokumentasi Rapat</label>
                <div class="custom-file">
                  <input type="file" name="dokumentasi_rpt" class="custom-file-input" id="dok_rpt">
                  <label class="custom-file-label" for="dok_rpt">Choose file</label>
                </div>
                <p class="text-mute">*Ukuran file Maksimal 2 MB <br> *file yang di izinkan .jpg .jpeg, atau .png</p>
                <div class="invalid-feedback"></div>
                <a href="<?= base_url("sekretaris/dokumentasi_rapat").'/'.$row['no_notulen'];?>" target="_blank" class="d-none d-sm-inline-block btn btn-info shadow-sm" title="Detail Dokumentasi Rapat">Lihat Gambar Dokumentasi Rapat</a>
            </div>

            <div class="form-group form-input">
              <label for="dokumentasi_presensi">Dokumentasi Presensi Warga</label>
              <div class="custom-file">
                <input type="file" name="dokumentasi_presensi" class="custom-file-input" id="dok_pres">
                <label class="custom-file-label" for="dok_pres">Choose file</label>
              </div>
              <p class="text-mute">*Ukuran file Maksimal 2 MB <br> *file yang di izinkan .jpg .jpeg, atau .png</p>
              <div class="invalid-feedback"></div>
              <a href="<?= base_url("sekretaris/dokumentasi_presensi").'/'.$row['no_notulen'];?>" target="_blank" class="d-none d-sm-inline-block btn btn-info shadow-sm" title="Detail Dokumentasi Rapat">Lihat Gambar Dokumentasi Presensi Warga</a>
            </div>


          </div>

          <div class="col">
            <div class="form-group form-input">
              <label for="edit-ket_dok_rpt">Keterangan Dokumentasi Rapat</label>
              <input type="text" name="ket_dok_rpt" id="edit-ket_dok_rpt" class="form-control" placeholder="(detail keterangan gambar)" value="<?= $row['keterangan_dokumentasi'];  ?>">
              <div class="invalid-feedback"></div>
              <p class="text-mute">*Contoh = warga sedang membahas struktur organisasi. Foto: Gusti Tanati</p>
            </div>
          </div>
      </div>
    <?php } ?>
      <div class="col">
          <div class="form-group text-center">
              <input type="submit" class="btn btn-primary">
          </div>
      </div>
      <br>
        <?= form_close();?>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>

    <script>
    $('#dok_rpt').on('change',function(){
                   //get the file name
                   var fileName = $(this).val().split("\\").pop();
                   //replace the "Choose a file" label
                   $(this).next('.custom-file-label').html(fileName);
               });

               $('#dok_pres').on('change',function(){
                              //get the file name
                              var fileName = $(this).val().split("\\").pop();
                              //replace the "Choose a file" label
                              $(this).next('.custom-file-label').html(fileName);
                          });

    </script>
