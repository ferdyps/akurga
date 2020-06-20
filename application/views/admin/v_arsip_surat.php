<div class="container-fluid">
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Input Arsip Surat Masuk</h1>
 </div>
 <div class="container">
   <?php echo form_open_multipart('sekretaris/insertArsipMasuk', ['id' => 'default-form', 'log' => 'Arsip Surat']);?>
       <div class="row bg-white rounded shadow border-left-primary">
         <!-- <div id="flash-data2" data-flashdata2="<?= $this->session->flashdata('error'); ?>"></div> -->
         <div class="col px-0">
             <div class="row px-3 my-3">
                 <div class="col">
                     <div class="form-group form-input">
                         <label for="input-kd_surat">Kode Surat</label>
                         <input type="text" name="kd_surat" id="input-kd_surat" value="<?= $generate_id ?>" class="form-control" readonly>
                         <div class="invalid-feedback">
                         </div>
                     </div>
                     <br><br>
                     <div class="form-group form-input">
                         <label for="input-no_surat">Nomor Surat</label>
                         <input type="text" name="no_surat" id="input-no_surat" class="form-control">
                         <div class="invalid-feedback"></div>
                         <p class="text-mute">* Inputkan nomor surat yang terdapat pada surat fisik.</p>
                     </div>

                     <div class="form-group form-input">
                         <label for="input-pengirim">Pengirim</label>
                         <input type="text" name="pengirim" id="input-pengirim" class="form-control">
                         <div class="invalid-feedback">
                         </div>
                     </div>

                     <div class="form-group form-input">
                         <label for="input-tgl_terima">Tanggal Terima Surat</label>
                         <input type="text" name="tgl_terima" id="input-tgl_terima" class="form-control datepickerArsip">
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
                             <p class="text-mute">*Ukuran file Maksimal 2 MB <br> *file yang di izinkan .jpg .jpeg, atau .png</p>
                             <div class="invalid-feedback"></div>
                         </div>
                         <div class="form-group form-input">
                             <label for="input-tgl_surat">Tanggal Surat</label>
                             <input type="text" name="tgl_surat" id="input-tgl_surat" class="form-control datepickerStandar">
                             <div class="invalid-feedback">

                           </div>
                           <p class="text-mute">* Inputkan tanggal surat yang terdapat pada surat fisik.</p>
                         </div>

                         <div class="form-group form-input">
                             <label for="input-keterangan">Keterangan</label>
                             <textarea style="width: 520px;
                           min-width:520px;
                           max-width:520px;
                           height:125px;
                           min-height:125px;
                           max-height:125px;"
                           class="form-control" name="keterangan" id="input-keterangan"></textarea>
                             <div class="invalid-feedback">

                           </div>
                         </div>
                     </div>
                 </div>

                 <div class="col">
                     <div class="form-group text-center">
                         <input type="submit" class="btn btn-primary">
                     </div>
                 </div>
             </div>
         </div>
          <?php echo form_close();?>
   </div>

<script>
$('#gbr_surat').on('change',function(){
               //get the file name
               var fileName = $(this).val();
               //replace the "Choose a file" label
               $(this).next('.custom-file-label').html(fileName);
           })
</script>
