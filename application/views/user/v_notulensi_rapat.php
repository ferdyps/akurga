<header class="masthead h-100">
  <div class="container-fluid">
    <div class="row">
      <div class="container-fluid">
        <?php foreach ($fetch as $row) { ?>
          <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
              <div class="jumbotron jumbotron-fluid border border-dark">
                <div class="container-fluid">
                  <div class="card notulensi-text">
                    <div class="card-body ">
                      <div class="container-fluid">
                        <h2 class="display-4 notulensi-text">Notulensi Rapat <?= $row['no_notulen']  ?></h2>
                        <h4 class="notulensi-text">Agenda : <?= $row['acara_udg']; ?></h4>
                        <h6 class="lead notulensi-text">By <?= $row['penulis']; ?></h6>
                        <h6 class="lead notulensi-text">Diunggah pada tanggal <?= $row['tgl_acc']; ?></h6>
                        <img width="1000px" height="800px" class="img-thumbnail img-fluid mx-auto d-block" src="<?= base_url('./assets/foto/notulensi/'. $row['dokumentasi_rpt'])?>">
                      </div><br>

                      <?= $row['uraian_notulen']; ?>
                      <hr class="my-4 border-dark">
                      <h6>Tembusan : <?= $row['tembusan'];?> </h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-2"></div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</header>
