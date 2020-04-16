<div class="container-fluid">
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Edit Iuran Keluar</h1>
 </div>
 <div class="container">
     <div class="row bg-white rounded shadow border-left-primary">
       <div class="col px-0">
       <?php foreach($pengeluaran as $b){?> 
       <?=form_open_multipart("Bendahara/update_data_iuran_keluar");?>
           <div class="row px-3 my-3">
               <div class="col">
               <div class="form-group form-input">
                        <label for="diberikan_kepada">Kelompok Anggaran</label>
                        <select name="diberikan_kepada" id="diberikan_kepada" class="form-control">
                            <option selected disabled>-- Kelompok Anggaran --</option>
                            <option <?php echo $b->diberikan_kepada == 'Fotocopy' ? 'selected' : 'Fotocopy' ?> value="Fotocopy">Fotocopy</option>
                            <option <?php echo $b->diberikan_kepada == 'Gaji Petugas' ? 'selected' : 'Gaji Petugas' ?> value="Gaji Petugas">Gaji Petugas</option>
                            <option <?php echo $b->diberikan_kepada == 'Kesehatan' ? 'selected' : 'Kesehatan' ?> value="Kesehatan">Kesehatan</option>
                            <option <?php echo $b->diberikan_kepada == 'Dukacita' ? 'selected' : 'Dukacita' ?>value="Duka Cita">Duka Cita</option>
                            <option <?php echo $b->diberikan_kepada == 'Kebersihan' ? 'selected' : 'Kebersihan' ?>value="Kebersihan">Kebersihan</option>
                            <!-- <option value="DIPLOMA II">DIPLOMA II</option>
                            <option value="AKADEMI/DIPLOMA III/S. MUDA">AKADEMI/DIPLOMA III/S. MUDA</option>
                            <option value="DIPLOMA IV/STRATA I">DIPLOMA IV/STRATA I</option>
                            <option value="STRATA II">STRATA II</option>
                            <option value="STRATA III">STRATA III</option> -->
                        </select>
                    </div>
                   <div class="form-group form-input">
                       <label for="input-tanggal">Tanggal</label>
                       <input type="date" name="tanggal" id="input-tanggal" class="form-control" value="<?php echo $b->tanggal ?>">
                       <div class="invalid-feedback">
                       </div>
                   </div>

                   <div class="form-group form-input">
                       <label for="input-nominal">Nominal</label>
                       <input type="text" name="nominal" id="input-nominal" class="form-control" value="<?php echo $b->nominal ?>">
                       <div class="invalid-feedback">
                       </div>
                   </div>
                   
                   <div class="form-group form-input">
                       <label for="input-digunakan_untuk">Keterangan</label>
                       <input type="text" name="digunakan_untuk" id="input-digunakan_untuk" class="form-control" value="<?php echo $b->digunakan_untuk ?>">
                       <div class="invalid-feedback">
                     </div>
                   </div>
                   <div class="form-group form-input">
                       <label for="input-gambar">Gambar</label>
                       <input type="file" name="gambar" id="input-gambar" class="form-control" value="<?php echo $b->gambar ?>">
                       <div class="invalid-feedback">      
                     </div>
                   </div>
           <div class="col">
               <div class="form-group text-center">
                   <input type="submit" name="edit_keluar" class="btn btn-primary" value ="Edit">
                   <!-- <input type="reset" value="Reset" class="btn btn-danger"> -->
               </div>
           </div>

        <?= form_close();?>
       <?php } ?>
               </div>
               </div>