<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Warga</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Warga RT <?= $this->rt;?></h6>
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
                          <th>Agama</th>
                          <th>Jenis Kelamin</th>
                          <th>Status</th>
                          <th>Jenis Warga</th>
                          <th>RT</th>
                          <th>Gambar</th>
                          <th>Validasi</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      <?php
                        $i=1; 
                        foreach($list_warga_sementara as $row)
                      {?>
                          <tr>
                            <td><?= $i++?></td>
                            <td><?= $row['nik']?></td>
                            <td><?= $row['nama']?></td>
                            <td><?= $row['tempat_lahir']?></td>
                            <td><?= strftime("%d %B %Y",strtotime($row['tanggal_lahir']))?></td>
                            <td><?= $row['agama']?></td>
                            <td><?= $row['jk']?></td>
                            <td><?= $row['status']?></td>
                            <td><?= $row['jenis_warga']?></td>
                            <td><?= $row['rt']?></td>
                            <td class="text-center"><img width="50%" class="rounded" src="<?= base_url('./assets/foto/warga/'.$row['gambar']) ?>"></td>
                            <td>
                              <?php if ($row['valid'] == 1) {
                                echo "Sudah Valid";
                              }else if ($row['valid'] == 2) {
                                echo "Validasi Ditolak";
                              }
                              else {
                                echo "Belum Valid";
                              }?>
                            </td>
                            <td>
                              <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm" id="detailWarga" data-url="<?= base_url('ketuaRT/detailWarga/'); ?>" data-nik="<?= $row['nik']; ?>" data-toggle="modal" data-target="#editDataWargaModal">Detail</a>
                            </td>
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
                          <th>Agama</th>
                          <th>Jenis Kelamin</th>
                          <th>Status</th>
                          <th>Jenis Warga</th>
                          <th>RT</th>
                          <th>Gambar</th>
                          <th>Validasi</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      <?php
                        $i=1; 
                        foreach($list_warga_tetap as $row)
                      {?>
                          <tr>
                            <td><?= $i++?></td>
                            <td><?= $row['nik']?></td>
                            <td><?= $row['nama']?></td>
                            <td><?= $row['tempat_lahir']?></td>
                            <td><?= strftime("%d %B %Y",strtotime($row['tanggal_lahir']))?></td>
                            <td><?= $row['agama']?></td>
                            <td><?= $row['jk']?></td>
                            <td><?= $row['status']?></td>
                            <td><?= $row['jenis_warga']?></td>
                            <td><?= $row['rt']?></td>
                            <td class="text-center"><img width="50%" class="rounded" src="<?= base_url('./assets/foto/warga/'.$row['gambar']) ?>"></td>
                            <td>
                              <?php if ($row['valid'] == 1) {
                                echo "Sudah Valid";
                              }else if ($row['valid'] == 2) {
                                echo "Validasi Ditolak";
                              }
                              else {
                                echo "Belum Valid";
                              }?>
                            </td>
                            <td>
                              <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm" id="detailWarga" data-url="<?= base_url('ketuaRT/detailWarga/'); ?>" data-nik="<?= $row['nik']; ?>" data-toggle="modal" data-target="#editDataWargaModal">Detail</a>
                            </td>
                          </tr>
                          
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php $this->load->view('admin/_partials/editDataWarga_modal')?>
<script>
    $(document).on('click','#detailWarga',function(){
      var id_warga = $(this).attr('data-nik');
      var url = $(this).attr('data-url');
      $.ajax({
        url: url + id_warga,
        method: 'POST',
        data: {id_warga:id_warga},
          dataType: 'json',
          success:function(data) {
            console.log(data);
            $('#editDataWargaModal #input-jenisWarga').val(data.jenis_warga);
            $('#editDataWargaModal #input-nik').val(data.nik);
            $('#editDataWargaModal #input-nama').val(data.nama);
            $('#editDataWargaModal #input-nohp').val(data.nohp);
            $('#editDataWargaModal #input-tempat_lahir').val(data.tempat_lahir);
            $('#editDataWargaModal #input-tanggal_lahir').val(data.tanggal_lahir);
            $('#editDataWargaModal #input-Pendidikan').val(data.pendidikan);
            $('#editDataWargaModal #input-Pekerjaan').val(data.pekerjaan);
            $('#editDataWargaModal #input-nokk').val(data.nokk);
            $('#editDataWargaModal #input-Agama').val(data.agama);
            $('#editDataWargaModal #input-JK').val(data.jk);
            $('#editDataWargaModal #input-Hub_Dlm_Kel').val(data.hub_dlm_kel);
            $('#editDataWargaModal #input-Status').val(data.status);
            $('#editDataWargaModal #input-nama_jalan').val(data.nama_jalan);
            $('#editDataWargaModal #input-no_rumah').val(data.no_rumah);
            $('#editDataWargaModal #input-Gang').val(data.gang);
            $('#editDataWargaModal #input-rt').val(data.rt);
            $('#editDataWargaModal #input-pesan').val(data.pesan);
          },
          error:function() {
            alert('Error di System..!');
          }
      });
    });
</script>