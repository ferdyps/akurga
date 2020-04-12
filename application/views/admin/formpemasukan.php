<div class="container-fluid">
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Input Iuran Masuk</h1>
 </div>
 <div class="container">
     <div class="row bg-white rounded shadow border-left-primary">
       <div class="col px-0">
       <?php echo form_open_multipart("admin/iuranmasuk");
       ?>
           <div class="row px-3 my-3">
               <div class="col">
                   <div class="form-group">
                       <label for="NIK">NIK</label>
                       <input type="number" name="nik" id="NIK" class="form-control">
                       <div class="invalid-feedback">
                       </div>
                   </div>
                   <?php echo form_error('nik','<small class="text-danger">','</small>'); ?>

                   <div class="form-group">
                       <label for="PembayaranBulan">Pembayaran Bulan</label>
                       <select id="PembayaranBulan" name="pembayaran_bulan" class="form-control">
                       <?php 
                        $no = 1;
                            foreach ($bulan as $bulan) {?> 
                                   <option value ="<?= $bulan ?>"> <?= $bulan ?></option>
                            <?php }?>
               </select>
                <?php if ($this->session->flashdata('pembayaran')) {
                    ?>
                    <a href="#" class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                    <span class="text"><?= $this->session->flashdata('pembayaran');?></span>
                    </a>
                    <?php
                }?>                  
                   </div>
                   <?php echo form_error('pembayaran_bulan'); ?>

                <div class ="form-group">
                    <label class="control-label col-md-3">Jenis Iuran</label>
                    <div class="col-md-8">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" id="pedagang" type="radio" name='nominal' value="15000">Warga Tetap
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" id="bukanpedagang" type="radio" name='nominal' value="10000"> Sementara
                            </label>
                        </div>   
                    </div>

                </div>


                   <div class="form-group">
                       <label for="Tanggal">Tanggal</label>
                       <input name="tanggal" id="Tanggal" class="form-control" value="<?= $tanggal ?>">
                       <div class="invalid-feedback">
                       </div>
                   </div>

           <div class="col">
               <div class="form-group text-center">
                   <input type="submit" name="submit_masuk" value="Submit" class="btn btn-primary">
                   <!-- <input type="reset" value="Reset" class="btn btn-danger"> -->
               </div>
           </div>
       <!-- <?php echo form_close();?> -->
       </div>
</div>
