<header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Pengajuan Komplain</h1>
          <hr class="divider my-4">
        </div>
        <div class="col-lg-8 align-self-baseline">
        <?= form_open('url', '');?>
            <div class='form-group'>
                <label for="input-nomor_komplain" class="text-white">Nomor Komplain</label>
                <input type="text" name="nomor_komplain" id="input-nomor_komplain" class="form-control" placeholder="Nomor Komplain" disabled>
            </div>
            <div class='form-group'>
                <label for="input-tanggal_komplain" class="text-white">Tanggal Komplain</label>
                <input type="date" name="tanggal_komplain" id="input-tanggal_komplain" class="form-control">
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
