<div class="container-fluid">

<!-- Page Heading -->
<!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
-->
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Rekap Bulan</h6>
  </div>

  <div class="row px-3 my-3">
               <div class="col">
               <div class="form-group form-input">
                        <label for="diberikan_kepada">Pilih Bulan</label>
                        <select name="diberikan_kepada" id="Pendidikan" class="form-control">
                            <option selected disabled>-- Pilih Bulan --</option>
                            <option value="Fotocopy">Januari</option>
                            <option value="Gaji Pegawai">Februari</option>
                            <option value="Kesehatan">Maret</option>
                            <option value="Duka Cita">April</option>
                            <option value="Kebersihan">Mei</option>
                            <option value="Kebersihan">Juni</option>
                            <option value="Kebersihan">Juli</option>
                            <option value="Kebersihan">Agustus</option>
                            <option value="Kebersihan">September</option>
                            <option value="Kebersihan">Oktober</option>
                            <option value="Kebersihan">November</option>
                            <option value="Kebersihan">Desember</option>
                            <!-- <option value="DIPLOMA II">DIPLOMA II</option>
                            <option value="AKADEMI/DIPLOMA III/S. MUDA">AKADEMI/DIPLOMA III/S. MUDA</option>
                            <option value="DIPLOMA IV/STRATA I">DIPLOMA IV/STRATA I</option>
                            <option value="STRATA II">STRATA II</option>
                            <option value="STRATA III">STRATA III</option> -->
                        </select>
                    </div>
                   <?php echo form_error('diberikan_kepada'); ?>



  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>NO</th>
            <!-- <th>NO Pengeluaran</th> -->
            <!-- <th>Diberikan Kepada</th> -->
            <th>Nominal</th>
            <!-- <th>Tanggal</th> -->
            <th>Keterangan</th>
            <th>Gambar</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
        <!-- <?php 
          $no = 1;
          $sum=0;
          foreach($dataiurank as $b){ 
        ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <!-- <td><?php echo $b['no_pengeluaran']; ?></td>    -->
            <!-- <td><?php echo $b['diberikan_kepada']; ?></td> -->
            <td>Rp. <?php echo number_format ($b['nominal'],2); ?></td>
            <!-- <td><?php echo $b['tanggal']; ?></td> -->
            <td><?php echo $b['digunakan_untuk'] ?></td>
            <!-- <td><?php echo $b['gambar'] ?></td> -->
            <td><img src="<?php echo base_url('/uploads/gambar/'.$b['gambar']);?>" height="50px" width="50px"></td>
            <td>
            <?php $sum=$sum+$b['nominal']?>
              <?php echo anchor('admin/edit_iuran_keluar/'.$b['no_pengeluaran'],'Edit'); ?> | |  
                 <?php echo anchor('admin/detail_iuran_keluar/'.$b['no_pengeluaran'],'Detail'); ?>  
            </td>
          </tr>
        <?php } ?>
        <tr>
      <td>Total</td>
      <td><?php echo $sum;?> </td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr> -->
        </tbody>
      </table>
</div>
  </div>
</div>
</div>
