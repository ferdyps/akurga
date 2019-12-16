<div class="container-fluid">

<!-- Page Heading -->
<!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
-->
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tabel Detail Pemasukan</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <!-- <tr>
            <th>NO</th> -->
            <th>No Pembayaran</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Pembayaran Bulan</th>
            <!-- <th>Nominal</th> -->
            <th>Tanggal Bulan januari</th>
            <th>Tanggal Bulan Februari</th>
            <th>Tanggal Bulan Maret</th>
            <th>Tanggal Bulan April</th>
            <th>Tanggal Bulan Mei</th>
            <th>Tanggal Bulan juni</th>
            <th>Tanggal Bulan juli</th>
            <th>Tanggal Bulan Agustus</th>
            <th>Tanggal Bulan September</th>
            <th>Tanggal Bulan Oktober</th>
            <th>Tanggal Bulan November</th>
            <th>Tanggal Bulan Desember</th>
            <!-- <th>Aksi</th> -->
          </tr>
        </thead>

        <tbody>
        <?php 
          $no = 1;
          $sum=0;
          foreach($detailpembayaran as $b){ 
        ?>
          <tr>
            <!-- <td><?php echo $no++; ?></td> -->
            <td><?php echo $b->no_pembayaran; ?></td>   
            <td><?php echo $b->nik; ?></td>
            <td><?php echo $b->nama_warga; ?></td>
            <!-- <td><?php echo $b->tanggal; ?></td> -->
            <td><?php echo $b->jenis_warga; ?></td>
            <td><?= $b->bulan_januari ?>(<?= $b->tanggal_bulan_januari ?>)</td>
            <td><?= $b->bulan_februari ?>(<?= $b->tanggal_bulan_februari ?>)</td>
            <td><?= $b->bulan_maret ?>(<?= $b->tanggal_bulan_maret ?>)</td>
            <td><?= $b->bulan_april ?>(<?= $b->tanggal_bulan_april ?>)</td>
            <td><?= $b->bulan_mei ?>(<?= $b->tanggal_bulan_mei ?>)</td>
            <td><?= $b->bulan_juni ?>(<?= $b->tanggal_bulan_juni ?>)</td>
            <td><?= $b->bulan_juli ?>(<?= $b->tanggal_bulan_juli ?>)</td>
            <td><?= $b->bulan_agustus ?>(<?= $b->tanggal_bulan_agustus ?>)</td>
            <td><?= $b->bulan_september ?>(<?= $b->tanggal_bulan_september ?>)</td>
            <td><?= $b->bulan_oktober ?>(<?= $b->tanggal_bulan_oktober ?>)</td>
            <td><?= $b->bulan_november ?>(<?= $b->tanggal_bulan_november ?>)</td>
            <td><?= $b->bulan_desember ?>(<?= $b->tanggal_bulan_desember ?>)</td>
            <!-- <td><?php echo $b['gambar'] ?></td> -->
            <!-- <td><img src="<?php echo base_url('/uploads/gambar/'.$b['gambar']);?>" height="50px" width="50px"></td> -->
            <td>
            <?php $sum=$sum+$b['nominal']?>
              <!-- <?php echo anchor('admin/edit_iuran_keluar/'.$b['no_pengeluaran'],'Edit'); ?> | |  
                 <?php echo anchor('admin/hapus_iuran_keluar/'.$b['no_pengeluaran'],'Hapus'); ?>    -->
            </td>
          </tr>
        <?php } ?>
        <tr>
      <td colspan="2" rospan="4">Total</td>
      <!-- <td><?php echo $sum;?> </td> -->
      <td></td>
      <td></td>
      <td><?php echo $sum;?> </td>
      <td></td>
      <td></td>
    </tr>
        </tbody>
      </table>
</div>
  </div>
</div>
</div>
