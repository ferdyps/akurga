<div class="bgaja">
    <div class="container h-100">
      <br><br><br><br>
      <div class="row h-50 align-items-center justify-content-center text-center">
        <div class="col-lg-12 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Riwayat Surat Undangan Rapat</h1>
          <hr class="divider my-4">
        </div>

        <?php
        foreach ($fetch as $row) {  ?>
          <div class="media position-relative">
            <div class="media-body">
              <div class="col-lg-12 align-self-baseline">
                <div class="card mb-3" style="max-width: 1000px;">
                  <div class="row no-gutters">
                    <div class="col-md-4">
                      <img src="<?= base_url('./assets/foto/bandung.jpg') ?>" class="card-img img-fluid">
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                        <?php config_item('setlocal'); ?>
                        <h6 class="card-title text-right">Tanggal Rapat <?= strftime("%d %B %Y",strtotime($row['tgl_udg'])); ?> </h6>
                        <h2 class="card-title text-left">Surat undangan rapat nomor <?= str_replace('-','/',$row['no_udg']); ?> </h2>
                        <p class="card-text text-justify"><?= $row['acara_udg']; ?></p>
                        <!-- <span class="card-text text-left">Rapat telah dilaksanakan pada  tanggal <?= strftime("%d %B %Y",strtotime($row['tgl_udg'])); ?></span><br> -->
                        <a href="<?= base_url("user/rapat_detail").'/'.$row['no_udg'];?>" class="stretched-link">Selengkapnya</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

      <?php } ?>
      </div>
    </div>
</div>
