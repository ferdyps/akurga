<div class="container-fluid">
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Input Arsip Surat</h1>
 </div>
 <div class="container">
      <?php echo form_open();?>
   <ul class="nav nav-tabs" id="myTab" role="tablist">
     <li class="nav-item">
       <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Surat Masuk</a>
     </li>
     <li class="nav-item">
       <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Surat Keluar</a>
     </li>
   </ul>
   <div class="tab-content" id="myTabContent">
     <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
       <div class="row bg-white rounded shadow border-left-primary">
         <div class="col px-0">
             <div class="row px-3 my-3">
                 <div class="col">
                     <div class="form-group">
                         <label for="NomorKegiatan">No Surat Kegiatan</label>
                         <input type="text" name="no_udg" id="NomorKegiatan" class="form-control" disabled>
                         <div class="invalid-feedback">
                             <?= form_error('no_udg'); ?>
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
                         <label for="Sifat">Sifat</label>
                         <select id="Sifat" name="sifat" class="form-control">
                            <option selected>Biasa</option>
                            <option>Penting</option>
                            <option>Segera</option>
                          </select>
                         <div class="invalid-feedback">
                             <?= form_error('lampiran'); ?>
                         </div>
                     </div>
                     <div class="form-group">
                         <label for="Sifat">Sifat</label>
                         <select id="Sifat" name="sifat" class="form-control">
                            <option selected>Biasa</option>
                            <option>Penting</option>
                            <option>Segera</option>
                          </select>
                         <div class="invalid-feedback">
                             <?= form_error('lampiran'); ?>
                         </div>
                     </div>


                     </div>
                     <div class="col">
                         <div class="form-group">
                             <label for="IsiSurat">Isi Surat</label>
                             <textarea style="width: 520px;
                           min-width:520px;
                           max-width:520px;
                           height:125px;
                           min-height:125px;
                           max-height:125px;"
                           class="form-control" name="isi_surat" id="IsiSurat"></textarea>
                             <div class="invalid-feedback">
                                 <?= form_error('isi_surat'); ?>
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
                             <label for="TanggalSurat">Tanggal Surat</label>
                             <input type="date" name="tgl_surat" id="TanggalSurat" class="form-control">
                             <div class="invalid-feedback">
                                 <?= form_error('tgl_surat'); ?>
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
  </div>

     </div>
          <!-- ==================== Bagian surat keluar ================================= -->
     <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">.b.

     </div>
   </div>
       <?php echo form_close();?>
