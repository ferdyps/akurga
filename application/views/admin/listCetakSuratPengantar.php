<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Surat Pengantar</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Cetak Surat Pengantar</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="bg-primary text-white text-center">
                      <th width="5%">No</th>
                      <th>Nomor Surat</th>
                      <th>NIK</th>
                      <th>Nama Lengkap</th>
                      <th>Keperluan</th>
                      <th>Masa Berlaku</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                  <?php
                    $i=1; 
                    foreach($list_cetak_surat_pengantar as $row)
                  {?>
                      <tr>
                        <td><?= $i++?></td>
                        <td><?= $row['nomor_surat']?></td>
                        <td><?= $row['nik']?></td>
                        <td><?= $row['nama']?></td>
                        <td><?= $row['keperluan']?></td>
                        <td><?= strftime("%d %B %Y",strtotime($row['expired_date']))?></td>
                        <td>
                        <?php 
                        
                          $now = date("Y-m-d");
                          $expired = $row['expired_date'];

                          if ($now <= $expired) {
                        
                        ?>
                        <a href="<?= base_url('ketuaRW/cetak_surat_pengantar/'.$row['nomor_surat'])?>" class="btn btn-success" target="_BLANK"><i class="fas fa-print"></i></a>
                        <?php

                          } else {

                        ?>
                          <a class="btn btn-success" disabled><i class="fas fa-print"></i></a>
                        <?php
                          }
                        ?>
                        </td>
                      </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>