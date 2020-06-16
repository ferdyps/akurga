<div class="modal fade" id="editDataKgtModal" tabindex="-1" role="dialog" aria-labelledby="editDataKgtModal" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editDataKgtModal">Edit Data Kegiatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('sekretaris/editKegiatan', ['id' => 'edit-formkgt', 'log' => 'Edit Surat Undangan Kegiatan']);?>
      <div class="row px-3 my-3">
          <div class="col">
              <div class="form-group form-input">
                  <label for="edit-no_udg">No Surat Rapat</label>
                  <input type="text" name="no_udg_kgtedit" id="edit-no_udg_kgtedit" class="form-control" readonly>
                  <div class="invalid-feedback"></div>
              </div>
              <div class="form-group form-input">
                  <label for="edit-lampiran">Lampiran</label>
                  <input type="text" name="lampiran_kgtedit" id="edit-lampiran_kgtedit" class="form-control">
                  <div class="invalid-feedback"></div>
              </div>
              <div class="form-group form-input">
                  <label for="edit-sifat_kgtedit">Sifat</label>
                  <select id="edit-sifat_kgtedit" name="sifat_kgtedit" class="form-control">
                     <option selected>Biasa</option>
                     <option>Penting</option>
                     <option>Segera</option>
                   </select>
                  <div class="invalid-feedback"></div>
              </div>

              <div class="form-group form-input">
                  <label for="edit-hal">Hal</label>
                  <input type="text" name="hal_kgtedit" id="edit-hal_kgtedit" class="form-control">
                  <div class="invalid-feedback"></div>
              </div>

              <div class="form-group form-input">
                  <label for="edit-tujuan_surat">Pihak Yang Diundang</label>
                  <input type="text" name="tujuan_surat_kgtedit" id="edit-tujuan_surat_kgtedit" class="form-control">
                  <div class="invalid-feedback"></div>
              </div>
              <div class="form-group form-input">
                  <label for="edit-tempat_udg">Tempat Rapat</label>
                  <input type="text" name="tempat_udg_kgtedit" id="edit-tempat_udg_kgtedit" class="form-control">
                  <div class="invalid-feedback"></div>
              </div>

                <div class="form-group form-input">
                    <label for="edit-catatan">Catatan Penting</label>
                    <input type="text" name="catatan_kgtedit" id="edit-catatan_kgtedit" class="form-control">
                    <div class="invalid-feedback"></div>
                  <p class="text-mute">* Inputkan " _ " jika tidak terdapat catatan penting</p>
                </div>


          </div>
          <!-- ====================Batas ke 2==================== -->
          <div class="col">
              <div class="form-group form-input">
                  <label for="edit-isi_surat">Isi Surat</label>
                  <textarea class="form-control" name="isi_surat_kgtedit" id="edit-isi_surat_kgtedit"></textarea>
                  <div class="invalid-feedback">
                </div>
              </div>

              <div class="form-group form-input">
                  <label for="edit-tgl_surat">Tanggal Surat</label>
                  <input type="text" name="tgl_surat_kgtedit" id="edit-tgl_surat_kgtedit" class="form-control datepicker">
                  <div class="invalid-feedback"></div>
              </div>

              <div class="form-group form-input">
                  <label for="edit-jam_udg">Jam Rapat</label>
                  <input type="text" name="jam_udg_kgtedit" id="edit-jam_udg_kgtedit" class="form-control timepicker">
                  <div class="invalid-feedback"></div>
              </div>

              <div class="form-group form-input">
                  <label for="edit-acara_udg">Agenda Rapat</label>
                  <textarea class="form-control" name="acara_udg_kgtedit" id="edit-acara_udg_kgtedit"></textarea>
                  <div class="invalid-feedback"></div>
              </div>

              <div class="form-group form-input">
                  <label for="edit-tembusan">Tembusan</label>
                  <textarea class="form-control" name="tembusan_kgtedit" id="edit-tembusan_kgtedit"></textarea>
                  <div class="invalid-feedback"></div>
              </div>
          </div>
      </div>
      <div class="col">
          <div class="form-group text-center">
              <input type="submit" value="Submit" class="btn btn-primary">
          </div>
      </div>
        <?= form_close();?>
    </div>
  </div>
</div>
