<div class="modal fade" id="editDataNotulensiModal" tabindex="-1" role="dialog" aria-labelledby="editDataNotulensiModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editDataNotulensiModalLabel">Edit Data Rapat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('admin/editNotulen', ['id' => 'default-form', 'log' => 'Input Notulensi']);?>
      <div class="row px-3 my-3">
          <div class="col">
              <div class="form-group form-input">
                  <label for="edit-no_notulen">No Notulensi Rapat</label>
                  <input type="text" name="no_notulen" id="edit-no_notulen" class="form-control" readonly>
                  <div class="invalid-feedback">

                  </div>
              </div>
              <div class="form-group form-input">
                  <label for="edit-lampiran">Lampiran</label>
                  <input type="text" name="lampiran" id="edit-lampiran" class="form-control">
                  <div class="invalid-feedback">

                  </div>
              </div>

              <div class="form-group form-input">
                  <label for="edit-tembusan">Tembusan</label>
                  <textarea class="form-control" name="tembusan" id="edit-tembusan"></textarea>
                  <div class="invalid-feedback">

                </div>
              </div>

          </div>
          <!-- ====================Batas ke 2==================== -->
          <div class="col">
              <div class="form-group form-input">
                  <label for="edit-uraian_notulen">Uraian Notulensi</label>
                  <textarea class="form-control" name="uraian_notulen" id="edit-uraian_notulen"></textarea>
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
