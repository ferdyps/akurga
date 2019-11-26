<div class="container-fluid">
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Input Surat Undangan Rapat</h1>
 </div>
 <div class="container">
     <div class="row bg-white rounded shadow border-left-primary">
       <div class="col px-0">
       <?php echo form_open();?>
           <div class="row px-3 my-3">
               <div class="col">
                   <div class="form-group">
                       <label for="NomorRapat">No Surat Rapat</label>
                       <input type="text" name="no_udg" id="NomorRapat" class="form-control" disabled>
                       <div class="invalid-feedback">
                           <?= form_error('no_udg'); ?>
                       </div>
                   </div>
                   <div class="form-group">
                       <label for="Lampiran">Lampiran</label>
                       <input type="text" name="lampiran" id="Lampiran" class="form-control">
                       <div class="invalid-feedback">
                           <?= form_error('lampiran'); ?>
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
                           <?= form_error('sifat'); ?>
                       </div>
                   </div>

                   <div class="form-group">
                       <label for="Hal">Hal</label>
                       <input type="text" name="hal" id="Hal" class="form-control">
                       <div class="invalid-feedback">
                           <?= form_error('hal'); ?>
                       </div>
                   </div>

                   <div class="form-group">
                       <label for="TujuanSurat">Tujuan Surat</label>
                       <input type="text" name="tujuan_surat" id="TujuanSurat" class="form-control">
                       <div class="invalid-feedback">
                           <?= form_error('tujuan_surat'); ?>
                     </div>
                   </div>
                   <div class="form-group">
                       <label for="TempatRapat">Tempat Rapat</label>
                       <input type="text" name="tempat_udg" id="TempatRapat" class="form-control">
                       <div class="invalid-feedback">
                           <?= form_error('tempat_udg'); ?>
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
                           <?= form_error('tembusan'); ?>
                     </div>
                   </div>
               </div>
               <!-- ====================Batas ke 2==================== -->
               <div class="col">
                   <div class="form-group">
                       <label for="IsiSurat">Isi Surat</label>
                       <textarea style="width: 530px;
                     min-width:530px;
                     max-width:530px;
                     height:210px;
                     min-height:210px;
                     max-height:210px;"
                     class="form-control" name="isi_surat" id="IsiSurat"></textarea>
                       <div class="invalid-feedback">
                           <?= form_error('isi_surat'); ?>
                     </div>
                   </div>
                   <div class="form-group">
                       <label for="TanggalSurat">Tanggal Surat</label>
                       <input type="date" name="tgl_surat" id="TanggalSurat" class="form-control">
                       <div class="invalid-feedback">
                           <?= form_error('tgl_surat'); ?>
                     </div>
                   </div>
                   <div class="form-group">
                       <label for="JamRapat">Jam Rapat</label>
                       <input type="time" name="jam_udg" id="JamRapat" class="form-control">
                       <div class="invalid-feedback">
                           <?= form_error('jam_udg'); ?>
                     </div>
                   </div>
                   <div class="form-group">
                       <label for="AcaraRapat">Acara Rapat</label>
                       <input type="input" name="acara_udg" id="AcaraRapat" class="form-control">
                       <div class="invalid-feedback">
                           <?= form_error('acara_udg'); ?>
                     </div>
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
