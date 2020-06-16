<header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Pengajuan Komplain</h1>
          <hr class="divider my-4">
        </div>
        <div class="col-lg-8 align-self-baseline">
        <?= form_open_multipart('user/insertKomplain', ['id' => 'default-form', 'log' => 'Input Komplain']);?>
            <div class="form-group form-input">
                <label for="input-nomor_komplain" class="text-white">Nomor Komplain</label>
                <input type="text" name="nomor_komplain" value="<?= $generate_id?>" id="input-nomor_komplain" class="form-control" readonly>
            </div>
            <div class="form-group form-input">
                <label for="input-tanggal_komplain" class="text-white">Tanggal Komplain</label>
                <input type="date" name="tanggal_komplain" value="<?= date("Y-m-d")?>" id="input-tanggal_komplain" class="form-control" readonly>
            </div>
            <div class="form-group form-input">
                <label for="input-lokasi" class="text-white">Lokasi (Opsional)</label>
                <input type="text" name="lokasi" id="input-lokasi" class="form-control" placeholder="Lokasi">
                <div class="invalid-feedback"></div>
            </div>
            <div class="form-group form-input">
                <label for="input-keluhan" class="text-white">Keluhan</label>
                <textarea name="keluhan" id="input-keluhan" rows="3" class="form-control" placeholder="Keluhan"></textarea>
                <div class="invalid-feedback"></div>
            </div>
            <div class="form-group form-input">
                <label for="input-gambar" class="text-white">Gambar Pengaduan</label>
                <div class="custom-file">
                  <input name="gambar" id="input-gambar" type="file" class="custom-file-input ">
                  <label class="custom-file-label">Choose file</label>
                  * Ukuran file max 2mb <br>
                  * Format file wajib JPG, JPEG atau PNG
                  <div class="invalid-feedback"></div>
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
