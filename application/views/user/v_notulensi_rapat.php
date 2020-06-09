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
                        <h2 class="display-4 notulensi-text">Notulensi Rapat dengan undangan rapat nomor <?= str_replace('-','/',$row['no_udg']) ?></h2>
                        <hr class="my-4 border-dark">
                        <h6 class="lead notulensi-text">Nomor notulensi <?= str_replace('-','/',$row['no_notulen']) ?></h6>

                        <h6 class="lead notulensi-text">Notulensi By <?= substr($row['penulis'],0,10).' '.$row['rt']; ?></h6>
                        <?php config_item('setlocal'); ?>
                        <h6 class="lead notulensi-text">Diunggah pada tanggal <?= strftime("%d %B %Y",strtotime($row['tgl_buat'])); ?></h6><br>
                        <img width="1000px" height="800px" class="img-thumbnail img-fluid mx-auto d-block" src="<?= base_url('./assets/foto/notulensi/'. $row['dokumentasi_rpt'])?>">
                        <div class="media">
                          <div class="media-body">
                            <h6 class="mt-0 ml-5 pl-3 mb-5 text-muted"><?= $row['keterangan_dokumentasi'] ?></h6>
                          </div>
                        </div>
                        <h6 class="lead notulensi-text">Rapat dilaksanakan pada :</h6>
                        <h6 class="lead notulensi-text">Tanggal : <?= strftime("%d %B %Y",strtotime($row['tgl_udg'])); ?></h6>
                        <h6 class="lead notulensi-text">Waktu : Jam <?= strftime("%R",strtotime($row['jam_udg'])); ?> s/d selesai</h6>
                        <h6 class="lead notulensi-text">Tempat : <?= $row['tempat_udg']; ?></h6>
                        <h6 class="lead notulensi-text">Agenda : <?= $row['acara_udg']; ?></h6>
                        <hr class="my-3 border-dark">
                        <h6 class="notulensi-text">HASIL PERTEMUAN :</h6>
                        <?= $row['uraian_notulen']; ?>
                        <hr class="my-4 border-dark">
                        <h6>Tembusan : <?= $row['tembusan'];?> </h6>
                      </div>
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
