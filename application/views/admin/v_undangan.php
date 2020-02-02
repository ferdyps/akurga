<div class="container-fluid">
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Input Surat Undangan</h1>
 </div>
 <div class="container">

       <ul class="nav nav-pills" id="pills-tab" role="tablist">
         <li class="nav-item col-sm-6">
           <a class="nav-link active" id="pills-rapat-tab" data-toggle="pill" href="#pills-rapat" role="tab" aria-controls="pills-rapat" aria-selected="true">Surat Rapat</a>
         </li>
         <li class="nav-item col-sm-6">
           <a class="nav-link" id="pills-kegiatan-tab" data-toggle="pill" href="#pills-kegiatan" role="tab" aria-controls="pills-kegiatan" aria-selected="false">Surat Kegiatan</a>
         </li>
       </ul>

     <!-- <div class="row bg-white rounded shadow border-left-primary"> -->
        <div class="tab-content" id="pills-tabContent">

          <div class="tab-pane fade show active bg-white rounded shadow border-left-primary" id="pills-rapat" role="tabpanel" aria-labelledby="pills-rapat-tab">
            <div class="col px-0 mt-3 pt-1">
            <?php echo form_open('admin/insertUndanganRapat', ['id' => 'default-form', 'log' => 'Input Kegiatan']);?>
                <div class="row px-3 my-3">
                    <div class="col-6">
                        <div class="form-group form-input">
                            <label for="input-no_udg">No Surat Rapat</label>
                            <input type="text" name="no_udg" id="input-no_udg" value="<?= $generate_id; ?>" class="form-control" readonly>
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
                            <input type="text" name="tujuan_surat" id="input-tujuan_surat" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group form-input">
                            <label for="input-tempat_udg">Tempat Rapat</label>
                            <input type="text" name="tempat_udg" id="input-tempat_udg" class="form-control">
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
                    <!-- ====================Batas ke 2==================== -->
                    <div class="col-6">
                        <div class="form-group form-input">
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

                        <div class="form-group form-input">
                            <label for="input-tgl_surat">Tanggal Surat</label>
                            <input type="text" name="tgl_surat" id="input-tgl_surat" class="form-control datepicker">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group form-input">
                            <label for="input-jam_udg">Jam Rapat</label>
                            <input type="text" name="jam_udg" id="input-jam_udg" class="form-control timepicker">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group form-input">
                            <label for="input-acara_udg">Acara Rapat</label>
                            <input type="input" name="acara_udg" id="input-acara_udg" class="form-control">
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
            <?php echo form_close();?>
            </div>
          </div>

          <div class="tab-pane fade bg-white rounded shadow border-left-primary" id="pills-kegiatan" role="tabpanel" aria-labelledby="pills-kegiatan-tab">
            <div class="col px-0 mt-3 pt-1">
            <?php echo form_open('admin/insertUndanganKegiatan', ['id' => 'default-form', 'log' => 'Input Rapat']);?>
            <!-- 'admin/insertUndanganKegiatan', ['id' => 'default-form', 'log' => 'Input Kegiatan'] -->
                <div class="row px-3 my-3">
                    <div class="col">
                        <div class="form-group">
                            <label for="input-no_udg_kgt">No Surat Kegiatan</label>
                            <input type="text" name="no_udg_kgt" value="<?= $generate_id2 ?>" id="input-no_udg_kgt" class="form-control" readonly>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-lampiran_kgt">Lampiran</label>
                            <input type="text" name="lampiran_kgt" id="input-lampiran_kgt" class="form-control">
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Sifat">Sifat</label>
                            <select id="Sifat" name="sifat_kgt" class="form-control">
                               <option selected>Biasa</option>
                               <option>Penting</option>
                               <option>Segera</option>
                             </select>
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-hal_kgt">Hal</label>
                            <input type="text" name="hal_kgt" id="input-hal_kgt" class="form-control">
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-tujuan_surat_kgt">Pihak yang Diundang</label>
                            <input type="text" name="tujuan_surat_kgt" id="input-tujuan_surat_kgt" class="form-control">
                            <div class="invalid-feedback">
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="input-tempat_udg_kgt">Tempat Kegiatan</label>
                            <input type="text" name="tempat_udg_kgt" id="input-tempat_udg_kgt" class="form-control">
                            <div class="invalid-feedback">
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="input-catatan_kgt">Catatan Penting</label>
                            <input type="text" name="catatan_kgt" id="input-catatan_kgt" class="form-control">
                            <div class="invalid-feedback">
                          </div>
                        </div>
                    </div>
                    <!-- ====================Batas ke 2==================== -->
                    <div class="col">
                        <div class="form-group">
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
                        <div class="form-group">
                            <label for="input-tgl_surat_kgt">Tanggal Surat</label>
                            <input type="text" name="tgl_surat_kgt" id="input-tgl_surat_kgt" class="form-control datepicker">
                            <div class="invalid-feedback">
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="input-jam_udg_kgt">Jam Kegiatan</label>
                            <input type="text" name="jam_udg_kgt" id="input-jam_udg_kgt" class="form-control timepicker">
                            <div class="invalid-feedback">
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="input-acara_udg_kgt">Acara Kegiatan</label>
                            <input type="input" name="acara_udg_kgt" id="input-acara_udg_kgt" class="form-control">
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
          </div>
        </div>
      <!-- </div> -->
