<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Warga</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Konfirmasi Data Warga</h6>
  </div>

  <div class="card-body">
    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-sementara-tab" data-toggle="tab" href="#nav-sementara" role="tab" aria-controls="nav-sementara" aria-selected="true">Sementara</a>
        <a class="nav-item nav-link" id="nav-tetap-tab" data-toggle="tab" href="#nav-tetap" role="tab" aria-controls="nav-tetap" aria-selected="false">Tetap</a>
      </div>
    </nav>
    <div class="tab-content pt-3" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-sementara" role="tabpanel" aria-labelledby="nav-sementara-tab">
        <div class="table-responsive">
          <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr class="bg-primary text-white text-center">
                <th width="5%">No</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Pendidikan</th>
                <th>Pekerjaan</th>
                <th>Agama</th>
                <th>Jenis Kelamin</th>
                <th>Status</th>
                <th>Jenis Warga</th>
                <th>Nomor HP</th>
                <th>Nama Jalan</th>
                <th>Nomor Rumah</th>
                <th>Gang</th>
                <th>Gambar</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $i=1; 
              foreach($list_warga_belum_valid_sementara as $row)
            {?>
                <tr>
                  <td><?= $i++?></td>
                  <td><?= $row['nik']?></td>
                  <td><?= $row['nama']?></td>
                  <td><?= $row['tempat_lahir']?></td>
                  <td><?= $row['tanggal_lahir']?></td>
                  <td><?= $row['pendidikan']?></td>
                  <td><?= $row['pekerjaan']?></td>
                  <td><?= $row['agama']?></td>
                  <td><?= $row['jk']?></td>
                  <td><?= $row['status']?></td>
                  <td><?= $row['jenis_warga']?></td>
                  <td><?= $row['nohp']?></td>
                  <td><?= $row['nama_jalan']?></td>
                  <td><?= $row['no_rumah']?></td>
                  <td><?= $row['gang']?></td>
                  <td><img width="100%" src="<?= base_url('./assets/foto/warga/'.$row['gambar']) ?>"></td>
                  <td><button class="btn btn-primary" onclick="konfirmasi_data('<?= base_url('ketuaRW/klik_konfirmasi_data_warga/')?>', <?= $row['nik']; ?>)"><i class="fas fa-check"></i></button>
                  <button class="btn btn-danger" data-target="#input-message-warga" data-toggle="modal" onclick="approve_warga('<?= $row['nik']; ?>')"><i class="fas fa-times"></i></button></td>
                </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    
      <div class="tab-pane fade show" id="nav-tetap" role="tabpanel" aria-labelledby="nav-tetap-tab">
        <div class="table-responsive">
          <table class="table table-striped table-hover" id="dataTable2" width="100%" cellspacing="0">
            <thead>
              <tr class="bg-primary text-white text-center">
                <th width="5%">No</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Pendidikan</th>
                <th>Pekerjaan</th>
                <th>Agama</th>
                <th>Jenis Kelamin</th>
                <th>Status</th>
                <th>Jenis Warga</th>
                <th>Nomor HP</th>
                <th>Nomor KK</th>
                <th>Hubungan Dalam Keluarga</th>
                <th>Nama Jalan</th>
                <th>Nomor Rumah</th>
                <th>Gang</th>
                <th>Gambar</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $i=1; 
              foreach($list_warga_belum_valid_tetap as $row)
            {?>
                <tr>
                  <td><?= $i++?></td>
                  <td><?= $row['nik']?></td>
                  <td><?= $row['nama']?></td>
                  <td><?= $row['tempat_lahir']?></td>
                  <td><?= $row['tanggal_lahir']?></td>
                  <td><?= $row['pendidikan']?></td>
                  <td><?= $row['pekerjaan']?></td>
                  <td><?= $row['agama']?></td>
                  <td><?= $row['jk']?></td>
                  <td><?= $row['status']?></td>
                  <td><?= $row['jenis_warga']?></td>
                  <td><?= $row['nohp']?></td>
                  <td><?= $row['nokk']?></td>
                  <td><?= $row['hub_dlm_kel']?></td>
                  <td><?= $row['nama_jalan']?></td>
                  <td><?= $row['no_rumah']?></td>
                  <td><?= $row['gang']?></td>
                  <td><img width="100%" src="<?= base_url('./assets/foto/warga/'.$row['gambar']) ?>"></td>
                  <td><button class="btn btn-primary" onclick="konfirmasi_data('<?= base_url('ketuaRW/klik_konfirmasi_data_warga/')?>', <?= $row['nik']; ?>)"><i class="fas fa-check"></i></button>
                  <button class="btn btn-danger" id="buttonTolakWargaTetap" data-target="#input-message-warga" data-toggle="modal" onclick="approve_warga('<?= $row['nik']; ?>')"><i class="fas fa-times"></i></button>
                  </td>
                </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="input-message-warga" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editDataWargaModalLabel">Keterangan Penolakan Warga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('ketuaRW/declineWarga',['id' => 'default-form', 'log' => 'Input Pesan Warga']);?>
            <input type="hidden" name="nik" id="nikHiddenForm" value="">
            <div class="row px-3 my-3">
                <div class="col">
                    <div class="form-group form-input">
                        <label for="input-pesan">Keterangan</label>
                        <textarea id="input-pesan"  class="form-control" name="pesan" placeholder="Keterangan"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group text-center">
                    <input type="submit" value="Submit" class="btn btn-primary" >
                    <input type="reset" value="Reset" class="btn btn-danger">
                </div>
            </div>
        <?= form_close();?>
    </div>
  </div>
</div>

<script>
function approve_warga(nik) {
  console.log(nik);
  console.log($('#nikHiddenForm'));
  
  $('#nikHiddenForm').val(nik);
}
</script>
