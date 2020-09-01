<div class="container-fluid">
 <!-- Page Heading -->

 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Input Iuran Keluar</h1>
 </div>
 <div class="container">

 <div class="row bg-white rounded shadow">
       <div class="col-6">
       <!-- <?php if(!empty(validation_errors())) :
        // ?>
  <!-- <?php echo validation_errors() ?> -->
<!-- <?php endif; ?>  -->
       <?=form_open_multipart("Bendahara/iurankeluar");
        $tanggal = date("d-m-Y");?>

           <div class="row px-3 my-3">
               <div class="col">
               <div class="form-group form-input">
                        <label for="anggaran">Kelompok Anggaran *</label>
                        <select name="diberikan_kepada" id="anggaran" class="form-control js-anggaran">
                            <option selected disabled>-- Kelompok Anggaran --</option>
                            <option value="Fotocopy">Fotocopy</option>
                            <option value="Gaji Pegawai">Gaji Pegawai</option>
                            <option value="Kesehatan">Kesehatan</option>
                            <option value="Duka Cita">Duka Cita</option>
                            <option value="Kebersihan">Kebersihan</option>
                            <!-- <option value="DIPLOMA II">DIPLOMA II</option>
                            <option value="AKADEMI/DIPLOMA III/S. MUDA">AKADEMI/DIPLOMA III/S. MUDA</option>
                            <option value="DIPLOMA IV/STRATA I">DIPLOMA IV/STRATA I</option>
                            <option value="STRATA II">STRATA II</option>
                            <option value="STRATA III">STRATA III</option> -->
                        </select>
                        <p class="text-danger mt-3 js-anggaran-warning"></p>
                    </div>
                   <?php echo form_error('diberikan_kepada','<small class="text-danger">','</small>'); ?>

                   <div class="form-group form-input">
                       <label for="input-tanggal">Tanggal</label>
                       <input name="tanggal" id="input-tanggal" class="form-control" value="<?= date("d-m-Y"); ?> " readonly required>
                       <div class="invalid-feedback"></div>
                   </div>
                   <?php echo form_error('tanggal'); ?>

                   <div class="form-group form-input">
                       <label for="rupiah">Nominal *</label>
                       <input type="text" name="nominal" id="rupiah" class="form-control js-rupiah">
                       <div class="invalid-feedback"></div>
                       <p class="text-danger mt-3 js-rupiah-warning"></p>
                   </div>
                   <?php echo form_error('nominal','<small class="text-danger">','</small>'); ?>

                   <div class="form-group form-input">
                       <label for="keterangan">Keterangan *</label>
                       <input type="text" name="digunakan_untuk" id="keterangan" class="form-control js-keterangan">
                       <div class="invalid-feedback"></div>
                       <p class="text-danger mt-3 js-keterangan-warning"></p>
                   </div>
                   <?php echo form_error('digunakan_untuk','<small class="text-danger">','</small>'); ?>

                   <div class="form-group form-input">
                       <label for="input-gambar">Gambar * **</label>
                       <input type="file" name="gambar" id="input-gambar" class="form-control js-input-gambar">
                       <table width="100%">
                          <tr>
                            <td><p style="color:red">* Wajib di Isi </p></td>
                            <td><p style="color:red">** File-type : .jpg / .jpeg / .png / .gif</p></td>
                          </tr>
                       </table>
                       <div class="invalid-feedback"></div>
                       <p class="text-danger mt-3 js-input-gambar-warning"></p>
                   </div>
                   <?php echo form_error('gambar'); ?>
           <div class="col">
               <div class="form-group text-center">
                   <input type="submit" name="submit" class="btn btn-primary js-btn-submit">
                   <input type="reset" value="Reset" class="btn btn-danger">
               </div>
           </div>
        <?= form_close();?>
       </div>
</div>
<script type="text/javascript">

    var rupiah = document.getElementById('rupiah');
    rupiah.addEventListener('keyup', function(e){
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split           = number_string.split(','),
        sisa            = split[0].length % 3,
        rupiah          = split[0].substr(0, sisa),
        ribuan          = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
    const jsAnggaran = $(".js-anggaran");
    const jsRupiah = $(".js-rupiah");
    const jsKeterangan = $(".js-keterangan");
    const jsInputGambar = $(".js-input-gambar");

    const jsAnggaranWarning = $(".js-anggaran-warning");
    const jsRupiahWarning = $(".js-rupiah-warning");
    const jsKeteranganWarning = $(".js-keterangan-warning");
    const jsInputGambarWarning = $(".js-input-gambar-warning");

    jsAnggaran.change(() => {
        jsAnggaranWarning.text("");
    });

    jsRupiah.focus(() => {
        if (jsAnggaran.val() == null) {
            jsRupiahWarning.text("Mata Anggaran belum diisi");
            jsAnggaran.focus();
        } else {
            jsRupiahWarning.text("");
        }
    });

    jsKeterangan.focus(() => {
        if (jsRupiah.val() == null || jsRupiah.val() == "") {
            jsKeteranganWarning.text("Nominal Belum diisi");
            jsRupiah.focus();
        } else {
            jsKeteranganWarning.text("");
        }
    });

    jsInputGambar.focus(() => {
        if (jsKeterangan.val() == null || jsKeterangan.val() == "") {
            jsInputGambarWarning.text("Keterangan Belum diisi");
            jsKeterangan.focus();
        } else {
            jsInputGambarWarning.text("");
        }
    });

    jsAnggaran.change(() => {
        jsRupiahWarning.text("");
    });
    jsRupiah.keyup(() => {
        jsKeteranganWarning.text("");
    });
    jsKeterangan.keyup(() => {
        jsInputGambarWarning.text("");
    });

    $("form").submit((e) => {
        if (jsAnggaran.val() == null) {
            e.preventDefault();
            jsAnggaranWarning.text("Mata Anggaran Harus Diisi");
        } else {
            jsAnggaranWarning.text("");
        }

        if (jsRupiah.val() == null || jsRupiah.val() == "") {
            e.preventDefault();
            jsRupiahWarning.text("Nominal Harus Diisi");
        } else {
            jsRupiahWarning.text("");
        }

        if (jsKeterangan.val() == null || jsKeterangan.val() == "") {
            e.preventDefault();
            jsKeteranganWarning.text("Keterangan Harus Diisi");
        } else {
            jsKeteranganWarning.text("");
        }

        if (jsInputGambar.val() == null || jsInputGambar.val() == "") {
            e.preventDefault();
            jsInputGambarWarning.text("Gambar Belum di Upload");
        } else {
            jsInputGambarWarning.text("");
        }
    })
</script>
