<header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Daftar Notulensi Rapat</h1>
          <hr class="divider my-4">
        </div>
        <?php foreach ($fetch as $row) {  ?>
        <div class="col-lg-10 align-self-baseline">
          <div class="card mb-3" style="max-width: 1000px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img  width="400px" height="200px" src="<?= base_url('./assets/foto/notulensi/'. $row['dokumentasi_rpt'])?>" class="card-img">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">Notulensi Rapat <?= $row['no_notulen']; ?></h5>
                  <p class="card-text text-left">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>
</header>
