<div class="container-fluid">

<!-- Page Heading -->
<!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
-->
<!-- DataTales Example -->
<div class="card shadow mb-4"> 
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Detail Pembayaran</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table border = "0" id="dataTable" cellspacing="0">
     <form>
        <?php 
          $no = 1;
          $sum=0;
          foreach($detailpembayaran as $b){ 
        ?>
         
            <!-- <td><?php echo $no++; ?></td> -->
            <tr>
              <td> Nomor Pembayaran </td>
              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
              <td><?php echo $b->no_pembayaran; ?></td>
            </tr>
            <tr>
              <td> NIK </td>
              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
              <td><?php echo $b->nik ?></td>
            </tr>
            <tr>
              <td> Nama Warga </td>
              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
              <td><?php echo $b->nama_warga; ?></td>
            </tr>
            <tr>
              <td> Jenis Warga </td>
              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
              <td><?php echo $b->jenis_warga; ?></td>
            </tr>
            <tr>
              <td> Tanggal Pembayaran Bulan Januari </td>
              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
              <td><?php echo  $b->tanggal_bulan_januari; ?></td>
            </tr>
            <tr>
              <td> Tanggal Pembayaran Bulan Februari </td>
              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
              <td><?php echo  $b->tanggal_bulan_februari; ?></td>
            </tr>
            <tr>
              <td> Tanggal Pembayaran Bulan Maret </td>
              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
              <td><?php echo  $b->tanggal_bulan_maret; ?></td>
            </tr>
            <tr>
              <td> Tanggal Pembayaran Bulan April </td>
              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
              <td><?php echo  $b->tanggal_bulan_april; ?></td>
            </tr>
            <tr>
              <td> Tanggal Pembayaran Bulan Mei </td>
              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
              <td><?php echo  $b->tanggal_bulan_mei; ?></td>
            </tr>
            <tr>
              <td> Tanggal Pembayaran Bulan Juni </td>
              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
              <td><?php echo  $b->tanggal_bulan_juni; ?></td>
            </tr>
            <tr>
              <td> Tanggal Pembayaran Bulan Juli </td>
              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
              <td><?php echo  $b->tanggal_bulan_juli; ?></td>
            </tr>
            <tr>
              <td> Tanggal Pembayaran Bulan Agustus </td>
              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
              <td><?php echo  $b->tanggal_bulan_agustus; ?></td>
            </tr>
            <tr>
              <td> Tanggal Pembayaran Bulan September </td>
              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
              <td><?php echo  $b->tanggal_bulan_september; ?></td>
            </tr>
            <tr>
              <td> Tanggal Pembayaran Bulan Oktober </td>
              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
              <td><?php echo  $b->tanggal_bulan_oktober; ?></td>
            </tr>
            <tr>
              <td> Tanggal Pembayaran Bulan November </td>
              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
              <td><?php echo  $b->tanggal_bulan_november; ?></td>
            </tr>
            <tr>
              <td> Tanggal Pembayaran Bulan Desember </td>
              <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
              <td><?php echo  $b->tanggal_bulan_desember; ?></td>
          </tr>
        <?php } ?>
          </form>
      </table>
</div>
  </div>
</div>
</div>
