<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Warga</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Warga</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="bg-primary text-white text-center">
                      <th width="5%">No</th>
                      <th>NIK</th>
                      <th>Nama Lengkap</th>
                      <th>Tempat Lahir</th>
                      <th>Tanggal Lahir</th>
                      <!-- <th>Pendidikan</th> -->
                      <!-- <th>Pekerjaan</th> -->
                      <th>Agama</th>
                      <th>Jenis Kelamin</th>
                      <th>Status</th>
                      <th>Jenis Warga</th>
                      <!-- <th>Nomor HP</th> -->
                      <!-- <th>Nomor KK</th> -->
                      <!-- <th>Hubungan Dalam Keluarga</th> -->
                      <!-- <th>Nomor Rumah</th> -->
                      <!-- <th>Gang</th> -->
                      <th>Validasi</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <?php
                    $i=1; 
                    foreach($list_warga_semua as $row)
                  {?>
                  <tbody>
                      <tr>
                        <td><?= $i++?></td>
                        <td><?= $row['nik']?></td>
                        <td><?= $row['nama']?></td>
                        <td><?= $row['tempat_lahir']?></td>
                        <td><?= $row['tanggal_lahir']?></td>
                        <!-- <td><?= $row['pendidikan']?></td> -->
                        <!-- <td><?= $row['pekerjaan']?></td> -->
                        <td><?= $row['agama']?></td>
                        <td><?= $row['jk']?></td>
                        <td><?= $row['status']?></td>
                        <td><?= $row['jenis_warga']?></td>
                        <!-- <td><?= $row['nohp']?></td> -->
                        <!-- <td><?= $row['nokk']?></td> -->
                        <!-- <td><?= $row['hub_dlm_kel']?></td> -->
                        <!-- <td><?= $row['no_rumah']?></td> -->
                        <!-- <td><?= $row['gang']?></td> -->
                        <td>
                          <?php if ($row['valid'] == 1) {
                            echo "Sudah Valid";
                          }else {
                            echo "Belum Valid";
                          }?>
                        </td>
                        <td>
                          <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm" id="detailWarga" data-url="<?= base_url('admin/detailWarga/'); ?>" data-nik="<?= $row['nik']; ?>" data-toggle="modal" data-target="#editDataWargaModal">Detail</a>
                        </td>
                      </tr>
                  </tbody>
                  <?php } ?>
                </table>
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
            $('#editDataWargaModal #edit-jenisWarga').val(data.jenis_warga);
            $('#editDataWargaModal #edit-nik').val(data.nik);
            $('#editDataWargaModal #edit-nama').val(data.nama);
            $('#editDataWargaModal #edit-nohp').val(data.nohp);
            $('#editDataWargaModal #edit-tempat_lahir').val(data.tempat_lahir);
            $('#editDataWargaModal #edit-tanggal_lahir').val(data.tanggal_lahir);
            $('#editDataWargaModal #edit-Pendidikan').val(data.pendidikan);
            $('#editDataWargaModal #edit-Pekerjaan').val(data.pekerjaan);
            $('#editDataWargaModal #edit-nokk').val(data.nokk);
            $('#editDataWargaModal #edit-Agama').val(data.agama);
            $('#editDataWargaModal #edit-JK').val(data.jk);
            $('#editDataWargaModal #edit-Hub_Dlm_Kel').val(data.hub_dlm_kel);
            $('#editDataWargaModal #edit-Status').val(data.status);
            $('#editDataWargaModal #edit-no_rumah').val(data.no_rumah);
            $('#editDataWargaModal #edit-Gang').val(data.gang);
          },
          error:function() {
            alert('Error di System..!');
          }
      });
    });
</script>