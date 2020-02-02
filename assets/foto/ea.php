<div class="col px-0">
<?php echo form_open('admin/insertUndanganKegiatan', ['id' => 'default-form', 'log' => 'Input Rapat']);?>
<!-- 'admin/insertUndanganKegiatan', ['id' => 'default-form', 'log' => 'Input Kegiatan'] -->
    <div class="row px-3 my-3">
        <div class="col">
            <div class="form-group">
                <label for="input-no_udg">No Surat Kegiatan</label>
                <input type="text" name="no_udg" value="<?= $generate_id ?>" id="input-no_udg" class="form-control" readonly>
                <div class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="input-lampiran">Lampiran</label>
                <input type="text" name="lampiran" id="input-lampiran" class="form-control">
                <div class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="Sifat">Sifat</label>
                <select id="Sifat" name="sifat" class="form-control">
                   <option selected>Biasa</option>
                   <option>Penting</option>
                   <option>Segera</option>
                 </select>
                <div class="invalid-feedback">
                </div>
            </div>

            <div class="form-group">
                <label for="input-hal">Hal</label>
                <input type="text" name="hal" id="input-hal" class="form-control">
                <div class="invalid-feedback">
                </div>
            </div>

            <div class="form-group">
                <label for="input-tujuan_surat">Pihak yang Diundang</label>
                <input type="text" name="tujuan_surat" id="input-tujuan_surat" class="form-control">
                <div class="invalid-feedback">
              </div>
            </div>
            <div class="form-group">
                <label for="input-tempat_udg">Tempat Kegiatan</label>
                <input type="text" name="tempat_udg" id="input-tempat_udg" class="form-control">
                <div class="invalid-feedback">
              </div>
            </div>
            <div class="form-group">
                <label for="input-catatan">Catatan Penting</label>
                <input type="text" name="catatan" id="input-catatan" class="form-control">
                <div class="invalid-feedback">
              </div>
            </div>
        </div>
        <!-- ====================Batas ke 2==================== -->
        <div class="col">
            <div class="form-group">
                <label for="input-isi_surat">Isi Surat</label>
                <textarea style="width: 530px;
              min-width:530px;
              max-width:530px;
              height:210px;
              min-height:210px;
              max-height:210px;"
              class="form-control" name="isi_surat" id="input-isi_surat"></textarea>
                <div class="invalid-feedback">
              </div>
            </div>
            <div class="form-group">
                <label for="input-tgl_surat">Tanggal Surat</label>
                <input type="text" name="tgl_surat" id="input-tgl_surat" class="form-control datepicker">
                <div class="invalid-feedback">
              </div>
            </div>
            <div class="form-group">
                <label for="input-jam_udg">Jam Kegiatan</label>
                <input type="text" name="jam_udg" id="input-jam_udg" class="form-control timepicker">
                <div class="invalid-feedback">
              </div>
            </div>
            <div class="form-group">
                <label for="input-acara_udg">Acara Kegiatan</label>
                <input type="input" name="acara_udg" id="input-acara_udg" class="form-control">
                <div class="invalid-feedback">
              </div>
            </div>

            <div class="form-group">
                <label for="Tembusan">Tembusan</label>
                <textarea style="width: 520px;
              min-width:520px;
              max-width:520px;
              height:150px;
              min-height:150px;
              max-height:150px;"
              class="form-control" name="tembusan" id="Tembusan"></textarea>
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
<?php echo form_close();?>
</div>
