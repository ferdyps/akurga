<div class="modal fade " id="detailDataKgtModal" tabindex="-1" role="dialog" aria-labelledby="detailDataKgtModal" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailDataKgtModal">Detail Data Kegiatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="row px-3 my-3">
          <div class="col">
              <div class="form-group form-input">
                  <label for="edit-no_udg">No Surat Undangan</label>
                  <input type="text" name="no_udg" id="edit-no_udg_kgt" class="form-control" readonly>
                  <div class="invalid-feedback"></div>
              </div>
              <div class="form-group form-input">
                  <label for="edit-lampiran">Lampiran</label>
                  <input type="text" name="lampiran" id="edit-lampiran_kgt" class="form-control" readonly>
                  <div class="invalid-feedback"></div>
              </div>
              <div class="form-group form-input">
                  <label for="sifat">Sifat</label>
                  <input type="text" name="sifat" id="edit-sifat_kgt" class="form-control" readonly>
                  <div class="invalid-feedback"></div>
              </div>

              <div class="form-group form-input">
                  <label for="edit-hal">Hal</label>
                  <input type="text" name="hal" id="edit-hal_kgt" class="form-control" readonly>
                  <div class="invalid-feedback"></div>
              </div>

              <div class="form-group form-input">
                  <label for="edit-tujuan_surat">Pihak Yang Diundang</label>
                  <input type="text" name="tujuan_surat" id="edit-tujuan_surat_kgt" class="form-control" readonly>
                  <div class="invalid-feedback"></div>
              </div>
              <div class="form-group form-input">
                  <label for="edit-tempat_udg">Tempat Rapat</label>
                  <input type="text" name="tempat_udg" id="edit-tempat_udg_kgt" class="form-control" readonly>
                  <div class="invalid-feedback"></div>
              </div>

              <div class="form-group form-input">
                  <label for="edit-catatan">Catatan Penting</label>
                  <input type="text" name="catatan_kgt" id="edit-catatan_kgt" class="form-control" readonly>
                  <div class="invalid-feedback"></div>
                <!-- <p class="text-mute">* Inputkan " _ " jika tidak terdapat catatan penting</p> -->
              </div>


          </div>
          <!-- ====================Batas ke 2==================== -->
          <div class="col">
              <div class="form-group form-input">
                  <label for="edit-isi_surat">Isi Surat</label>
                  <textarea class="form-control" name="isi_surat" id="edit-isi_surat_kgt" readonly></textarea>
                  <div class="invalid-feedback">
                </div>
              </div>

              <div class="form-group form-input">
                  <label for="edit-tgl_surat">Tanggal Pelaksanaan Rapat</label>
                  <input type="text" name="tgl_surat" id="edit-tgl_surat_kgt" class="form-control" readonly>
                  <div class="invalid-feedback"></div>
              </div>

              <div class="form-group form-input">
                  <label for="edit-jam_udg">Jam Rapat</label>
                  <input type="text" name="jam_udg" id="edit-jam_udg_kgt" class="form-control" readonly>
                  <div class="invalid-feedback"></div>
              </div>

              <div class="form-group form-input">
                  <label for="edit-acara_udg">Agenda Rapat</label>
                  <textarea class="form-control" name="acara_udg" id="edit-acara_udg_kgt" readonly></textarea>
                  <div class="invalid-feedback"></div>
              </div>

              <div class="form-group form-input">
                  <label for="edit-tembusan">Tembusan</label>
                  <textarea class="form-control" name="tembusan" id="edit-tembusan_kgt" readonly></textarea>
                  <div class="invalid-feedback"></div>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
