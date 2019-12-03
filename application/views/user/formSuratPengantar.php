<header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Pengajuan Surat Pengantar</h1>
          <hr class="divider my-4">
        </div>
        <div class="col-lg-8 align-self-baseline">
        <?= form_open('url', '');?>
            <div class='form-group'>
                <label for="input-nomor_surat" class="text-white">Nomor Surat</label>
                <input type="text" name="nomor_surat" id="input-nomor_surat" class="form-control" placeholder="Nomor Surat" disabled>
            </div>
            <div class='form-group'>
                <label for="input-tanggal_diperlukan" class="text-white">Tanggal Diperlukan</label>
                <input type="date" name="nomor_surat" id="input-tanggal_diperlukan" class="form-control">
            </div>
            <div class='form-group'>
                <label for="input-keperluan" class="text-white">Keperluan</label>
                <input type="text" name="keperluan" id="input-keperluan" class="form-control" placeholder="Keperluan">
            </div>
            <input type="submit" value="Submit" class="btn btn-primary">
        <?= form_close();?>
        </div>
      </div>
    </div>
  </header>
