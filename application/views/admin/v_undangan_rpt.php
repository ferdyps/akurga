<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Input Surat Undangan</h1>
  </div>
  <div class="container">
    <?php foreach ($fetch as $row){ ?>
      <?php echo form_open('sekretaris/insertUndanganRapat', ['id' => 'default-form', 'log' => 'Input Surat Undangan']);?>
      <div class="row bg-white rounded shadow border-left-primary">
        <div class="col px-0">
          <div class="col">
            <br>
            <div class="form-group">
              <label for="input-tembusan">Isi Usulan Rapat</label>
              <textarea
              class="form-control" name="usulan_rpt" id="input-usulan_rpt" readonly><?= $row['usulan_rpt'] ?></textarea>
            </div>
          </div>
          <div class="row px-3 my-3">
            <div class="col">
              <div class="form-group form-input">
                <label for="input-no_udg">No Surat Undangan</label>
                <input type="text" name="no_udg" id="input-no_udg" value="<?= $row['no_udg']; ?>" class="form-control" readonly>
                <div class="invalid-feedback"></div>
              </div>
              <div class="form-group form-input">
                <label for="input-lampiran">Lampiran</label>
                <input type="text" name="lampiran" id="input-lampiran" class="form-control">
                <div class="invalid-feedback"></div>
              </div>
              <div class="form-group form-input">
                <label for="Sifat">Sifat</label>
                <select id="Sifat" name="sifat" class="form-control">
                  <option selected>Biasa</option>
                  <option>Penting</option>
                  <option>Segera</option>
                </select>
                <div class="invalid-feedback"></div>
              </div>

              <div class="form-group form-input">
                <label for="input-hal">Hal</label>
                <input type="text" name="hal" id="input-hal" class="form-control">
                <div class="invalid-feedback"></div>
              </div>

              <div class="form-group form-input">
                <label for="input-tujuan_surat">Pihak Yang Diundang</label>
                <input type="text" name="tujuan_surat" id="input-tujuan_surat" class="form-control" value="<?= $row['tujuan_surat'] ?>">
                <div class="invalid-feedback"></div>
              </div>
              <div class="form-group form-input">
                <label for="input-tempat_udg">Tempat Rapat</label>
                <input type="text" name="tempat_udg" id="input-tempat_udg" class="form-control" value="<?= $row['tempat_udg'] ?>">
                <div class="invalid-feedback"></div>
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
                <div class="invalid-feedback"></div>
              </div>

            </div>

            <div class="col">
              <div class="form-group form-input">
                <label for="input-isi_surat">Isi Surat</label>
                <textarea style="width: 530px;
                min-width:520px;
                max-width:520px;
                height:210px;
                min-height:210px;
                max-height:210px;"
                class="form-control" name="isi_surat" id="input-isi_surat"></textarea>
                <div class="invalid-feedback">
                </div>
              </div>

              <div class="form-group form-input">
                <label for="input-tgl_surat">Tanggal Surat</label>
                <input type="text" name="tgl_surat" id="input-tgl_surat" class="form-control datepicker" value="<?= $row['tgl_udg'] ?>">
                <div class="invalid-feedback"></div>
              </div>

              <div class="form-group form-input">
                <label for="input-jam_udg">Jam Rapat</label>
                <input type="text" name="jam_udg" id="input-jam_udg" class="form-control timepicker" value="<?= $row['jam_udg'] ?>">
                <div class="invalid-feedback"></div>
              </div>

              <div class="form-group form-input">
                <label for="input-acara_udg">Agenda Rapat</label>
                <textarea style="width: 520px;
                min-width:520px;
                max-width:520px;
                height:150px;
                min-height:150px;
                max-height:150px;"
                class="form-control" name="acara_udg" id="input-acara_udg"></textarea>
                <div class="invalid-feedback"></div>
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
