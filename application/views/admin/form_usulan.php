<div class="container-fluid">
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Input Usulan Rapat</h1>
 </div>
 <div class="container">
     <div class="row bg-white rounded shadow border-left-primary">
       <div class="col px-0">
       <?php echo form_open('ketuaRT/insertUsulanRT', ['id' => 'default-form', 'log' => 'Usulan Surat Undangan']);?>
           <div class="row px-3 my-3">
               <div class="col">


                 <div class="form-group form-input">
                     <label for="No_Udg">Jenis Surat</label>
                     <select id="No_Udg" name="no_udg" class="form-control">
                        <option class="text-muted" selected  disabled>-- PILIH JENIS SURAT --</option>
                        <option value="<?= $generate_id; ?>">  Surat Undangan Rapat</option>
                        <option value="<?= $generate_id2; ?>"> Surat Undangan Kegiatan</option>
                      </select>
                     <div class="invalid-feedback"></div>
                 </div>
                 <div class="form-group form-input">
                     <label for="input-usul_surat">Usulan Rapat</label>
                     <textarea style="width: 530px;
                   min-width:530px;
                   max-width:530px;
                   height:210px;
                   min-height:210px;
                   max-height:210px;"
                   class="form-control" name="usul_surat" id="input-usul_surat"></textarea>
                     <div class="invalid-feedback">
                   </div>
                 </div>

               </div>
               <!-- ====================Batas ke 2==================== -->
               <div class="col">
                 <div class="form-group form-input">
                     <label for="input-tujuan_surat">Pihak Yang Diundang</label>
                     <input type="text" name="tujuan_surat" id="input-tujuan_surat" class="form-control">
                     <div class="invalid-feedback"></div>
                 </div>
                 <div class="form-group form-input">
                     <label for="input-tempat_udg">Tempat Rapat</label>
                     <input type="text" name="tempat_udg" id="input-tempat_udg" class="form-control">
                     <div class="invalid-feedback"></div>
                 </div>
                 <div class="form-group form-input">
                     <label for="input-tgl_rpt">Tanggal rapat</label>
                     <input type="text" name="tgl_rpt" id="input-tgl_rpt" class="form-control datepicker">
                     <div class="invalid-feedback"></div>
                 </div>
                 <div class="form-group form-input">
                     <label for="input-jam_udg">Jam Rapat</label>
                     <input type="text" name="jam_udg" id="input-jam_udg" class="form-control timepicker">
                     <div class="invalid-feedback"></div>
                 </div>

               </div>
           </div>
           <div class="col">
               <div class="form-group text-center">
                   <input type="submit" value="Submit" class="btn btn-primary">
               </div>
           </div>
       <?php echo form_close();?>
       </div>
</div>
