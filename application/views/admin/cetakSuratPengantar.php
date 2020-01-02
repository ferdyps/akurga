<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Surat Pengantar</h1>

          <!-- DataTales Example -->
          <div class="card mb-4">
                <h3 class="text-center font-weight-bold py-3">RUKUN TETANGGA 01</h3>
                <h5 class="text-center font-weight-bold">
                    RUKUN WARGA 01 <br>
                    DESA SUKAPURA KECAMATAN DAYEUHKOLOT <br>
                    KABUPATEN BANDUNG
                </h5>
                <hr class="m-0">
                <p class="text-center m-0">Sekretariat : Manggadua RT. 01 RW. 01 Desa Sukapura Kec. Dayeuhkolot Kab. Bandung - 40267</p>
                <hr class="m-0">
            <div class="card-body">
              <div class="table-responsive">
                <h5 class="text-center font-weight-bold"><u>SURAT KETERANGAN</u></h5>
                <?php 
                    $row=$cetak_surat_pengantar
                ?>
                <h6 class="text-center font-weight-bold">No. :<?= $row->nomor_surat?></h6>
                <p class="mt-5">Saya yang bertanda tangan di bawah ini Ketua RT 01/ RW 01 , Desa Sukapura Kecamatan Dayeuhkolot Kabupaten Bandung, dengan ini menerangkan bahwa:</p>
                <table class="mt-3 ml-5">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= ucwords($row->nama)?></td>
                    </tr>
                    <tr>
                        <td>Tempat/ Tanggal Lahir</td>
                        <td>:</td>
                        <td><?= ucwords($row->tempat_lahir)?>/<?= date('d F Y', strtotime($row->tanggal_lahir))?></td>
                    </tr>
                    <tr>
                        <td>No. KTP</td>
                        <td>:</td>
                        <td><?= $row->nik?></td>
                    </tr>
                    <tr>
                        <td>Pekerjaan</td>
                        <td>:</td>
                        <td><?= ucwords($row->pekerjaan)?></td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td>:</td>
                        <td><?= ucwords($row->agama)?></td>
                    </tr>
                    <tr>
                        <td>Kewarganegaraan</td>
                        <td>:</td>
                        <td>Indonesia</td>
                    </tr>
                    <tr>
                        <td>Status Perkawinan</td>
                        <td>:</td>
                        <td><?= ucfirst($row->status)?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>Jl. <?= ucwords($row->nama_jalan)?>, <?= $row->gang?>, No. <?= $row->no_rumah?>, RT. 01 RW. 01, Babakan Ciamis, Kabupaten bandung</td>
                    </tr>
                </table>
                <p class="mt-5">Adalah benar warga kami.</p>
                <p class="m-0">Surat Keterangan ini diberikan untuk dipergunakan <?= ucwords($row->keperluan)?>.</p>
                <p class="text-right mt-5 mb-0">Manggadua, <?= date('d F Y', strtotime($row->tanggal_surat))?></p>
                
                <div class="row m-0">
                    <div class="col">
                        <h6 class="font-weight-bold pb-4">KETUA RW. 01</h6>
                        <p class="font-weight-bold mt-5"><u>..........................</u></p>
                    </div>
                    <div class="col text-right">
                        <p class="font-weight-bold mb-0">Hormat Kami,</p>
                        <h6 class="font-weight-bold mt-0">KETUA RW. 01</h6>
                        <p class="font-weight-bold mt-5"><u>..........................</u></p>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>