<div class="container-fluid">
      <div id="flash-data" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Riwayat Surat Undangan</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Riwayat Surat Undangan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="bg-primary text-white text-center">
                      <th>No Surat Undangan</th>
                      <th>Pihak Yang Diundang</th>
                      <th>Tempat Rapat</th>
                      <th>Tanggal Surat</th>
                      <th>Jam Rapat</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <?php
                    foreach ($list_surat_udg as $row) {
                  ?>
                  <tbody class="text-center">
                    <tr>
                    <td><?= $row['no_udg'] ?></td>
                    <td><?= $row['tujuan_surat'] ?></td>
                    <td><?= $row['tempat_udg'] ?></td>
                    <td><?= $row['tgl_udg'] ?></td>
                    <td><?= $row['jam_udg'] ?></td>
                    <td>
                      <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm" title="Detail Data"
                        id="detailData" data-url="<?= base_url('sekretaris/detailRapat/'); ?>" data-noudg="<?= $row['no_udg']; ?>"
                        data-toggle="modal" data-target="#detailDataModal"><i class="fas fa-folder-open"></i></a>
                      <b>||</b>
                      <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm" title="Edit Data" id="detailRapat" data-url="<?= base_url('sekretaris/detailRapat/'); ?>" data-noudg="<?= $row['no_udg']; ?>"
                         data-toggle="modal" data-target="#editDataRapatModal"><i class="fas fa-edit"></i></a>
                      <b>||</b>
                      <a href="<?= base_url("sekretaris/inputnotulensi").'/'.$row['no_udg'];?>" class="d-none d-sm-inline-block btn btn-primary shadow-sm" title="Input Notulensi"><i class="fas fa-clipboard"></i></a>
                      <b>||</b>
                      <a href="<?= base_url("sekretaris/cetak_undangan").'/'.$row['no_udg'];?>" target="_blank" class="d-none d-sm-inline-block btn btn-primary shadow-sm" title="Cetak Surat Undangan"><i class="fas fa-print"></i></a>
                    </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <?php $this->load->view('admin/_partials/editrapat_modal')?>
        <?php $this->load->view('admin/_partials/detailrapat_modal')?>
        <script>
            // Jquery Edit data rapat
            $(document).on('click','#detailRapat',function(){
              var id_rapat = $(this).attr('data-noudg');
              var url = $(this).attr('data-url');
              $.ajax({
                url: url + id_rapat,
                method: 'POST',
                data: {id_rapat:id_rapat},
                dataType: 'json',
                  success:function(data) {
                    console.log(data);
                    $('#editDataRapatModal #edit-no_udg').val(data.no_udg);
                    $('#editDataRapatModal #edit-lampiran').val(data.lampiran_udg);
                    $('#editDataRapatModal #edit-sifat').val(data.sifat_udg);
                    $('#editDataRapatModal #edit-hal').val(data.perihal_udg);
                    $('#editDataRapatModal #edit-tujuan_surat').val(data.tujuan_surat);
                    $('#editDataRapatModal #edit-tempat_udg').val(data.tempat_udg);
                    $('#editDataRapatModal #edit-tembusan').val(data.tembusan);
                    $('#editDataRapatModal #edit-isi_surat').val(data.isi_surat);
                    $('#editDataRapatModal #edit-tgl_surat').val(data.tgl_udg);
                    $('#editDataRapatModal #edit-jam_udg').val(data.jam_udg);
                    $('#editDataRapatModal #edit-acara_udg').val(data.acara_udg);
                  },
                  error:function() {
                    alert('Error di System..!');
                  }
              });
            });
            // Jquery detail data rapat
            $(document).on('click','#detailData',function(){
              var id_rapat = $(this).attr('data-noudg');
              var url = $(this).attr('data-url');
              $.ajax({
                url: url + id_rapat,
                method: 'POST',
                data: {id_rapat:id_rapat},
                dataType: 'json',
                  success:function(data) {
                    console.log(data);
                    $('#detailDataModal #edit-no_udg').val(data.no_udg);
                    $('#detailDataModal #edit-lampiran').val(data.lampiran_udg);
                    $('#detailDataModal #edit-sifat').val(data.sifat_udg);
                    $('#detailDataModal #edit-hal').val(data.perihal_udg);
                    $('#detailDataModal #edit-tujuan_surat').val(data.tujuan_surat);
                    $('#detailDataModal #edit-tempat_udg').val(data.tempat_udg);
                    $('#detailDataModal #edit-tembusan').val(data.tembusan);
                    $('#detailDataModal #edit-isi_surat').val(data.isi_surat);
                    $('#detailDataModal #edit-tgl_surat').val(data.tgl_udg);
                    $('#detailDataModal #edit-jam_udg').val(data.jam_udg);
                    $('#detailDataModal #edit-acara_udg').val(data.acara_udg);
                  },
                  error:function() {
                    alert('Error di System..!');
                  }
              });
            });

        </script>
