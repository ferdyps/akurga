<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Edit Notulensi Rapat</h1>
  </div>
  <div class="container">
    <div class="row bg-white rounded shadow border-left-primary">
      <?= form_open_multipart('sekretaris/editNotulen', ['id' => 'default-form', 'log' => 'Edit Notulensi']);?>
      <div id="flash-data2" data-flashdata2="<?= $this->session->flashdata('error'); ?>"></div>
      <?php foreach ($fetch as $row) { ?>
      <div class="row px-3 my-3">
          <div class="col">
              <div class="form-group form-input">
                  <label for="edit-no_notulen">No Notulensi Rapat</label>
                  <input type="text" name="no_notulen" id="edit-no_notulen" class="form-control" value="<?= $row['no_notulen'] ?>" readonly>
                  <div class="invalid-feedback">

                  </div>
              </div>
              <div class="form-group form-input">
                  <label for="dokumentasi_rpt">Dokumentasi Rapat</label>
                  <div class="custom-file">
                    <input type="file" name="dokumentasi_rpt" class="custom-file-input" id="dok_rpt">
                    <label class="custom-file-label" for="dok_rpt">Choose file</label>
                  </div>
                  <p class="text-mute">*Ukuran file Maksimal 2 MB <br> *file yang di izinkan .jpg .jpeg, atau .png</p>
                  <div class="invalid-feedback">

                </div>
              </div>
          </div>

          <div class="col">
            <div class="form-group form-input">
                <label for="edit-tembusan">Tembusan</label>
                <textarea
                style="width: 520px;
              min-width:520px;
              max-width:520px;
              height:210px;
              min-height:125px;
              max-height:125px;" class="form-control" name="tembusan" id="edit-tembusan"><?= $row['tembusan'] ?></textarea>
                <div class="invalid-feedback">

              </div>
            </div>
          </div>
      </div>
    <?php } ?>
      <div class="col">
          <div class="form-group text-center">
              <input type="submit" class="btn btn-primary">
              <input type="reset" value="Reset" class="btn btn-danger">
          </div>
      </div>
        <?= form_close();?>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>

    <script>
    $('#dok_rpt').on('change',function(){
                   //get the file name
                   var fileName = $(this).val();
                   //replace the "Choose a file" label
                   $(this).next('.custom-file-label').html(fileName);
               })
    </script>
