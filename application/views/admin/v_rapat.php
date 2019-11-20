<div class="container-fluid">
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Input Surat Rapat</h1>
 </div>
 <div class="container">
     <div class="row bg-white rounded shadow border-left-primary">
       <div class="col px-0">
       <?php echo form_open();?>
           <div class="row px-3 my-3">
               <div class="col">
                   <div class="form-group">
                       <label for="NomorRapat">No Rapat</label>
                       <input type="text" name="no_rpt" id="NomorRapat" class="form-control">
                       <div class="invalid-feedback">
                           <?= form_error('no_rpt'); ?>
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
                           <?= form_error('lampiran'); ?>
                       </div>
                   </div>

                   <div class="form-group">
                       <label for="Hal">Hal</label>
                       <input type="text" name="hal" id="Hal" class="form-control">
                       <div class="invalid-feedback">
                           <?= form_error('perihal_rpt'); ?>
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
                       <input type="text" name="tempat_rpt" id="TempatRapat" class="form-control">
                       <div class="invalid-feedback">
                           <?= form_error('tempat_rpt'); ?>
                     </div>
                   </div>
                   <div class="form-group" id="tgl_buatrpt">
                       <label for="TanggalBuat">Tanggal Pembuatan Surat</label>
                       <input type="text" name="tgl_buat"  class="form-control" id="datepickerrpt" disabled>
                       <div class="invalid-feedback">
                           <?= form_error('tgl_buat'); ?>
                     </div>
                   </div>
               </div>
               <!-- ====================Batas ke 2==================== -->
               <div class="col">
                   <div class="form-group">
                       <label for="IsiSurat">Isi Surat</label>
                       <textarea style="width: 490px;
                     min-width:490px;
                     max-width:490px;
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
                       <input type="time" name="jam_rpt" id="JamRapat" class="form-control">
                       <div class="invalid-feedback">
                           <?= form_error('jam_rpt'); ?>
                     </div>
                   </div>
                   <div class="form-group">
                       <label for="AcaraRapat">Acara Rapat</label>
                       <input type="input" name="acara_rpt" id="AcaraRapat" class="form-control">
                       <div class="invalid-feedback">
                           <?= form_error('acara_rpt'); ?>
                     </div>
                   </div>
                   <div class="row form-group text-center">
                       <button type="submit" class="btn btn-success btn-circle">
                           <i class="fas fa-check"></i>
                       </button>
                   </div>
               </div>
           </div>
       <?php echo form_close();?>
       </div>
</div>
