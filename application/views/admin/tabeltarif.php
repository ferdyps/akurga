<div class="container-fluid">

<!-- Page Heading -->
<!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
-->
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tabel Tarif Iuran Warga RT.<?= $this->session->userdata('rt'); ?></h6>
  </div>
  <center>
  <!-- <div class="row bg-white rounded shadow"> -->
  <div class="col-6" >
  <a class="btn btn-success"  href="<?= base_url(); ?>Bendahara/tambah_tarif"> + Tambah Tarif </a>
  <br>
  </div>
  <div class="card-body">

    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <!-- <th>NO Pengeluaran</th> -->
            <!-- <th>Diberikan Kepada</th> -->
            <th>Jenis Iuran</th>
            <th>Nominal</th>
            <!-- <th>Status</th> -->
            <th>Terakhir Diperbarui</th>
            <!-- <th>Aksi</th> -->
          </tr>
        </thead>

        <tbody>
        <?php
         $no = 1;
         $sum=0;
          foreach($datatarif as $b){
        ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $b['jenis_iuran']; ?></td>
            <td>Rp. <?php echo number_format ($b['nominal'],2); ?></td>
            <!-- <td><?= $b['status']?></td> -->
            <td><?= date('d-m-Y', strtotime($b['tanggal']));?></td>
            <td>
              <!-- <?php
              if($b['status']=='Aktif'){?>
                  <a class="btn btn-danger"  href="<?= base_url(); ?>Bendahara/edit_tarif?id_tarif=<?= $b['id_tarif']?>&status=Tidak Aktif"> Tidak Aktif </a>
              <?php
              }else{?>
                  <a class="btn btn-success"  href="<?= base_url(); ?>Bendahara/edit_tarif?id_tarif=<?= $b['id_tarif']?>&status=Aktif"> Aktif </a>
            <?php
              }?> -->

            </td>
          </tr>
            </center>
        <?php } ?>

        </tbody>
      </table>
</div>
  </div>
</div>
</div>
