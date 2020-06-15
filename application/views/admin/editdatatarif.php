<div class="container-fluid">
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Edit Iuran Keluar</h1>
 </div>
 <div class="container">
     <div class="row bg-white rounded shadow border-left-primary">
       <div class="col px-0">
       <?php foreach($tarif as $b){?>
       <?=form_open_multipart("Bendahara/update_data_tarif");?>
           <div class="row px-3 my-3">
               <div class="col">
                   <div class="form-group form-input">
                       <label for="input-tanggal">Jenis Iuran</label>
                       <input type="text" name="jenis_iuran" id="jenis_iuran" class="form-control" value="<?php echo $b->jenis_iuran ?>">
                       <div class="invalid-feedback">
                       </div>
                   </div>

                   <div class="form-group form-input">
                       <label for="input-nominal">Nominal</label>
                       <input type="nominal" name="nominal" id="input-nominal" class="form-control" value="<?php echo $b->nominal ?>">
                       <div class="invalid-feedback">
                       </div>
                   </div>

                   <div class="form-group form-input">
                       <!-- <label for="input-digunakan_untuk">Keterangan</label>
                       <input type="text" name="digunakan_untuk" id="input-digunakan_untuk" class="form-control" value="<?php echo $b->digunakan_untuk ?>">
                       <div class="invalid-feedback">
                     </div>
                   </div>
                   <div class="form-group form-input">
                       <label for="input-gambar">Gambar</label>
                       <input type="file" name="gambar" id="input-gambar" class="form-control" value="<?php echo $b->gambar ?>">
                       <p style="color:red">*File-type : .jpg / .jpeg / .png / .gif</p>
                       <div class="invalid-feedback">
                     </div>
                   </div> -->
           <div class="col">
               <div class="form-group text-center">
                   <input type="submit" name="edit_tarif" class="btn btn-primary" value ="Edit">
                   <!-- <input type="reset" value="Reset" class="btn btn-danger"> -->
               </div>
           </div>

        <?= form_close();?>
       <?php } ?>
               </div>
               </div>
