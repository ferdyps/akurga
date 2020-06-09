<div class="modal fade" id="editUraianNotulensiModal" tabindex="-1" role="dialog" aria-labelledby="editUraianNotulensiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUraianNotulensiModalLabel">Edit Uraian Notulensi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('sekretaris/editUraianNotulen', ['id' => 'edit-formrpt' , 'log' => 'Edit Uraian Notulensi']);?>
      <div class="row px-3 my-3">
          <div class="col">
              <div class="form-group form-input">
                  <label for="edit-no_notulensi">No Notulensi Rapat</label>
                  <input type="text" name="no_notulen" id="edit-no_notulen" class="form-control" readonly>
                  <div class="invalid-feedback">

                  </div>
              </div>
          </div>

      <div class="row px-3 my-3">
          <div class="col">
            <div class="form-group form-input">
                <label for="edit-tembusan">Tembusan</label>
                <textarea class="form-control" name="tembusan" id="edit-tembusan"></textarea>
                <div class="invalid-feedback"></div>
                <p class="text-mute">* Inputkan " _ " jika tidak terdapat tembusan</p>
            </div>
              <div class="form-group form-input">
                <label>Uraian Notulensi</label>
                <div class="alert alert-success" role="alert">
                    Lakukan pengeditan uraian notulensi di <b>microsoft word</b> terlebih dahulu. Lalu <b>copy paste</b> semua tulisan dari file <b>microsoft word</b> anda ke dalam input di bawah ini . .
                </div>
                <label class="small">Untuk versi cetak</label>
                <textarea cols="30" rows="10" class="form-control" name="uraian_notulen_cetak" id="edit-uraian_notulen_cetak"></textarea>
                <div class="invalid-feedback"></div>
              </div>
              <div class="form-group form-input">
                <label class="small">Untuk versi unggah ke web</label>
                <textarea name="uraian_notulen" id="edit-uraian_notulen" cols="30" rows="10"></textarea>
                <div class="invalid-feedback"></div>
              </div>

          </div>
      </div>
      <div class="col">
          <div class="form-group text-center">
              <input type="submit" class="btn btn-primary">
              <input type="reset" value="Reset" class="btn btn-danger">
          </div>
      </div>
        <?= form_close();?>
    </div>
  </div>
</div>
</div>

<script>
tinymce.init({
  selector: '#edit-uraian_notulen',
  plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
  toolbar_mode: 'floating',
  tinycomments_mode: 'embedded',
  tinycomments_author: 'Author name'
});
</script>
