<header class="masthead h-100">
  <div class="container-fluid">
    <div class="row">
      <div class="container-fluid">
        <?php foreach ($fetch as $row) { ?>
          <?php config_item('setlocal'); ?>
          <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
              <div class="jumbotron jumbotron-fluid border border-dark">
                <div class="container-fluid">
                  <div class="card notulensi-text">
                    <div class="card-body ">
                      <div class="container-fluid">
                        <h2 class="display-4 notulensi-text">Surat undangan rapat nomor <?= str_replace('-','/',$row['no_udg']) ?></h2>
                        <hr class="my-4 border-dark">
                        <h6 class="lead notulensi-text">Lampiran : <?= $row['lampiran_udg'] ?></h6>
                        <h6 class="lead notulensi-text">Sifat <span style="display:inline-block; width: 40px;"></span> : <?= $row['sifat_udg'] ?></h6>
                        <h6 class="lead notulensi-text">Hal <span style="display:inline-block; width: 52px;"></span> : <?= $row['perihal_udg'] ?></h6><br>
                        <h6 class="lead notulensi-text">Kepada</h6>
                        <h6 class="lead notulensi-text"><?= $row['tujuan_surat'] ?></h6><br>
                        <h6 class="lead notulensi-text text-justify"><?= $row['isi_surat'] ?></h6><br>
                        <h6 class="lead notulensi-text"><span style="display:inline-block; width: 50px;"></span> Hari, tanggal : <?= strftime("%A, %d %B %Y",strtotime($row['tgl_udg'])) ?></h6>
                        <h6 class="lead notulensi-text"><span style="display:inline-block; width: 50px;"></span> Waktu <span style="display:inline-block; width: 63px;"></span>: <?= 'Jam '. strftime("%R",strtotime($row['jam_udg'])) .' s/d selesai' ?></h6>
                        <h6 class="lead notulensi-text"><span style="display:inline-block; width: 50px;"></span> Tempat <span style="display:inline-block; width: 50px;"></span>: <?= $row['tempat_udg']; ?></h6>
                        <h6 class="lead notulensi-text"><span style="display:inline-block; width: 50px;"></span> Agenda <span style="display:inline-block; width: 52px;"></span>: <?= $row['acara_udg']; ?></h6><br>
                        <h6 class="lead notulensi-text text-justify">Demikian disampaikan untuk dapat dimaklumi, atas kehadirannya diucapkan terima kasih agar menjadi maklum yang berkepentingan mengetahuinya.</h6><br>
                        <h6 class="lead notulensi-text text-right">Salam Hormat</h6><br>
                        <h6 class="lead notulensi-text text-right">Ketua RT</h6>
                        <?php foreach ($fetch_ketua as $ketua) {?>
                          <h6 class="lead notulensi-text text-right"><?= $ketua['nama']; ?></h6>
                        <?php } ?>
                        <hr class="my-3 border-dark">

                        <?php
                        $exp = explode("-", $row['no_udg']);
                        if ($exp[1] == 'KGT') {
                        ?>
                          <h6 class="lead notulensi-text">Catatan : <?= $row['catatan'];?></h6>
                        <?php } ?>
                        <h6 class="lead notulensi-text">Tembusan : <?= $row['tembusan'];?></h6>
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
