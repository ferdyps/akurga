<header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Pengajuan Surat Pengantar</h1>
          <hr class="divider my-4">
        </div>
        <div class="col-lg-8 align-self-baseline">
        <?= form_open('user/insertSuratPengantar', ['id' => 'default-form', 'log' => 'Input Surat Pengantar']);?>
            <div class="form-group form-input">
                <label for="input-nomor_surat" class="text-white">Nomor Surat</label>
                <input type="text" value="<?= $generate_id;?>" name="nomor_surat" id="input-nomor_surat" class="form-control" readonly placeholder="Nomor Surat">
            </div>
            <div class="form-group form-input">
                <label for="input-keperluan" class="text-white">Keperluan</label>
                <input type="text" name="keperluan" id="input-keperluan" class="form-control" placeholder="Keperluan">
                <div class="invalid-feedback"></div>
            </div>
            <input type="submit" value="Submit" class="btn btn-primary">
        <?= form_close();?>
        </div>
      </div>
    </div>
  </header>