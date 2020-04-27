<div class="modal fade" id="editDataRapatModal" tabindex="-1" role="dialog" aria-labelledby="editDataRapatModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editDataRapatModalLabel">Edit Data Rapat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('sekretaris/editRapat', ['id' => 'default-form', 'log' => 'Edit Surat Undangan']);?>
      <div class="row px-3 my-3">
          <div class="col">
              <div class="form-group form-input">
                  <label for="edit-no_udg">No Surat Rapat</label>
                  <input type="text" name="no_udg" id="edit-no_udg" class="form-control" readonly>
                  <div class="invalid-feedback"></div>
              </div>
              <div class="form-group form-input">
                  <label for="edit-lampiran">Lampiran</label>
                  <input type="text" name="lampiran" id="edit-lampiran" class="form-control">
                  <div class="invalid-feedback"></div>
              </div>
              <div class="form-group form-input">
                  <label for="sifat">Sifat</label>
                  <select id="edit-sifat" name="sifat" class="form-control">
                     <option selected>Biasa</option>
                     <option>Penting</option>
                     <option>Segera</option>
                   </select>
                  <div class="invalid-feedback"></div>
              </div>

              <div class="form-group form-input">
                  <label for="edit-hal">Hal</label>
                  <input type="text" name="hal" id="edit-hal" class="form-control">
                  <div class="invalid-feedback"></div>
              </div>

              <div class="form-group form-input">
                  <label for="edit-tujuan_surat">Pihak Yang Diundang</label>
                  <input type="text" name="tujuan_surat" id="edit-tujuan_surat" class="form-control">
                  <div class="invalid-feedback"></div>
              </div>
              <div class="form-group form-input">
                  <label for="edit-tempat_udg">Tempat Rapat</label>
                  <input type="text" name="tempat_udg" id="edit-tempat_udg" class="form-control">
                  <div class="invalid-feedback"></div>
              </div>

              <div class="form-group form-input">
                  <label for="edit-tembusan">Tembusan</label>
                  <textarea class="form-control" name="tembusan" id="edit-tembusan"></textarea>
                  <div class="invalid-feedback"></div>
              </div>
          </div>
          <!-- ====================Batas ke 2==================== -->
          <div class="col">
              <div class="form-group form-input">
                  <label for="edit-isi_surat">Isi Surat</label>
                  <textarea class="form-control" name="isi_surat" id="edit-isi_surat"></textarea>
                  <div class="invalid-feedback">
                </div>
              </div>

              <div class="form-group form-input">
                  <label for="edit-tgl_surat">Tanggal Surat</label>
                  <input type="text" name="tgl_surat" id="edit-tgl_surat" class="form-control datepicker">
                  <div class="invalid-feedback"></div>
              </div>

              <div class="form-group form-input">
                  <label for="edit-jam_udg">Jam Rapat</label>
                  <input type="text" name="jam_udg" id="edit-jam_udg" class="form-control timepicker">
                  <div class="invalid-feedback"></div>
              </div>

              <div class="form-group form-input">
                  <label for="edit-acara_udg">Acara Rapat</label>
                  <textarea class="form-control" name="acara_udg" id="edit-acara_udg"></textarea>
                  <div class="invalid-feedback"></div>
              </div>
          </div>
      </div>
      <div class="col">
          <div class="form-group text-center">
              <input type="submit" value="Submit" class="btn btn-primary">
              <input type="reset" value="Reset" class="btn btn-danger">
          </div>
      </div>
        <?= form_close();?>
    </div>
  </div>
</div>
