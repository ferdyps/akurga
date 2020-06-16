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
                      <th>Penulis</th>
                      <th>Tanggal Input Notulen</th>
                      <th>Tembusan</th>
                      <th width="10%">Dokumentasi Rapat</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php
                    foreach ($list_notulen as $row) {
                      ?>
                      <tr>
                        <td><?= str_replace('-','/',$row['no_notulen']); ?></td>
                        <td><?= $row['penulis'] ?></td>
                        <td><?= strftime("%d %B %Y",strtotime($row['tgl_buat'])); ?></td>
                        <td><?= $row['tembusan'] ?></td>
                        <td>
                          <a href="<?= base_url("sekretaris/dokumentasi_rapat").'/'.$row['no_notulen'];?>" target="_blank" class="d-none d-sm-inline-block btn btn-primary shadow-sm" title="Detail Dokumentasi Rapat">Detail <br> Gambar</i></a>
                        </td>
                        <td>


                          <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm" id="editUraianNotulensi" title="Edit Uraian Notulensi"
                          data-url="<?= base_url('sekretaris/detailNotulen/'); ?>" data-notulensi="<?= $row['no_notulen']; ?>"
                          data-toggle="modal" data-target="#editUraianNotulensiModal">Edit<br>Data</i></a>
                          <b>||</b>
                          <a href="<?= base_url("sekretaris/notulensi_rapat").'/'.$row['no_notulen'];?>" target="_blank" class="d-none d-sm-inline-block btn btn-primary shadow-sm" title="Lihat Isi Uraian Notulensi">Preview<br>Surat</a>
                          <b>||</b>
                          <a href="<?= base_url("sekretaris/editdokumen_Notulensi").'/'.$row['no_notulen'];?>" class="d-none d-sm-inline-block btn btn-primary shadow-sm" title="Edit Dokumentasi Rapat Notulensi">Edit<br>Gambar </i></a>
                          <b>||</b>
                          <a href="<?= base_url("sekretaris/cetak_notulensi").'/'.$row['no_notulen'];?>" target="_blank" class="d-none d-sm-inline-block btn btn-primary shadow-sm" title="Cetak Notulensi Rapat">Cetak/Simpan<br>Surat </a>
                        </td>
                      </tr>

                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <?php $this->load->view('admin/_partials/edituraian_notulensi')?>

        <script>
            $(document).on('click','#editUraianNotulensi',function(){
              var id_notulen = $(this).attr('data-notulensi');
              var url = $(this).attr('data-url');
              $.ajax({
                url: url + id_notulen,
                method: 'POST',
                data: {id_notulen:id_notulen},
                dataType: 'json',
                  success:function(data) {
                    console.log(data);
                    $('#editUraianNotulensiModal #edit-no_notulen').val(data.no_notulen);
                    $('#editUraianNotulensiModal #edit-tembusan').val(data.tembusan);
                    $('#editUraianNotulensiModal #edit-uraian_notulen_cetak').val(data.	uraian_notulen_cetak);
                  },
                  error:function() {
                    alert('Error di System..!');
                  }
              });
            });

        </script>
