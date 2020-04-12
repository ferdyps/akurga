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
                      <th>Username</th>
                      <th>Email</th>
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Role</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                  <?php
                    $i=1; 
                    foreach($list_akun as $row)
                  {?>
                      <tr>
                        <td><?= $i++?></td>
                        <td><?= $row['username']?></td>
                        <td><?= $row['email']?></td>
                        <td><?= $row['nik']?></td>
                        <td><?= $row['nama']?></td>
                        <td><?= $row['role']?></td>
                        <td>
                          <button class="btn btn-primary" data-target="#edit-role" data-toggle="modal" <?= $row['id_user']?>>Edit Role</button>
                          <button class="btn btn-danger">Hapus</button>
                        </td>
                      </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

<div class="modal fade" id="edit-role" tabindex="-1" role="dialog" aria-labelledby="editDataWargaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editDataWargaModalLabel">Keterangan Penolakan Surat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('ketuaRW/edit_role/'.$row['id_user']);?>
            <div class="row px-3 my-3">
                <div class="col">
                    <div class="form-group">
                        <label for="pesan">Role</label>
                        <select name="role" id="" class="form-control">
                            <option value="Ketua RT">Ketua RT</option>
                            <option value="Bendahara">Bendahara</option>
                            <option value="Sekretaris">Sekretaris</option>
                            <option value="Warga">Warga</option>
                            <option value="Kolektor Iuran">Kolektor Iuran</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group text-center">
                    <input type="submit" value="Submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ingin mengubah..?');" >
                    <input type="reset" value="Reset" class="btn btn-danger">
                </div>
            </div>
        <?= form_close();?>
    </div>
  </div>
</div>
        