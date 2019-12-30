<header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Daftar Pengajuan Surat Pengantar</h1>
          <hr class="divider my-4">
        </div>
        <div class="col-lg-8 align-self-baseline">
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nomor Surat</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Keperluan</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i=1; 
                    foreach($listSurat as $row)
                {?>
                    <tr>
                        <th><?= $i++?></th>
                        <td><?= $row['nomor_surat']?></td>
                        <td><?= $row['tanggal_surat']?></td>
                        <td><?= $row['keperluan']?></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
</header>