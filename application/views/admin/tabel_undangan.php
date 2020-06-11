<div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Riwayat Surat Undangan</h1>
          <div class="flash-data" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Riwayat Surat Undangan</h6>
            </div>
            <?php config_item('setlocal'); ?>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="bg-primary text-white text-center">
                      <th>No Surat Undangan</th>
                      <th>Pihak Yang Diundang</th>
                      <th>Tempat Rapat</th>
                      <th>Tanggal Surat</th>
                      <th width="5%">Jam Rapat</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <?php
                    foreach ($list_surat_udg as $row) {
                  ?>
                  <tbody class="text-center">
                    <tr>
                    <td><?= str_replace('-','/',$row['no_udg']); ?></td>
                    <td><?= $row['tujuan_surat'] ?></td>
                    <td><?= $row['tempat_udg'] ?></td>
                    <td><?= strftime("%d %B %Y",strtotime($row['tgl_udg'])) ?></td>
                    <td><?= strftime("%R",strtotime($row['jam_udg'])) ?></td>
                    <td>

                      <?php $set = substr($row['no_udg'],4,3); ?>
                      <?php if ($set == 'RPT') { ?>
                        <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm" title="Detail Data Rapat"
                          id="detailData" data-url="<?= base_url('sekretaris/detailRapat/'); ?>" data-noudg="<?= $row['no_udg']; ?>"
                          data-toggle="modal" data-target="#detailDataModal"><i class="fas fa-folder-open"></i></a>
                        <b>||</b>
                        <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm" title="Edit Data Rapat" id="editRapat"
                           data-url="<?= base_url('sekretaris/detailRapat/'); ?>" data-noudg="<?= $row['no_udg']; ?>"
                           data-toggle="modal" data-target="#editDataRapatModal"><i class="fas fa-edit"></i></a>
                        <b>||</b>
                        <a href="<?= base_url("sekretaris/previewRapat").'/'.$row['no_udg'];?>" target="_blank" class="d-none d-sm-inline-block btn btn-primary shadow-sm" title="Preview Surat Undangan">Preview<br>Surat</a>
                        <b>||</b>
                        <a href="<?= base_url("sekretaris/inputnotulensi").'/'.$row['no_udg'];?>" class="d-none d-sm-inline-block btn btn-primary shadow-sm" title="Input Notulensi">Input<br>Notulensi</a>
                        <b>||</b>
                      <?php }elseif ($set == 'KGT') { ?>
                        <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm" title="Detail Data Kegiatan"
                          id="detailDataKgt" data-url="<?= base_url('sekretaris/detailRapat/'); ?>" data-noudg="<?= $row['no_udg']; ?>"
                          data-toggle="modal" data-target="#detailDataKgtModal"><i class="fas fa-folder-open"></i></a>
                          <b>||</b>
                          <a href="<?= base_url("sekretaris/previewRapat").'/'.$row['no_udg'];?>" target="_blank" class="d-none d-sm-inline-block btn btn-primary shadow-sm" title="Preview Surat Undangan">Preview<br>Surat</a>
                          <b>||</b>
                          <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm" title="Edit Data Kegiatan" id="editKegiatan"
                          data-url="<?= base_url('sekretaris/detailRapat/'); ?>" data-noudg="<?= $row['no_udg']; ?>"
                          data-toggle="modal" data-target="#editDataKgtModal"><i class="fas fa-edit"></i></a>
                          <b>||</b>

                      <?php } ?>

                      <a href="<?= base_url("sekretaris/cetak_undangan").'/'.$row['no_udg'];?>" target="_blank" class="d-none d-sm-inline-block btn btn-primary shadow-sm" title="Cetak Surat Undangan">Cetak/Simpan<br>Surat</a>
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
        <?php $this->load->view('admin/_partials/editkgt_modal')?>
        <?php $this->load->view('admin/_partials/detailrapat_modal')?>
        <?php $this->load->view('admin/_partials/detailkgt_modal')?>
        <script>
            // Jquery Edit data rapat
            $(document).on('click','#editRapat',function(){
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

            // Jquery Edit data Kegiatan
            $(document).on('click','#editKegiatan',function(){
              var id_rapat = $(this).attr('data-noudg');
              var url = $(this).attr('data-url');
              $.ajax({
                url: url + id_rapat,
                method: 'POST',
                data: {id_rapat:id_rapat},
                dataType: 'json',
                  success:function(data) {
                    console.log(data);
                    $('#editDataKgtModal #edit-no_udg_kgtedit').val(data.no_udg);
                    $('#editDataKgtModal #edit-lampiran_kgtedit').val(data.lampiran_udg);
                    $('#editDataKgtModal #edit-sifat_kgtedit').val(data.sifat_udg);
                    $('#editDataKgtModal #edit-hal_kgtedit').val(data.perihal_udg);
                    $('#editDataKgtModal #edit-tujuan_surat_kgtedit').val(data.tujuan_surat);
                    $('#editDataKgtModal #edit-tempat_udg_kgtedit').val(data.tempat_udg);
                    $('#editDataKgtModal #edit-tembusan_kgtedit').val(data.tembusan);
                    $('#editDataKgtModal #edit-isi_surat_kgtedit').val(data.isi_surat);
                    $('#editDataKgtModal #edit-tgl_surat_kgtedit').val(data.tgl_udg);
                    $('#editDataKgtModal #edit-jam_udg_kgtedit').val(data.jam_udg);
                    $('#editDataKgtModal #edit-acara_udg_kgtedit').val(data.acara_udg);
                    $('#editDataKgtModal #edit-catatan_kgtedit').val(data.catatan);
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

            // INI YANG DETAIL KEGIATAN

            $(document).on('click','#detailDataKgt',function(){
              var id_rapat = $(this).attr('data-noudg');
              var url = $(this).attr('data-url');
              $.ajax({
                url: url + id_rapat,
                method: 'POST',
                data: {id_rapat:id_rapat},
                dataType: 'json',
                  success:function(data) {
                    console.log(data);
                    $('#detailDataKgtModal #edit-no_udg_kgt').val(data.no_udg);
                    $('#detailDataKgtModal #edit-lampiran_kgt').val(data.lampiran_udg);
                    $('#detailDataKgtModal #edit-sifat_kgt').val(data.sifat_udg);
                    $('#detailDataKgtModal #edit-hal_kgt').val(data.perihal_udg);
                    $('#detailDataKgtModal #edit-tujuan_surat_kgt').val(data.tujuan_surat);
                    $('#detailDataKgtModal #edit-tempat_udg_kgt').val(data.tempat_udg);
                    $('#detailDataKgtModal #edit-tembusan_kgt').val(data.tembusan);
                    $('#detailDataKgtModal #edit-isi_surat_kgt').val(data.isi_surat);
                    $('#detailDataKgtModal #edit-tgl_surat_kgt').val(data.tgl_udg);
                    $('#detailDataKgtModal #edit-jam_udg_kgt').val(data.jam_udg);
                    $('#detailDataKgtModal #edit-acara_udg_kgt').val(data.acara_udg);
                    $('#detailDataKgtModal #edit-catatan_kgt').val(data.catatan);
                  },
                  error:function() {
                    alert('Error di System..!');
                  }
              });
            });

        </script>
