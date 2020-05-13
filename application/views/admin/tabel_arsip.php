<div class="container-fluid">
  <?php config_item('setlocal'); ?>

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Riwayat Arsip Surat</h1>
  <div id="flash-data2" data-flashdata2="<?= $this->session->flashdata('error'); ?>"></div>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Riwayat Riwayat Arsip Surat</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr class="bg-primary text-white text-center">
              <th>Kode Surat</th>
              <th>Nomor Surat</th>
              <th>Pengirim</th>
              <th>Tanggal Terima surat</th>
              <th>Tanggal Surat</th>
              <th>Tanggal Diarsipkan</th>
              <th>Keterangan</th>
              <th>action</th>
            </tr>
          </thead>
          <?php foreach ($list_arsip as $row){ ?>
            <tbody class="text-center">
              <td><?= $row['kd_surat'] ?></td>
              <td><?= $row['no_surat'] ?></td>
              <td><?= $row['pengirim'] ?></td>


              <td><?= strftime("%d %B %Y",strtotime($row['tgl_terima'])); ?></td>
              <td><?= strftime("%d %B %Y",strtotime($row['tgl_surat'])); ?></td>
              <td><?= strftime("%d %B %Y",strtotime($row['tgl_buat'])); ?></td>
              <td><?= $row['keterangan'] ?></td>
              <td>
                <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm" id="editArsip"
                data-url="<?= base_url('sekretaris/detailArsip/'); ?>" data-arsip="<?= $row['kd_surat']; ?>"
                data-toggle="modal" data-target="#editDataArsipModal" title="Edit Data"><i class="fas fa-edit"></i></a>
                <a href="<?= base_url("sekretaris/gambar_arsip").'/'.$row['kd_surat'];?>" target="_blank" class="d-none d-sm-inline-block btn btn-primary shadow-sm"
                  title="Detail Gambar Arsip"><i class="fas fa-image"></i></a>
                </td>
              </tbody>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php $this->load->view('admin/_partials/editarsip_modal')?>

  <script>
  $(document).on('click','#editArsip',function(){
    var id_arsip = $(this).attr('data-arsip');
    var url = $(this).attr('data-url');

    $.ajax({
      url: url + id_arsip,
      method: 'POST',
      data: {id_arsip:id_arsip},
      dataType: 'json',
      success:function(data) {
        console.log(data);
        $('#editDataArsipModal #edit-kd_surat').val(data.kd_surat);
        $('#editDataArsipModal #edit-no_surat').val(data.no_surat);
        $('#editDataArsipModal #edit-pengirim').val(data.pengirim);
        $('#editDataArsipModal #edit-keterangan').val(data.keterangan);
        $('#editDataArsipModal #edit-tgl_terima').val(data.tgl_terima);
        $('#editDataArsipModal #edit-tgl_surat').val(data.tgl_surat);
      },
      error:function() {
        alert('Error di System..!');
      }
    });
  });
  </script>
