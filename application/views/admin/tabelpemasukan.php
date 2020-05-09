<div class="container-fluid">

<!-- Page Heading -->
<!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
-->
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tabel Pemasukan</h6>
  </div>


  <div class="row px-3 my-3">
              <div class="col">
              <div class="form-group form-input">
                  <label for="diberikan_kepada">Pilih Bulan</label>
                  <select name="diberikan_kepada" id="filterPemasukanBulanan" class="form-control">
                      <option selected disabled>-- Pilih Bulan --</option>
                      <option value="Januari">Januari</option>
                      <option value="Februari">Februari</option>
                      <option value="Maret">Maret</option>
                      <option value="April">April</option>
                      <option value="Mei">Mei</option>
                      <option value="Juni">Juni</option>
                      <option value="Juli">Juli</option>
                      <option value="Agustus">Agustus</option>
                      <option value="September">September</option>
                      <option value="Oktober">Oktober</option>
                      <option value="November">November</option>
                      <option value="Desember">Desember</option>
                  </select>
              </div>
              <div class="float-right">
                    <!-- <a href="<?= base_url(); ?>pengadaan/printpengadaan/ " target="_BLANK" class="container btn-primary btn-sm">Cetak Laporan</a> -->

                    <a class="" href="#" data-toggle="modal"  data-target="#cetakLaporanPengadaan" target="_BLANK" class="container btn-primary btn-sm">

                                    Cetak Laporan
                                </a>
                </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" >
        <thead>
          <tr>
            <th>NO</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Pembayaran Bulan</th>
            <th>Nominal</th>
            <th>Tanggal</th>
          </tr>
        </thead>
        <tbody id="dataPemasukan">
        </tbody>
      </table>
</div>
</div>

<script>
  $(document).ready(function () {
    let url = `<?= base_url()?>Bendahara/filterPemasukan`;

    dataUntukTabel(url)
  });

  $('#filterPemasukanBulanan').change(function(){
    let namaBulan = $('#filterPemasukanBulanan').val();
    let url = `<?= base_url()?>Bendahara/filterPemasukan/?bulan=${namaBulan}`;
    dataUntukTabel(url)
  });

  function formatHarga(harga) {
    harga = parseInt(harga);
    return (harga).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
  }

  function dataUntukTabel(_url) {
    $.ajax({
      method: "GET",
      url: _url,
      success: function(res){
        bikinTabel(JSON.parse(res));
      }
    });
  }

  function bikinTabel(res) {
    let nomor = 1;
    let total = 0;
    $('#dataPemasukan').html('');
    res.forEach(data => {
      let html = `
        <tr>
          <td>${nomor}</td>
          <td>${data.nik}</td>
          <td>${data.nama}</td>
          <td>${data.pembayaran_bulan}</td>
          <td>Rp. ${formatHarga(data.nominal)}</td>
          <td>${data.tanggal}</td>
        </tr>
      `;
      nomor += 1;
      total += parseInt(data.nominal);
      $('#dataPemasukan').append(html);
    });
    let rowTotal = `
      <tr>
        <td colspan="2" rospan="4">Total</td>
        <td></td>
        <td></td>
        <td>Rp. ${formatHarga(total)}</td>
        <td></td>
      </tr>
    `;
    $('#dataPemasukan').append(rowTotal);
  }
</script>
</div>
</div>
</div>
</div>
