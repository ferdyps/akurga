<header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Pengajuan Komplain</h1>
          <hr class="divider my-4">
        </div>
        <div class="col-lg-8 align-self-baseline">
        <?= form_open_multipart();?>
            <div class='form-group'>
                <label for="input-nomor_komplain" class="text-white">Nomor Komplain</label>
                <input type="text" name="nomor_komplain" value="<?= $generate_id?>" id="input-nomor_komplain" class="form-control" readonly>
            </div>
            <div class='form-group'>
                <label for="input-tanggal_komplain" class="text-white">Tanggal Komplain</label>
                <input type="date" name="tanggal_komplain" value="<?= date("Y-m-d")?>" id="input-tanggal_komplain" class="form-control" readonly>
            </div>
            <div class='form-group'>
                <label for="input-keperluan" class="text-white">Lokasi (Opsional)</label>
                <input type="text" name="lokasi" id="input-keperluan" class="form-control <?php if(form_error('lokasi')) { echo 'is-invalid'; } ?>" value="<?= set_value('lokasi'); ?>" placeholder="Lokasi">
                <div class="invalid-feedback">
                  <?= form_error('lokasi'); ?>
                </div>
            </div>
            <div class='form-group'>
                <label for="Keluhan" class="text-white">Keluhan</label>
                <textarea name="keluhan" id="Keluhan" rows="3" class="form-control <?php if(form_error('keluhan')) { echo 'is-invalid'; } ?>" value="<?= set_value('keluhan'); ?>"></textarea>
                <div class="invalid-feedback">
                  <?= form_error('keluhan'); ?>
                </div>
            </div>
            <div class='form-group'>
                <label for="gambar" class="text-white">Gambar</label>
                <div class="custom-file">
                  <input name="gambar" id="gambar" type="file" class="custom-file-input  <?php if(form_error('gambar')) { echo 'is-invalid'; } ?>" value="<?= set_value('gambar'); ?>">
                  <label class="custom-file-label">Choose file</label>
                  <div class="invalid-feedback">
                    <?= form_error('gambar'); ?>
                  </div>
                </div>
            </div>
            <input type="submit" value="Submit" class="btn btn-primary">
        <?= form_close();?>
        </div>
      </div>
    </div>
  </header>
  <script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
