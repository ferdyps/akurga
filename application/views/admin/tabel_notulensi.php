<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Riwayat Notulensi Rapat</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Riwayat Riwayat Notulensi Rapat</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="bg-primary text-white text-center">
                      <th>No Notulensi</th>
                      <th>Lampiran</th>
                      <th>Tembusan</th>
                      <th>Uraian Notulensi</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <?php
                    foreach ($list_notulen as $row) {
                  ?>
                  <tbody class="text-center">
                    <td><?= $row['no_notulen'] ?></td>
                    <td><?= $row['lampiran'] ?></td>
                    <td><?= $row['tembusan'] ?></td>
                    <td><?= $row['uraian_notulen'] ?></td>
                    <td>
                      <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm" id="editNotulensi"
                      data-url="<?= base_url('admin/detailNotulensi/'); ?>" data-notulen="<?= $row['no_notulen']; ?>"
                      data-toggle="modal" data-target="#editDataNotulensiModal">Edit</a>
                    </td>
                  </tbody>
                <?php } ?>
                </table>
              </div>
            </div>
          </div>
        </div>
        <?php $this->load->view('admin/_partials/editrapat_modal')?>
        <script>
            $(document).on('click','#editNotulensi',function(){
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
        </script>
