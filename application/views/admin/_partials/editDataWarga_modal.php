<div class="modal fade" id="editDataWargaModal" tabindex="-1" role="dialog" aria-labelledby="editDataWargaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editDataWargaModalLabel">Detail Data Warga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('admin/editWarga', ['id' => 'default-form', 'log' => 'Edit Warga']);?>
            <div class="row px-3 my-3">
                <div class="col">
                    <div class="form-group form-input">
                        <label for="edit-jenisWarga">Jenis Warga</label>
                        <select name="jenis_warga" id="edit-jenisWarga" class="form-control" readonly>
                            <option value="Sementara">Sementara</option>
                            <option value="Tetap">Tetap</option>
                        </select>
                    </div>
                    <div class="form-group form-input">
                        <label for="edit-nik">NIK</label>
                        <input type="text" name="nik" id="edit-nik" class="form-control" placeholder="Nomor Induk Kependudukan" readonly>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="edit-nama">Nama Lengkap</label>
                        <input type="text" name="nama" id="edit-nama" class="form-control" placeholder="Nama Lengkap">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input form-nohp">
                        <label for="edit-nohp">Nomor HP</label>
                        <input type="text" name="nohp" id="edit-nohp" class="form-control" placeholder="Nomor HP">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group row">
                        <div class="col form-input">
                            <label for="edit-tempat_lahir">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="edit-tempat_lahir" class="form-control" placeholder="Tempat Lahir">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col form-input">
                            <label for="edit-tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="edit-tanggal_lahir" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group form-input">
                        <label for="edit-Pendidikan">Pendidikan</label>
                        <select name="pendidikan" id="edit-Pendidikan" class="form-control">
                            <option selected disabled>-- Pilih Pendidikan Terakhir --</option>
                            <option value="TIDAK/BELUM SEKOLAH">TIDAK/BELUM SEKOLAH</option>
                            <option value="BELUM TAMAT SD/SEDERAJAT">BELUM TAMAT SD/SEDERAJAT</option>
                            <option value="TAMAT SD/SEDERAJAT">TAMAT SD/SEDERAJAT</option>
                            <option value="SLTP/SEDERAJAT">SLTP/SEDERAJAT</option>
                            <option value="SLTA/SEDERAJAT">SLTA/SEDERAJAT</option>
                            <option value="DIPLOMA I/II">DIPLOMA I/II</option>
                            <option value="AKADEMI/DIPLOMA III/S. MUDA">AKADEMI/DIPLOMA III/S. MUDA</option>
                            <option value="DIPLOMA IV/STRATA I">DIPLOMA IV/STRATA I</option>
                            <option value="STRATA II">STRATA II</option>
                            <option value="STRATA III">STRATA III</option>
                        </select>
                    </div>
                    <div class="form-group form-input">
                        <label for="edit-Pekerjaan">Pekerjaan</label>
                        <select name="pekerjaan" id="edit-Pekerjaan" class="form-control">
                            <option selected disabled>-- Pilih Pekerjaan --</option>
                            <option value="PEGAWAI NEGERI SIPIL">PEGAWAI NEGERI SIPIL</option>
                            <option value="KARYAWAN SWASTA">KARYAWAN SWASTA</option>
                            <option value="PELAJAR/MAHASISWA">PELAJAR/MAHASISWA</option>
                            <option value="MENGURUS RUMAH TANGGA">MENGURUS RUMAH TANGGA</option>
                            <option value="PENSIUNAN">PENSIUNAN</option>
                            <option value="BELUM/TIDAK BEKERJA">BELUM/TIDAK BEKERJA</option>
                        <select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group form-input form-kk">
                        <label for="edit-nokk">Nomor KK</label>
                        <input type="text" name="nokk" id="edit-nokk" class="form-control" placeholder="Nomor KK">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="edit-Agama">Agama</label>
                        <select name="agama" id="edit-Agama" class="form-control">
                            <option selected disabled>-- Pilih Agama --</option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="katolik">Katolik</option>
                            <option value="hindu">Hindu</option>
                            <option value="budha">Budha</option>
                        </select>
                    </div>
                    <div class="form-group form-input">
                        <label for="edit-JK">Jenis Kelamin</label>
                        <select name="jk" id="edit-JK" class="form-control">
                            <option selected disabled>-- Pilih Jenis Kelamin --</option>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group form-input form-hub">
                        <label for="edit-Hub_Dlm_Kel">Hubungan Dalam Keluarga</label>
                        <select name="hub_dlm_kel" id="edit-Hub_Dlm_Kel" class="form-control">
                            <option value="" selected disabled>-- Hubungan dalam Keluarga --</option>
                            <option value="suami">Suami</option>
                            <option value="istri">Istri</option>
                            <option value="anak">Anak</option>
                        </select>
                    </div>
                    <div class="form-group form-input">
                        <label for="edit-Status">Status Pernikahan</label>
                        <select name="status" id="edit-Status" class="form-control">
                            <option selected disabled>-- Pilih Status --</option>
                            <option value="menikah">Menikah</option>
                            <option value="lajang">Lajang</option>
                        </select>
                    </div>
                    <div class="form-group form-input">
                        <label for="edit-no_rumah">Nomor Rumah</label>
                        <input type="text" name="no_rumah" id="edit-no_rumah" class="form-control" placeholder="Nomor Rumah">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="edit-Gang">Gang</label>
                        <select name="gang" id="edit-Gang" class="form-control">
                            <option selected disabled>-- Pilih Gang --</option>
                            <option value="Bbk.Ciamis I">Bbk.Ciamis I</option>
                            <option value="Bbk.Ciamis II">Bbk.Ciamis II</option>
                            <option value="Bbk.Ciamis III">Bbk.Ciamis III</option>
                            <option value="Bbk.Ciamis IV">Bbk.Ciamis IV</option>
                            <option value="Bbk.Ciamis V">Bbk.Ciamis V</option>
                        </select>
                    </div>    
                </div>
            </div>
            <div class="col">
                <div class="form-group text-center">
                    <input type="submit" value="Edit" class="btn btn-primary">
                    <input type="reset" value="Reset" class="btn btn-danger">
                </div>
            </div>
        <?= form_close();?>
    </div>
  </div>
</div>
<script>
    function w_tetap(stats) {
        if (stats) {
            $('.form-hub').fadeIn();
            $('.form-kk').fadeIn();
        } else {
            $('.form-kk').fadeOut();
            $('#edit-nokk').val("");

            $('.form-hub').fadeOut();
            $('#edit-Hub_Dlm_Kel').val("");
        }
    }

    function w_sementara(stats) {
        if (stats) {
            $('.form-nohp').fadeIn();
        } else {
            $('.form-nohp').fadeOut();
            $('#edit-nohp').val("");
        }
    }

    function startup() {
        var tipe = $('#edit-jenisWarga').children('option:selected').val();

        if(tipe == "Tetap"){
            w_tetap(true);

            w_sementara(false);
        } else {
            w_sementara(true);

            w_tetap(false);
        }
    }

    $(document).ready(function(){
        $('#edit-jenisWarga').change(function(){
            var tipe = $(this).children('option:selected').val();

            if(tipe == "Tetap"){
                w_tetap(true);

                w_sementara(false);
            } else {
                w_sementara(true);

                w_tetap(false);
            }
        });
    });

    $('#editDataWargaModal').on('shown.bs.modal', function () {
        startup();
    });
</script>