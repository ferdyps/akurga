<div class="container-fluid">

<!-- Page Heading -->
<!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
-->
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tabel Pengeluaran</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>NO</th>
            <th>Diberikan Kepada</th>
            <th>Nominal</th>
            <th>Tanggal</th>
            <th>Digunakan Untuk</th>
            <th>Gambar</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
        <?php 
          $no = 1;
          $sum=0;
          foreach($dataiurank as $b){ 
        ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <!-- <?php echo $b['no_pengeluaran']; ?></td>   -->
            <td><?php echo $b['diberikan_kepada']; ?></td>
            <td><?php echo $b['nominal']; ?></td>
            <td><?php echo $b['tanggal']; ?></td>
            <td><?php echo $b['digunakan_untuk'] ?></td>
            <!-- <td><?php echo $b['gambar'] ?></td> -->
            <td><img src="<?php echo base_url('/uploads/gambar/'.$b['gambar']);?>" height="50px" width="50px"></td>
            <td>
            <?php $sum=$sum+$b['nominal']?>
              <?php echo anchor('admin/edit_iuran_keluar/'.$b['no_pengeluaran'],'Edit'); ?> | |  
                 <?php echo anchor('admin/hapus_iuran_keluar/'.$b['no_pengeluaran'],'Hapus'); ?>  
            </td>
          </tr>
        <?php } ?>
        <tr>
      <td colspan="2" rospan="4">Total</td>
      <td><?php echo $sum;?> </td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
        </tbody>
      </table>
</div>
  </div>
</div>
</div>
