<header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Daftar Pengaduan</h1>
          <hr class="divider my-4">
        </div>
        <div class="col-lg-8 align-self-baseline">
            <table class="table table-striped table-bordered table-hover table-sm" id="dataTable">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nomor Komplain</th>
                        <th>Tanggal Pengaduan</th>
                        <th>Keluhan</th>
                        <th>Lokasi</th>
                        <th>Lingkup</th>
                        <th>Status</th>
                        <th>Hasil</th>
                    </tr>
                </thead>
                <tbody class="table-light">
                <?php
                    $i=1; 
                    foreach($listKomplain as $row)
                {?>
                    <tr>
                        <th><?= $i++?></th>
                        <td><?= $row['nomor_komplain']?></td>
                        <td><?= $row['tanggal_komplain']?></td>
                        <td><?= $row['keluhan']?></td>
                        <td><?= $row['lokasi']?></td>
                        <td><?= $row['lingkup']?></td>
                        <td><?= $row['status']?></td>
                        <td><a class='btn btn-primary' href="<?= base_url('user/hasilKomplain/'.$row['nomor_komplain'])?>" <?php if($row['status'] != 'selesai') { ?> hidden <?php } ?>>Hasil</a></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
</header>