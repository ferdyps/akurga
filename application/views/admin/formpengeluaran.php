<div class="container-fluid">
 <!-- Page Heading -->
 
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Input Iuran Keluar</h1>
 </div>
 <div class="container">
 
     <div class="row bg-white rounded shadow border-left-primary">
       <div class="col px-0">
       <!-- <?php if(!empty(validation_errors())) :
        ?>
  <?php echo validation_errors() ?>
<?php endif; ?> -->
       <?=form_open_multipart("admin/iurankeluar");
        $tanggal = date("Y-m-d");?>
      
           <div class="row px-3 my-3">
               <div class="col">
                   <div class="form-group form-input">
                       <label for="input-diberikan_kepada">Diberikan Kepada</label>
                       <input type="text" name="diberikan_kepada" id="input-diberikan_kepada" class="form-control">
                       <div class="invalid-feedback">
                       </div>
                   </div>
                   <?php echo form_error('diberikan_kepada'); ?>

                   <div class="form-group form-input">
                       <label for="input-tanggal">Tanggal</label>
                       <input name="tanggal" id="input-tanggal" class="form-control" value="<?=$tanggal ?>">
                       <div class="invalid-feedback">
                       </div>
                   </div>
                   <?php echo form_error('tanggal'); ?>

                   <div class="form-group form-input">
                       <label for="input-nominal">Nominal</label>
                       <input type="text" name="nominal" id="input-nominal" class="form-control" >
                       <div class="invalid-feedback">
                       </div>
                   </div>
                   <?php echo form_error('nominal'); ?>
                   
                   <div class="form-group form-input">
                       <label for="input-digunakan_untuk">Digunakan Untuk</label>
                       <input type="text" name="digunakan_untuk" id="input-digunakan_untuk" class="form-control">
                       <div class="invalid-feedback">
                     </div>
                   </div>
                   <?php echo form_error('digunakan_untuk'); ?>

                   <div class="form-group form-input">
                       <label for="input-gambar">Gambar</label>
                       <input type="file" name="gambar" id="input-gambar" class="form-control">
                       <div class="invalid-feedback">      
                     </div>
                   </div>
                   <?php echo form_error('gambar'); ?>
           <div class="col">
               <div class="form-group text-center">
                   <input type="submit" name="submit" class="btn btn-primary">
                   <input type="reset" value="Reset" class="btn btn-danger">
               </div>
           </div>
       <!-- <?php=form_close();?> -->
       </div>
</div>
