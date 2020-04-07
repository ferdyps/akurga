<header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-12 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Daftar Notulensi Rapat</h1>
          <hr class="divider my-4">
        </div>

        <?php
        foreach ($fetch as $row) {  ?>
          <div class="media position-relative">
            <div class="media-body">
              <div class="col-lg-12 align-self-baseline">
                <div class="card mb-5" style="max-width: 1200px;">
                  <div class="row no-gutters">
                    <div class="col-md-4">
                      <img width="400px" height="260px" src="<?= base_url('./assets/foto/notulensi/'. $row['dokumentasi_rpt'])?>" class="card-img mx-auto d-block">
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                        <?php config_item('setlocal'); ?>
                        <h6 class="card-title text-right">Diunggah <?= strftime("%d %B %Y",strtotime($row['tgl_acc'])); ?> </h6>
                        <h2 class="card-title text-left">Notulensi Rapat <?= $row['no_notulen']; ?> </h2>
                        <p class="card-text text-left bg-primary mr-10"><?= $row['acara_udg']; ?></p>
                        <p class="card-text text-right"><?= $row['penulis']; ?></p>
                        <a href="#" class="stretched-link">Go somewhere</a>

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
</header>
