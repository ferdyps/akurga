<div class="bgaja">
    <div class="container h-100">
      <?=
      config_item('setlocal');
       ?>
      <br><br><br><br>
      <div class="row h-50 align-items-center justify-content-center text-center">
        <div class="col-lg-12 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Riwayat Notulensi Rapat</h1>
          <hr class="divider my-4">
        </div>

        <div class="card">

          <div class="card-body">
            <table id="tabel_notulensi" class="table">
               <thead>
                 <tr>
                   <th>Riwayat Notulensi Rapat</th>
                 </tr>
               </thead>
               <!-- <tbody>
                 <tr>
                   <td> -->
                     <!-- <div class="media position-relative">
                       <div class="media-body">
                         <div class="col-lg-12 align-self-baseline">
                           <div class="card mb-3" style="max-width: 1200px;">
                             <div class="row no-gutters">
                               <div class="col-md-4">
                                 <img height="300px" src="<?= base_url('./assets/foto/notulensi/'. $row['dokumentasi_rpt'])?>" class="card-img">
                               </div>
                               <div class="col-md-8">
                                 <div class="card-body">
                                   <h6 class="card-title text-right">Diunggah <?= strftime("%d %B %Y",strtotime($row['tgl_buat'])); ?> </h6>
                                   <h2 class="card-title text-left">Notulensi Rapat dengan undangan rapat nomor <?= str_replace('-','/',$row['no_udg']); ?> </h2>
                                   <p class="card-text text-justify"><?= $row['acara_udg']; ?></p>
                                   <span class="card-text text-left">Rapat telah dilaksanakan pada  tanggal <?= strftime("%d %B %Y",strtotime($row['tgl_udg'])); ?></span><br>
                                   <a href="<?= base_url("user/notulensi_rapat").'/'.$row['no_notulen'];?>" class="stretched-link">Selengkapnya</a>
                                 </div>
                               </div>
                             </div>
                           </div>
                         </div>
                       </div>
                     </div> -->
                   <!-- </td>
                 </tr> -->
               <!-- </tbody> -->

          </table>
          </div>
        </div>



      </div>
    </div>
</div>
