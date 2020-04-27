  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Input Data Warga</h1>
</div>

<div class="container">
    <div class="row bg-white rounded shadow border-left-primary">
        <div class="col px-0">
        <?= form_open_multipart('ketuaRT/insertWarga', ['id' => 'default-form', 'log' => 'Input Warga']);?>
            <div class="row px-3 my-3">
                <div class="col">
                    <div class="form-group form-input">
                        <label for="jenisWarga">Jenis Warga</label>
                        <select name="jenis_warga" id="jenisWarga" class="form-control">
                            <option value="Sementara">Sementara</option>
                            <option value="Tetap">Tetap</option>
                        </select>
                    </div>
                    <div class="form-group form-input">
                        <label for="input-nik">NIK</label>
                        <input type="text" name="nik" id="input-nik" class="form-control" placeholder="Nomor Induk Kependudukan">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="input-nama">Nama Lengkap</label>
                        <input type="text" name="nama" id="input-nama" class="form-control" placeholder="Nama Lengkap" autocomplete="off">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input form-nohp">
                        <label for="input-nohp">Nomor HP</label>
                        <input type="text" name="nohp" id="input-nohp" class="form-control" placeholder="Nomor HP">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="input-tempat_lahir">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="input-tempat_lahir" class="form-control" placeholder="Tempat Lahir">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="input-tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="input-tanggal_lahir" class="form-control datepickerLagi">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="Pendidikan">Pendidikan</label>
                        <select name="pendidikan" id="Pendidikan" class="form-control">
                            <option selected disabled>-- Pilih Pendidikan Terakhir --</option>
                            <option value="TIDAK/BELUM SEKOLAH">TIDAK/BELUM SEKOLAH</option>
                            <option value="TAMAT SD/SEDERAJAT">SD/SEDERAJAT</option>
                            <option value="SLTP/SEDERAJAT">SLTP/SEDERAJAT</option>
                            <option value="SLTA/SEDERAJAT">SLTA/SEDERAJAT</option>
                            <option value="DIPLOMA I">DIPLOMA I</option>
                            <option value="DIPLOMA II">DIPLOMA II</option>
                            <option value="AKADEMI/DIPLOMA III/S. MUDA">AKADEMI/DIPLOMA III/S. MUDA</option>
                            <option value="DIPLOMA IV/STRATA I">DIPLOMA IV/STRATA I</option>
                            <option value="STRATA II">STRATA II</option>
                            <option value="STRATA III">STRATA III</option>
                        </select>
                    </div>
                    <div class="form-group form-input">
                        <label for="Pekerjaan">Pekerjaan</label>
                        <select name="pekerjaan" id="Pekerjaan" class="form-control">
                            <option selected disabled>-- Pilih Pekerjaan --</option>
                            <option value="BELUM/TIDAK BEKERJA">BELUM/TIDAK BEKERJA</option>
                            <option value="DOSEN">DOSEN</option>
                            <option value="GURU">GURU</option>
                            <option value="KARYAWAN BUMN">KARYAWAN BUMN</option>
                            <option value="KARYAWAN SWASTA">KARYAWAN SWASTA</option>
                            <option value="KEPOLISIAN RI">KEPOLISIAN RI</option>
                            <option value="MAHASISWA">MAHASISWA</option>
                            <option value="MENGURUS RUMAH TANGGA">MENGURUS RUMAH TANGGA</option>
                            <option value="PEGAWAI NEGERI SIPIL">PEGAWAI NEGERI SIPIL</option>
                            <option value="PELAJAR">PELAJAR</option>
                            <option value="PENSIUNAN">PENSIUNAN</option>
                            <option value="TENTARA NASIONAL INDONESIA">TENTARA NASIONAL INDONESIA</option>
                            <option value="WIRASWASTA">WIRASWASTA</option>
                        <select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group form-input form-kk">
                        <label for="input-nokk">Nomor KK</label>
                        <input type="text" name="nokk" id="input-nokk" class="form-control" placeholder="Nomor KK">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="Agama">Agama</label>
                        <select name="agama" id="Agama" class="form-control">
                            <option selected disabled>-- Pilih Agama --</option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="katolik">Katolik</option>
                            <option value="hindu">Hindu</option>
                            <option value="budha">Budha</option>
                        </select>
                    </div>
                    <div class="form-group form-input">
                        <label for="JK">Jenis Kelamin</label>
                        <select name="jk" id="JK" class="form-control">
                            <option selected disabled>-- Pilih Jenis Kelamin --</option>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group form-input form-hub">
                        <label for="Hub_Dlm_Kel">Hubungan Dalam Keluarga</label>
                        <select name="hub_dlm_kel" id="Hub_Dlm_Kel" class="form-control">
                            <option value="" selected disabled>-- Hubungan dalam Keluarga --</option>
                            <option value="suami">Suami</option>
                            <option value="istri">Istri</option>
                            <option value="anak">Anak</option>
                        </select>
                    </div>
                    <div class="form-group form-input">
                        <label for="Status">Status Pernikahan</label>
                        <select name="status" id="Status" class="form-control">
                            <option selected disabled>-- Pilih Status --</option>
                            <option value="menikah">Menikah</option>
                            <option value="lajang">Lajang</option>
                        </select>
                    </div>
                    <div class="form-group form-input">
                        <label for="input-nama_jalan">Nama Jalan</label>
                        <input type="text" name="nama_jalan" id="input-nama_jalan" class="form-control" placeholder="Nama Jalan">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="input-no_rumah">Nomor Rumah</label>
                        <input type="text" name="no_rumah" id="input-no_rumah" class="form-control" placeholder="Nomor Rumah">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="Gang">Gang</label>
                        <select name="gang" id="Gang" class="form-control">
                            <option selected disabled>-- Pilih Gang --</option>
                            <option value="Bbk.Ciamis I">Bbk.Ciamis I</option>
                            <option value="Bbk.Ciamis II">Bbk.Ciamis II</option>
                            <option value="Bbk.Ciamis III">Bbk.Ciamis III</option>
                            <option value="Bbk.Ciamis IV">Bbk.Ciamis IV</option>
                            <option value="Bbk.Ciamis V">Bbk.Ciamis V</option>
                        </select>
                    </div>    
                    <div class="form-group form-input">
                        <label for="RT">RT</label>
                        <select name="rt" id="RT" class="form-control">
                            <option selected disabled>-- Pilih Rt --</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                        </select>
                    </div>
                    <div class="form-group form-input">
                        <label for="input-gambar">Gambar</label>
                        <div class="custom-file">
                            <input type="file" name="gambar" class="custom-file-input" id="input-gambar">
                            <label class="custom-file-label">Choose file</label>
                            <div class="invalid-feedback"></div>   
                        </div>
                    </div>   
                </div>
            </div>
            <div class="col">
                <div class="form-group text-center">
                    <input type="submit" value="Submit" class="btn btn-primary">
                    <input type="reset" value="Reset" class="btn btn-danger">
                </div>
            </div>
        <?= form_close();?>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>
    function w_tetap(stats) {
        if (stats) {
            $('.form-hub').fadeIn();
            $('.form-kk').fadeIn();
        } else {
            $('.form-kk').fadeOut();
            $('#input-nokk').val("");

            $('.form-hub').fadeOut();
            $('#Hub_Dlm_Kel').val("");
        }
    }

    function w_sementara(stats) {
        if (stats) {
            $('.form-nohp').fadeIn();
        } else {
            $('.form-nohp').fadeOut();
            $('#input-nohp').val("");
        }
    }
    $(document).ready(function(){
        w_sementara(true);
        w_tetap(false);

        $('#jenisWarga').change(function(){
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
</script>