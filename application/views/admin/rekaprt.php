<div class="container-fluid">

<!-- Page Heading -->
<!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
-->
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tabel Data RT</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <!-- <th>NO</th> -->
            <!-- <th>NO Pengeluaran</th> -->
            <!-- <th>Diberikan Kepada</th> -->
            <th>No</th>
            <th>RT</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
        <?php
          $no = 1;
          foreach($datart as $value){
        ?>
          <tr>
            <td><?= $no++; ?></td>
            <td>RT - <?= $value->rt ?></td>
            <td>
              <?php
              if($value->rt<10){
                  $rt = "0".$value->rt;
              }?>
            <a href="<?= base_url(); ?>Bendahara/rekapbulanrt?rt=<?= $rt;?>" class="btn btn-primary" style="color:white;"> Lihat Data</a>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
</div>
  </div>
</div>
</div>
