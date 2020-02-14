<header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Pengajuan Surat Pengantar</h1>
          <hr class="divider my-4">
        </div>
        <div class="col-lg-8 align-self-baseline">
        <?= form_open();?>
            <div class='form-group'>
                <label for="input-nomor_surat" class="text-white">Nomor Surat</label>
                <input type="text" value="<?= $data_surat->nomor_surat?>" name="nomor_surat" id="input-nomor_surat" class="form-control" readonly>
            </div>
            <div class='form-group'>
                <label for="input-tanggal_surat" class="text-white">Tanggal Diperlukan</label>
                <input type="date" name="tanggal_surat" id="input-tanggal_surat" class="form-control <?php if(form_error('tanggal_surat')) { echo 'is-invalid'; } ?> datepickerSurat" value="<?= set_value('tanggal_surat'); ?>">
                <div class="invalid-feedback">
                  <?= form_error('tanggal_surat'); ?>
                </div>
            </div>
            <div class='form-group'>
                <label for="input-keperluan" class="text-white">Keperluan</label>
                <input value="<?= $data_surat->keperluan?>" type="text" name="keperluan" id="input-keperluan" class="form-control <?php if(form_error('keperluan')) { echo 'is-invalid'; } ?>" placeholder="Keperluan"">
                <div class="invalid-feedback">
                  <?= form_error('keperluan'); ?>
                </div>
            </div>
            <input type="submit" value="Submit" class="btn btn-primary">
        <?= form_close();?>
        </div>
      </div>
    </div>
  </header>