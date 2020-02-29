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
                      <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm" id="editNotulensi" title="Edit Data"
                      data-url="<?= base_url('admin/detailNotulen/'); ?>" data-notulen="<?= $row['no_notulen']; ?>"
                      data-toggle="modal" data-target="#editDataNotulensiModal"><i class="fas fa-edit"></i></a>
                    </td>
                  </tbody>
                <?php } ?>
                </table>
              </div>
            </div>
          </div>
        </div>

        <?php $this->load->view('admin/_partials/editnotulensi_modal')?>

        <script>
            $(document).on('click','#editNotulensi',function(){
              var id_notulen = $(this).attr('data-notulen');
              var url = $(this).attr('data-url');
              $.ajax({
                url: url + id_notulen,
                method: 'POST',
                data: {id_notulen:id_notulen},
                dataType: 'json',
                  success:function(data) {
                    console.log(data);
                    $('#editDataNotulensiModal #edit-no_notulen').val(data.no_notulen);
                    $('#editDataNotulensiModal #edit-lampiran').val(data.lampiran);
                    $('#editDataNotulensiModal #edit-tembusan').val(data.tembusan);
                    $('#editDataNotulensiModal #edit-uraian_notulen').val(data.uraian_notulen);
                  },
                  error:function() {
                    alert('Error di System..!');
                  }
              });
            });
        </script>
