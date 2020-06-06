<div class="container-fluid">
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Input Iuran Masuk</h1>
 </div>

 <div class="wrapper">
   <p><?php echo $this->session->flashdata('pesan'); ?> </p>
 </div>

 <div class="container">
     <div class="row bg-white rounded shadow border-left-primary">
       <div class="col px-0">
         <form  class="" action="" method="get">
           <div class="row px-3 my-3">
           <div class="col">
             <div class="form-group">
               <center>
               <table style="width:100%;">
                 <tr>
                   <td>
                     <?php
                        if(isset($_GET['filternik'])){
                     ?>
                     <input class="form-control" type="number" name="filternik" required placeholder="<?php echo $_GET['filternik'] ?>">
                   <?php }else{ ?>
                     <input class="form-control" type="number" name="filternik" required placeholder="Masukkan NIK">
                   <?php } ?>
                   </td>
                   <td>
                     <input class="btn btn-success" type="submit" name="" value="Check" style="width:100%;">
                   </td>
                 </tr>
              </table>
            </center>
            </div>
          </div>
          </div>
         </form>
       <?php echo form_open_multipart("bendahara/iuranmasuk");
       ini_set( "display_errors", 0);
           if(isset($_GET['filternik'])){
              foreach ($datawarga as $value) {
       ?>
           <div class="row px-3 my-3">
               <div class="col">
                 <input type="hidden" name="nik" id="NIK" class="form-control" value="<?php echo $value->nik; ?>" readonly>
                   <div class="form-group">
                       <label for="NIK">Nama</label>
                       <input type="text" class="form-control" value="<?php echo $value->nama; ?>" readonly>
                       <div class="invalid-feedback">
                       </div>
                   </div>
                   <?php echo form_error('nik','<small class="text-danger">','</small>'); ?>

                    <div class="form-group form-input">
                        <label for="bulantahun">Pembayaran Bulan - Tahun</label>
                        <select name="bulantahun" id="bulanTahun" class="form-control" required>
                          <option value="" disabled selected>Pilih</option>
                          <?php
                            $realtimeYear = date('Y');
                            for ($i = 2018; $i <= $realtimeYear; $i++) {
                              $cekbelumbayar = $this->m_admin->detailBulan($value->nik,$i)->result();
                              if($cekbelumbayar[0]->bulan_januari == null){
                              ?>
                                  <option value="Januari - <?= $i; ?>"><?= "Januari - ".$i; ?></option>
                          <?php
                              }
                              if($cekbelumbayar[0]->bulan_februari == null){
                          ?>
                                <option value="Februari - <?= $i; ?>"><?= "Februari - ".$i; ?></option>
                          <?php
                              }
                              if($cekbelumbayar[0]->bulan_maret == null){
                          ?>
                                <option value="Maret - <?= $i; ?>"><?= "Maret - ".$i; ?></option>
                          <?php
                              }
                              if($cekbelumbayar[0]->bulan_april == null){
                          ?>
                                <option value="April - <?= $i; ?>"><?= "April - ".$i; ?></option>
                          <?php
                              }
                              if($cekbelumbayar[0]->bulan_mei == null){
                          ?>
                                <option value="Mei - <?= $i; ?>"><?= "Mei - ".$i; ?></option>
                          <?php
                              }
                              if($cekbelumbayar[0]->bulan_juni == null){
                          ?>
                                <option value="Juni - <?= $i; ?>"><?= "Juni - ".$i; ?></option>
                          <?php
                              }
                              if($cekbelumbayar[0]->bulan_juli == null){
                          ?>
                                <option value="Juli - <?= $i; ?>"><?= "Juli - ".$i; ?></option>
                          <?php
                              }
                              if($cekbelumbayar[0]->bulan_agustus == null){
                          ?>
                                <option value="Agustus - <?= $i; ?>"><?= "Agustus - ".$i; ?></option>
                          <?php
                              }
                              if($cekbelumbayar[0]->bulan_september == null){
                          ?>
                                <option value="September - <?= $i; ?>"><?= "September - ".$i; ?></option>
                          <?php
                              }
                              if($cekbelumbayar[0]->bulan_oktober == null){
                          ?>
                                <option value="Oktober - <?= $i; ?>"><?= "Oktober - ".$i; ?></option>
                          <?php
                              }
                              if($cekbelumbayar[0]->bulan_november == null){
                          ?>
                                <option value="November - <?= $i; ?>"><?= "November - ".$i; ?></option>
                          <?php
                              }
                              if($cekbelumbayar[0]->bulan_desember == null){
                          ?>
                                <option value="Desember - <?= $i; ?>"><?= "Desember - ".$i; ?></option>
                          <?php
                              }
                            }
                          ?>
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
                       <?php echo form_error('bulantahun'); ?>

                  <div class="form-group">
                      <label for="Jenis-Iuran">Jenis Iuran - <?php echo "Warga ".$value->jenis_warga; ?></label>
                              <?php
                              $tarif = $this->m_admin->tampilTarif($value->jenis_warga)->result();
                              ?>
                                <input type="text" name="nominal" id="nominal" class="form-control" value="<?php echo $tarif[0]->nominal;?>" readonly>
                            </label>
                            <div class="invalid-feedback">
                            </div>
                        </div>


                   <div class="form-group">
                       <label for="Tanggal">Tanggal</label>
                       <input name="tanggal" id="Tanggal" class="form-control" value="<?= $tanggal ?>" readonly>
                       <div class="invalid-feedback">
                       </div>
                   </div>

           <div class="col">
               <div class="form-group text-center">
                   <input type="submit" name="submit_masuk" value="Submit" class="btn btn-primary">
                   <!-- <input type="reset" value="Reset" class="btn btn-danger"> -->
               </div>
           </div>
           <?php
            }
          }else{
          ?>
          <div class="row px-3 my-3">
              <div class="col">
                  <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="number" name="nik" id="NIK" class="form-control" readonly>
                      <div class="invalid-feedback">
                      </div>
                  </div>

                  <?php echo form_error('nik','<small class="text-danger">','</small>'); ?>

                  <div class="form-group">
                      <label for="PembayaranBulan">Pembayaran Bulan - Tahun</label>
                      <select id="bulanTahun" name="bulantahun" class="form-control" required>
                      <option value="" disabled selected>Pilih</option>
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
                  <?php echo form_error('bulantahun'); ?>

                   <div class="form-group">
                       <label for="Jenis-Iuran">Jenis Iuran</label>
                       <input type="number" name="nominal" id="nominal" class="form-control" readonly>
                       <div class="invalid-feedback">
                       </div>
                   </div>

                  <div class="form-group">
                      <label for="Tanggal">Tanggal</label>
                      <input name="tanggal" id="Tanggal" class="form-control" value="<?= $tanggal ?>" readonly>
                      <div class="invalid-feedback">
                      </div>
                  </div>

          <div class="col">
              <div class="form-group text-center">
                  <input type="submit" name="submit_masuk" value="Submit" class="btn btn-primary">
                  <!-- <input type="reset" value="Reset" class="btn btn-danger"> -->
              </div>
          </div>
          <?php
            }
            // echo form_close();

            ?>
       </div>
</div>
