<div class="container-fluid">
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Input Arsip Surat Masuk/Keluar</h1>
 </div>
 <div class="container">
   <?php echo form_open();?>
       <div class="row bg-white rounded shadow border-left-primary">
         <div class="col px-0">
             <div class="row px-3 my-3">
                 <div class="col">
                     <div class="form-group">
                         <label for="kode_srt">Kode Surat</label>
                         <input type="text" name="kd_surat" id="kode_srt" class="form-control" disabled>
                         <div class="invalid-feedback">
                             <?= form_error('kd_surat'); ?>
                         </div>
                     </div>
                     <div class="form-group">
                         <label for="no_surat">Nomor Surat</label>
                         <input type="text" name="no_surat" id="no_surat" class="form-control">
                         <div class="invalid-feedback">
                             <?= form_error('no_surat'); ?>
                         </div>
                     </div>

                     <div class="form-group">
                         <label for="Pengirim">Pengirim</label>
                         <input type="text" name="pengirim" id="Pengirim" class="form-control">
                         <div class="invalid-feedback">
                             <?= form_error('pengirim'); ?>
                         </div>
                     </div>

                     <div class="form-group">
                         <label for="Tgl_Terima">Tanggal Terima Surat</label>
                         <input type="date" name="tgl_terima" id="Tgl_Terima" class="form-control">
                         <div class="invalid-feedback">
                             <?= form_error('tgl_terima'); ?>
                         </div>
                     </div>


                     </div>

                     <div class="col">

                         <div class="form-group">
                             <label for="Gbr_surat">Gambar Surat</label>
                             <div class="custom-file">
                               <input type="file" class="custom-file-input" id="inputGroupFile01">
                               <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                             </div>
                             <div class="invalid-feedback">
                                 <?= form_error('tgl_surat'); ?>
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
                             <label for="Keterangan">Keterangan</label>
                             <textarea style="width: 520px;
                           min-width:520px;
                           max-width:520px;
                           height:125px;
                           min-height:125px;
                           max-height:125px;"
                           class="form-control" name="keterangan" id="Keterangan"></textarea>
                             <div class="invalid-feedback">
                                 <?= form_error('keterangan'); ?>
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
             </div>
         </div>

          <?php echo form_close();?>

   </div>
