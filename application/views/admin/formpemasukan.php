<div class="container-fluid">
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Input Iuran Masuk</h1>
 </div>
 <div class="container">
     <div class="row bg-white rounded shadow border-left-primary">
       <div class="col px-0">
       <?php echo form_open();?>
           <div class="row px-3 my-3">
               <div class="col">
                   <div class="form-group">
                       <label for="NIK">NIK</label>
                       <input type="text" name="nik" id="NIK" class="form-control">
                       <div class="invalid-feedback">
                       </div>
                   </div>

                   <div class="form-group">
                       <label for="PembayaranBulan">Pembayaran Bulan</label>
                       <select id="PembayaranBulan" name="pembayaran_bulan" class="form-control">
                 <option selected>Januari</option>
                 <option>Februari</option>
                 <option>Maret</option>
                 <option>April</option>
                 <option>Mei</option>
                 <option>Juni</option>
                 <option>Juli</option>
                 <option>Agustus</option>
                 <option>September</option>
                 <option>Oktober</option>
                 <option>November</option>
                 <option>Desember</option>
               </select>
                   </div>


                   <div class="form-group">
                       <label for="Nominal">Nominal</label>
                       <input type="number" name="nominal" id="Nominal" class="form-control">
                       <div class="invalid-feedback">
                       </div>
                   </div>
                   <div class="form-group">
                       <label for="Tanggal">Tanggal</label>
                       <input type="date" name="tanggal" id="Tanggal" class="form-control">
                       <div class="invalid-feedback">
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
