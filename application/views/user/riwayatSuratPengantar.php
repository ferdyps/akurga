<header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Daftar Pengajuan Surat Pengantar</h1>
          <hr class="divider my-4">
        </div>
        <div class="col-lg-8 align-self-baseline">
            <table class="table table-striped table-bordered table-dark table-hover">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nomor Surat</th>
                        <th>Keperluan</th>
                        <th>Status</th>
                        <th>Pesan</th>
                        <th>Action</th>
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
                        <td><?= $row['keperluan']?></td>
                        <td><?= $row['status']?></td>
                        <td><?= $row['pesan']?></td>
                        <td>
                            <a class="btn btn-info"  href="<?= base_url('user/editSuratPengantar/'. $row['nomor_surat'])?>" <?php if($row['status'] == 'diterima' || $row['status'] == 'pengajuan') {?> hidden <?php } ?>> Edit</a>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
</header>