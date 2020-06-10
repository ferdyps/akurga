<div class="container-fluid">

<!-- Page Heading -->
<!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
-->
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tabel Tarif</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <!-- <th>NO</th> -->
            <!-- <th>NO Pengeluaran</th> -->
            <!-- <th>Diberikan Kepada</th> -->
            <th>Jenis Iuran</th>
            <th>Nominal</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
        <?php 
         $no = 1;
         $sum=0;
          foreach($datatarif as $b){ 
        ?>
          <tr>
            <!-- <td><?php echo $no++; ?></td> -->
            <td><?php echo $b['jenis_iuran']; ?></td>
            <td>Rp. <?php echo number_format ($b['nominal'],2); ?></td>
            <!-- <td><?php echo $b['digunakan_untuk'] ?></td> -->
            <!-- <td><?php echo $b['gambar'] ?></td> -->
            <!-- <td><img src="<?php echo base_url('/uploads/gambar/'.$b['gambar']);?>" height="50px" width="50px"></td> -->
            <td><?php echo anchor('Bendahara/edit_tarif/'.$b['kodeiuran'],'Edit'); ?> </td>
          </tr>
        <?php } ?>
       
        </tbody>
      </table>
</div>
  </div>
</div>
</div>
