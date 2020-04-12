<?php $row=$hasilKomplain; ?>
<header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h3 class="text-uppercase text-white font-weight-bold">Hasil Komplain ( <?= $row->nomor_komplain?> )</h3>
          <hr class="divider my-4">
        </div>
        <div class="col-lg-8 align-self-baseline"><div class="col">
            <h6 class="text-uppercase text-white font-weight-bold">Tanggal Ditindak Lanjuti <?= $row->tgl_tindak_lanjut?></h6>
            <textarea name="hasil_komplain" id="hasil_komplain" cols="30" rows="10" class="ckeditor" disabled><?= $row->tindak_lanjut?></textarea>        
        </div>
      </div>
    </div>
  </header>
