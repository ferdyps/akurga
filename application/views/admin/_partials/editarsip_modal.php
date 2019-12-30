<div class="modal fade" id="editDataArsipModal" tabindex="-1" role="dialog" aria-labelledby="editDataArsipModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editDataArsipModalLabel">Edit Data Arsip Surat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('admin/editArsipMasuk', ['id' => 'default-form', 'log' => 'Edit Arsip Surat Masuk']);?>
                <div class="row px-3 my-3">
                    <div class="col">
                        <div class="form-group form-input">
                            <label for="edit-kd_surat">Kode Surat</label>
                            <input type="text" name="kd_surat" id="edit-kd_surat"  class="form-control" readonly>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        <div class="form-group form-input">
                            <label for="edit-no_surat">Nomor Surat</label>
                            <input type="text" name="no_surat" id="edit-no_surat" class="form-control">
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="form-group form-input">
                            <label for="edit-pengirim">Pengirim</label>
                            <input type="text" name="pengirim" id="edit-pengirim" class="form-control">
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="form-group form-input">
                            <label for="edit-tgl_terima">Tanggal Terima Surat</label>
                            <input type="text" name="tgl_terima" id="edit-tgl_terima" class="form-control datepickerArsip">
                            <div class="invalid-feedback">
                            </div>
                        </div>


                        </div>

                        <div class="col">

                            <div class="form-group form-input">
                                <label for="gbr_surat">Gambar Surat</label>
                                <div class="custom-file">
                                  <input type="file" name="gbr_surat" class="custom-file-input" id="gbr_surat">
                                  <label class="custom-file-label">Choose file</label>
                                </div>
                                <div class="invalid-feedback">

                              </div>
                            </div>
                            <div class="form-group form-input">
                                <label for="edit-tgl_surat">Tanggal Surat</label>
                                <input type="text" name="tgl_surat" id="edit-tgl_surat" class="form-control datepickerStandar">
                                <div class="invalid-feedback">

                              </div>
                            </div>

                            <div class="form-group form-input">
                                <label for="edit-keterangan">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="edit-keterangan"></textarea>
                                <div class="invalid-feedback">

                              </div>
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
