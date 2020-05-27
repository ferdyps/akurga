<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Input Surat Undangan</h1>
  </div>
  <div class="container">
    <?php foreach ($fetch as $row){ ?>
       <?php echo form_open('sekretaris/insertUndanganKegiatan', ['id' => 'default-form', 'log' => 'Input Surat Undangan Kegiatan']);?>
      <div class="row bg-white rounded shadow border-left-primary">
        <div class="col px-0">
          <div class="col">
            <br>
            <div class="form-group form-input">
              <label for="input-tembusan">Isi Usulan Rapat</label>
              <textarea
              class="form-control" name="usulan_rpt" id="input-usulan_rpt" readonly><?= $row['usulan_rpt'] ?></textarea>
            </div>
          </div>
          <div class="row px-3 my-3">
            <div class="col">
              <div class="form-group form-input">
                  <label for="input-no_udg_kgt">No Surat Kegiatan</label>
                  <input type="text" name="no_udg_kgt" value="<?= $row['no_udg']; ?>" id="input-no_udg_kgt" class="form-control" readonly>
                  <div class="invalid-feedback">
                  </div>
              </div>
              <div class="form-group form-input">
                  <label for="input-lampiran_kgt">Lampiran</label>
                  <input type="text" name="lampiran_kgt" id="input-lampiran_kgt" class="form-control">
                  <div class="invalid-feedback"></div>
                  <p class="text-mute">* Inputkan " _ " jika tidak terdapat lampiran</p>
              </div>
              <div class="form-group form-input">
                  <label for="Sifat">Sifat</label>
                  <select id="Sifat" name="sifat_kgt" class="form-control">
                    <option class="text-muted" selected  disabled>-- PILIH SIFAT SURAT --</option>
                     <option>Biasa</option>
                     <option>Penting</option>
                     <option>Segera</option>
                   </select>
                  <div class="invalid-feedback">
                  </div>
              </div>

              <div class="form-group form-input">
                  <label for="input-hal_kgt">Hal</label>
                  <input type="text" name="hal_kgt" id="input-hal_kgt" class="form-control">
                  <div class="invalid-feedback">
                  </div>
              </div>

              <div class="form-group form-input">
                  <label for="input-tujuan_surat_kgt">Pihak yang Diundang</label>
                  <input type="text" name="tujuan_surat_kgt" id="input-tujuan_surat_kgt" class="form-control" value="<?= $row['tujuan_surat'] ?>">
                  <div class="invalid-feedback">
                </div>
              </div>
              <div class="form-group form-input">
                  <label for="input-tempat_udg_kgt">Tempat Kegiatan</label>
                  <input type="text" name="tempat_udg_kgt" id="input-tempat_udg_kgt" class="form-control" value="<?= $row['tempat_udg'] ?>">
                  <div class="invalid-feedback">
                </div>
              </div>
              <div class="form-group form-input">
                  <label for="input-catatan_kgt">Catatan Penting</label>
                  <input type="text" name="catatan_kgt" id="input-catatan_kgt" class="form-control">
                  <div class="invalid-feedback"></div>
                <p class="text-mute">* Inputkan " _ " jika tidak terdapat catatan penting</p>
              </div>

            </div>

            <div class="col">
              <div class="form-group form-input">
                  <label for="input-isi_surat_kgt">Isi Surat</label>
                  <textarea style="width: 530px;
                min-width:530px;
                max-width:530px;
                height:210px;
                min-height:210px;
                max-height:210px;"
                class="form-control" name="isi_surat_kgt" id="input-isi_surat_kgt"></textarea>
                  <div class="invalid-feedback">
                </div>
              </div>
              <div class="form-group form-input">
                  <label for="input-tgl_surat_kgt">Tanggal Surat</label>
                  <input type="text" name="tgl_surat_kgt" id="input-tgl_surat_kgt" class="form-control datepicker" value="<?= $row['tgl_udg'] ?>">
                  <div class="invalid-feedback">
                </div>
              </div>
              <div class="form-group form-input">
                  <label for="input-jam_udg_kgt">Jam Kegiatan</label>
                  <input type="text" name="jam_udg_kgt" id="input-jam_udg_kgt" class="form-control timepicker" value="<?= $row['jam_udg'] ?>">
                  <div class="invalid-feedback">
                </div>
              </div>
              <div class="form-group form-input">
                  <label for="input-acara_udg_kgt">Agenda Kegiatan</label>
                  <input type="input" name="acara_udg_kgt" id="input-acara_udg_kgt" class="form-control">
                  <div class="invalid-feedback">
                </div>
              </div>

              <div class="form-group form-input">
                  <label for="input-tembusan">Tembusan</label>
                  <textarea style="width: 520px;
                min-width:520px;
                max-width:520px;
                height:150px;
                min-height:150px;
                max-height:150px;"
                class="form-control" name="tembusan" id="input-tembusan"></textarea>
                  <div class="invalid-feedback">
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <div class="col">
          <div class="form-group text-center">
            <input type="submit" class="btn btn-primary">
            <input type="reset" value="Reset" class="btn btn-danger">
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close();?>
  </div>
