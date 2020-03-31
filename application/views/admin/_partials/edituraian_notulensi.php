<div class="modal fade" id="editUraianNotulensiModal" tabindex="-1" role="dialog" aria-labelledby="editUraianNotulensiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUraianNotulensiModalLabel">Edit Uraian Notulensi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('admin/editUraianNotulen', ['id' => 'default-form' , 'log' => 'Edit Uraian Notulensi']);?>
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
                <label>Uraian Notulensi</label>
                <div class="alert alert-success" role="alert">
                    Lakukan pengeditan uraian notulensi di <b>microsoft word</b> terlebih dahulu. Lalu <b>copy paste</b> semua tulisan dari file <b>microsoft word</b> anda ke dalam input di bawah ini . .
                  </div>
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
  selector: 'textarea#edit-uraian_notulen',
  plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
  toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
  toolbar_mode: 'floating',
  tinycomments_mode: 'embedded',
  tinycomments_author: 'Author name'
});
</script>
