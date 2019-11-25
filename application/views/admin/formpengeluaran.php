<div class="container-fluid">
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Input Iuran Keluar</h1>
 </div>
 <div class="container">
     <div class="row bg-white rounded shadow border-left-primary">
       <div class="col px-0">
       <?=form_open_multipart("c_halaman_admin/iurankeluar");?>
           <div class="row px-3 my-3">
               <div class="col">
                   <div class="form-group">
                       <label for="DiberikanKepada">Diberikan Kepada</label>
                       <input type="text" name="diberikan_kepada" id="DiberikanKepada" class="form-control">
                       <div class="invalid-feedback">
                       </div>
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

                   <div class="form-group">
                       <label for="DigunakanUntuk">Digunakan Untuk</label>
                       <input type="text" name="digunakan_untuk" id="DigunakanUntuk" class="form-control">
                       <div class="invalid-feedback">
                     </div>
                   </div>
                   <div class="form-group">
                       <label for="Gambar">Gambar</label>
                       <input type="file" name="gambar" id="Gambar" class="form-control">
                       <div class="invalid-feedback">      
                     </div>
                   </div>
           <div class="col">
               <div class="form-group text-center">
                   <input type="submit" name="submit" class="btn btn-primary">
                   <input type="reset" value="Reset" class="btn btn-danger">
               </div>
           </div>
       <?php=form_close();?>
       </div>
</div>
