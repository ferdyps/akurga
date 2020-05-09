<div class="container-fluid">
 <!-- Page Heading -->
 
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Input Iuran Keluar</h1>
 </div>
 <div class="container">
 
     <div class="row bg-white rounded shadow border-left-primary">
       <div class="col px-0">
       <!-- <?php if(!empty(validation_errors())) :
        // ?>
  <!-- <?php echo validation_errors() ?> -->
<!-- <?php endif; ?>  -->
       <?=form_open_multipart("Bendahara/iurankeluar");
        $tanggal = date("d-m-Y");?>
      
           <div class="row px-3 my-3">
               <div class="col">
               <div class="form-group form-input">
                        <label for="diberikan_kepada">Kelompok Anggaran</label>
                        <select name="diberikan_kepada" id="Pendidikan" class="form-control">
                            <option selected disabled>-- Kelompok Anggaran --</option>
                            <option value="Fotocopy">Fotocopy</option>
                            <option value="Gaji Pegawai">Gaji Pegawai</option>
                            <option value="Kesehatan">Kesehatan</option>
                            <option value="Duka Cita">Duka Cita</option>
                            <option value="Kebersihan">Kebersihan</option>
                            <!-- <option value="DIPLOMA II">DIPLOMA II</option>
                            <option value="AKADEMI/DIPLOMA III/S. MUDA">AKADEMI/DIPLOMA III/S. MUDA</option>
                            <option value="DIPLOMA IV/STRATA I">DIPLOMA IV/STRATA I</option>
                            <option value="STRATA II">STRATA II</option>
                            <option value="STRATA III">STRATA III</option> -->
                        </select>
                    </div>
                   <?php echo form_error('diberikan_kepada','<small class="text-danger">','</small>'); ?>

                   <div class="form-group form-input">
                       <label for="input-tanggal">Tanggal</label>
                       <input name="tanggal" id="input-tanggal" class="form-control" value="<?= date("d-m-Y",strtotime($tanggal)) ?>">
                       <div class="invalid-feedback">
                       </div>
                   </div>
                   <?php echo form_error('tanggal'); ?>

                   <div class="form-group form-input">
                       <label for="input-nominal">Nominal</label>
                       <input type="number" name="nominal" id="input-nominal" class="form-control" >
                       <div class="invalid-feedback">
                       </div>
                   </div>
                   <?php echo form_error('nominal','<small class="text-danger">','</small>'); ?>
                   
                   <div class="form-group form-input">
                       <label for="input-digunakan_untuk">Keterangan</label>
                       <input type="text" name="digunakan_untuk" id="input-digunakan_untuk" class="form-control">
                       <div class="invalid-feedback">
                     </div>
                   </div>
                   <?php echo form_error('digunakan_untuk','<small class="text-danger">','</small>'); ?>

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
        <?= form_close();?> 
       </div>
</div>
