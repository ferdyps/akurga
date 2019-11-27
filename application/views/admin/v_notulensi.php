<div class="container-fluid">
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Input Notulensi Rapat</h1>
 </div>
 <div class="container">
     <div class="row bg-white rounded shadow border-left-primary">
       <div class="col px-0">
       <?php echo form_open();?>
           <div class="row px-3 my-3">
               <div class="col">
                   <div class="form-group">
                       <label for="NomorNotulensi">No Notulensi Rapat</label>
                       <input type="text" name="no_notulen" id="NomorNotulensi" class="form-control" disabled>
                       <div class="invalid-feedback">
                           <?= form_error('no_notulen'); ?>
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
                       <label for="Tembusan">Tembusan</label>
                       <textarea style="width: 520px;
                     min-width:520px;
                     max-width:520px;
                     height:210px;
                     min-height:210px;
                     max-height:210px;"
                     class="form-control" name="tembusan" id="Tembusan"></textarea>
                       <div class="invalid-feedback">
                           <?= form_error('tembusan'); ?>
                     </div>
                   </div>

               </div>
               <!-- ====================Batas ke 2==================== -->
               <div class="col">
                   <div class="form-group">
                       <label for="UraianNotulensi">Uraian Notulensi</label>
                       <textarea style="width: 530px;
                     min-width:530px;
                     max-width:530px;
                     height:510px;
                     min-height:510px;
                     max-height:510px;"
                     class="form-control" name="uraian_notulen" id="UraianNotulensi"></textarea>
                       <div class="invalid-feedback">
                           <?= form_error('uraian_notulen'); ?>
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
