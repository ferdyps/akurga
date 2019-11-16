  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Input Data Warga</h1>
</div>

<div class="container">
    <div class="row bg-white rounded shadow border-left-primary">
        <div class="col px-0">
        <?php echo form_open();?>
            <div class="row px-3 my-3">
                <div class="col">
                    <div class="form-group">
                        <label for="NomorKTP">NIK</label>
                        <input type="text" name="nik" id="NomorKTP" class="form-control <?php if(form_error('nik')) { echo 'is-invalid'; } ?>" placeholder="Nomor Induk Kependudukan" value="<?= set_value('nik'); ?>">
                        <div class="invalid-feedback">
                            <?= form_error('nik'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="NamaLengkap">Nama Lengkap</label>
                        <input type="text" name="nama" id="NamaLengkap" class="form-control <?php if(form_error('nama')) { echo 'is-invalid'; } ?>" placeholder="Nama Lengkap" value="<?= set_value('nama'); ?>">
                        <div class="invalid-feedback">
                            <?= form_error('nama'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="NomorTelepon">Nomor Telepon/HP</label>
                        <input type="text" name="telp" id="NomorTelepon" class="form-control <?php if(form_error('telp')) {echo 'is-invalid'; }?>" placeholder="Nomor Telepon/HP" value="<?= set_value('telp');?>">
                        <div class="invalid-feedback">
                            <?= form_error('telp');?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="Tempat">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat" class="form-control <?php if(form_error('tempat_lahir')) {echo 'is-invalid'; } ?>" placeholder="Tempat Lahir" value="<?= set_value('tempat_lahir');?>">
                            <div class="invalid-feedback">
                                <?= form_error('tempat_lahir');?>
                            </div>
                        </div>
                        <div class="col">
                            <label for="Tanggal">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="Tanggal" class="form-control <?php if(form_error('tanggal_lahir')) {echo 'is-invalid'; } ?>" value="<?= set_value('tempat_lahir');?>">
                            <div class="invalid-feedback">
                                <?= form_error('tanggal_lahir');?>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="Agama">Agama</label>
                        <select name="agama" id="Agama" class="form-control">
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="katolik">Katolik</option>
                            <option value="hindu">Hindu</option>
                            <option value="budha">Budha</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="JK">Jenis Kelamin</label>
                        <select name="jk" id="JK" class="form-control">
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Hub_Dlm_Kel">Hubungan Dalam Keluarga</label>
                        <select name="hub_dlm_kel" id="Hub_Dlm_Kel" class="form-control">
                            <option value="suami">Suami</option>
                            <option value="istri">Istri</option>
                            <option value="anak">Anak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Status">Status Pernikahan</label>
                        <select name="status" id="Status" class="form-control">
                            <option value="menikah">Menikah</option>
                            <option value="lajang">Lajang</option>
                        </select>
                    </div>
                    <div class="row form-group text-center">
                        <button type="submit" class="btn btn-success btn-circle">
                            <i class="fas fa-check"></i>
                        </button>
                    </div>
                </div>
            </div>
        <?php echo form_close();?>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->