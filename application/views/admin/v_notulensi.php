<div class="container-fluid">
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Input Notulensi Rapat</h1>
 </div>
 <div class="container">
     <div class="row bg-white rounded shadow border-left-primary">
       <div class="col px-0">
       <?php echo form_open('admin/insertNotulen', ['id' => 'default-form', 'log' => 'Input Notulensi']);?>
           <div class="row px-3 my-3">
               <div class="col">
                   <div class="form-group form-input">
                       <label for="input-no_notulen">No Notulensi Rapat</label>
                       <input type="text" name="no_notulen" value="<?= $generate_id  ?>" id="input-no_notulen" class="form-control" readonly>
                       <div class="invalid-feedback">

                       </div>
                   </div>
                   <div class="form-group form-input">
                       <label for="dokumentasi_rpt">Dokumentasi Rapat</label>
                       <div class="custom-file">
                         <input type="file" name="dokumentasi_rpt" class="custom-file-input" id="dokumentasi_rpt">
                         <label class="custom-file-label">Choose file</label>
                       </div>
                       <div class="invalid-feedback">

                     </div>
                   </div>



               </div>
               <!-- ====================Batas ke 2==================== -->
               <div class="col">
                 <div class="form-group form-input">
                     <label for="tembusan">Tembusan</label>
                     <textarea style="width: 520px;
                   min-width:520px;
                   max-width:520px;
                   height:210px;
                   min-height:125px;
                   max-height:125px;"
                   class="form-control" name="tembusan" id="tembusan"></textarea>
                     <div class="invalid-feedback">

                   </div>
                 </div>

               </div>
           </div>
           <div class="row px-3 my-3">
               <div class="col">
                   <div class="form-group form-input">
                     <label>Uraian Notulensi</label>
                     <textarea name="uraian_notulen" id="editornotulen1" cols="30" rows="10" class="ckeditor"></textarea>
                     <div class="invalid-feedback"></div>
                   </div>
               </div>
           </div>
           <div class="col">
               <input type="hidden" name="no_udg" id="input-no_udg" value="<?= $key_no_udg  ?>" class="form-control">
               <div class="form-group text-center">
                   <input type="submit" class="btn btn-primary">
                   <input type="reset" value="Reset" class="btn btn-danger">
               </div>
           </div>
       <?php echo form_close();?>
       </div>
</div>

<script>
              // Replace the <textarea id="editor1"> with a CKEditor
              // instance, using default configuration.
              CKEDITOR.replace( 'editornotulen1' );
          </script>
