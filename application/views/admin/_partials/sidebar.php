<?php
  $rt = 'RT '.$this->session->userdata('rt');
  $sekarang = date("Y-m-d");
  $semuaWarga = $this->m_admin->CountData('warga',['valid'=>0])->result_array();
  $notif_cetak_sp = $this->m_admin->CountData('status_surat',['status' => 'diterima', 'expired_date >' => $sekarang])->result_array();
  $notif_komplain_rw = $this->m_admin->CountData('komplain',['status' => 'proses', 'lingkup' => 'RW'])->result_array();
  $notif_decline_warga = $this->m_admin->CountData('warga',['valid'=>2, 'rt'=> $this->session->userdata('rt')])->result_array();
  $notif_komplain_rt = $this->m_admin->CountData('komplain',['status'=>'proses','lingkup'=> 'RT'])->result_array();
  $notif_suratundangan = $this->m_admin->CountData('surat_undangan',['status'=>'0','rt'=> $rt])->result_array();
  $notif_sp = $this->m_admin->notif_sp($rt)->num_rows();
?>
<div id="wrapper">
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
          <!-- <i class="fas fa-laugh-wink"></i> -->
        </div>
        <div class="sidebar-brand-text mx-10"><?= config_item('web_title')?></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <!-- <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url("admin/index");?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li> -->

      <!-- Divider -->
      <hr class="sidebar-divider">
      <?php
      if ( $this->session->userdata('role') == 'Ketua RW') { ?>

        <li class="nav-item active">
          <a class="nav-link" href="<?php echo base_url("ketuaRW/index");?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Ketua RW
      </div>
      <!-- Nav Item - Pages Collapse Menu -->

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('ketuaRW/konfirmasiDataWarga')?>">
          <i class="fas fa-fw fa-users"></i>
            <span>Warga
            <?php
              foreach($semuaWarga as $row){

                if ($row['total'] < 1) {
                  ?>
                  <span class="badge badge-danger" hidden></span>
                  <?php
                } else {
                  ?>
                  <span class="badge badge-danger"><?=$row['total']?></span>
                  <?php
                }

              }
            ?>
            </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('ketuaRW/listCetakSuratPengantar')?>">
          <i class="fas fa-fw fa-envelope"></i>
          <span>Surat Pengantar
            <?php
              foreach($notif_cetak_sp as $row){

                if ($row['total'] < 1) {
                  ?>
                  <span class="badge badge-danger" hidden></span>
                  <?php
                } else {
                  ?>
                  <span class="badge badge-danger"><?=$row['total']?></span>
                  <?php
                }

              }
            ?>
          </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('ketuaRW/daftarKomplainRW')?>">
          <i class="fas fa-fw fa-bullhorn"></i>
          <span>Pengaduan
            <?php
              foreach($notif_komplain_rw as $row){

                if ($row['total'] < 1) {
                  ?>
                  <span class="badge badge-danger" hidden></span>
                  <?php
                } else {
                  ?>
                  <span class="badge badge-danger"><?=$row['total']?></span>
                  <?php
                }

              }
            ?>
          </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('ketuaRW/list_akun')?>">
          <i class="fas fa-fw fa-address-book"></i>
          <span>Akun</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengurus" aria-expanded="true" aria-controls="collapsePengurus">
          <i class="fas fa-fw fa-envelope"></i>
          <span>Usulan Surat Undangan</span>
        </a>
        <div id="collapsePengurus" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url("ketuaRW/usul_pembuatanRW");?>">Usulan Pembuatan Surat</a>
            <a class="collapse-item" href="<?php echo base_url("ketuaRW/tbl_usulan_ketuaRW");?>">Riwayat Usulan Surat</a>
            <a class="collapse-item" href="<?php echo base_url("ketuaRW/riwayat_Undangan");?>">Riwayat Surat Undangan</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKetuaRTsurat" aria-expanded="true" aria-controls="collapseKetuaRTsurat"> -->
        <a class="nav-link collapsed" href="<?php echo base_url('ketuaRW/riwayat_notulensi');?>" aria-expanded="true">
          <i class="fas fa-fw fa-edit"></i>
          <span>Riwayat Notulensi Rapat</span>
        </a>
      </li>

      <li class="nav-item">
        <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKetuaRTsurat" aria-expanded="true" aria-controls="collapseKetuaRTsurat"> -->
        <a class="nav-link collapsed" href="<?php echo base_url('ketuaRW/riwayat_arsip');?>" aria-expanded="true">
          <i class="fas fa-fw fa-archive"></i>
          <span>Riwayat Arsip Surat</span>
        </a>
      </li>
      <hr class="sidebar-divider">


      <?php } elseif ( $this->session->userdata('role') == 'Ketua RT'){ ?>
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo base_url("ketuaRT/index");?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Ketua RT
      </div>
      <!-- Nav Item - Pages Collapse Menu -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKetuaRT" aria-expanded="true" aria-controls="collapseKetuaRT">
          <i class="fas fa-fw fa-users"></i>
          <span>Warga
            <?php
              foreach($notif_decline_warga as $row){

                if ($row['total'] < 1) {
                  ?>
                  <span class="badge badge-danger" hidden></span>
                  <?php
                } else {
                  ?>
                  <span class="badge badge-danger"><?=$row['total']?></span>
                  <?php
                }

              }
            ?>
          </span>
        </a>
        <div id="collapseKetuaRT" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url("ketuaRT/inputWarga");?>">Input Data Warga</a>
            <a class="collapse-item" href="<?= base_url('ketuaRT/tabelDataWarga')?>">List Data Warga</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKetuaRTsurat" aria-expanded="true" aria-controls="collapseKetuaRTsurat"> -->
        <a class="nav-link collapsed" href="<?php echo base_url('ketuaRT/daftarSuratPengantar');?>" aria-expanded="true">
          <i class="fas fa-fw fa-envelope"></i>
          <span>Surat Pengantar
            <?php
                if ($notif_sp < 1) {
                  ?>
                  <span class="badge badge-danger" hidden></span>
                  <?php
                } else {
                  ?>
                  <span class="badge badge-danger"><?=$notif_sp?></span>
                  <?php
                }
            ?>
          </span>
        </a>
        <!-- <div id="collapseKetuaRTsurat" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url('ketuaRT/daftarSuratPengantar');?>">List Surat Pengantar</a>
          </div>
        </div> -->
      </li>
      <li class="nav-item">
        <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKetuaRTkomplain" aria-expanded="true" aria-controls="collapseKetuaRTkomplain"> -->
        <a class="nav-link collapsed" href="<?= base_url('ketuaRT/daftarKomplain');?>" aria-expanded="true">
          <i class="fas fa-fw fa-bullhorn"></i>
          <span>Pengaduan
            <?php
              foreach($notif_komplain_rt as $row){

                if ($row['total'] < 1) {
                  ?>
                  <span class="badge badge-danger" hidden></span>
                  <?php
                } else {
                  ?>
                  <span class="badge badge-danger"><?=$row['total']?></span>
                  <?php
                }

              }
            ?>
          </span>
        </a>
        <!-- <div id="collapseKetuaRTkomplain" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url('ketuaRT/daftarKomplain');?>">List Komplain</a>
          </div>
        </div> -->
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengurus" aria-expanded="true" aria-controls="collapsePengurus">
          <i class="fas fa-fw fa-envelope"></i>
          <span>Surat Undangan</span>
        </a>
        <div id="collapsePengurus" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url("ketuaRT/usul_pembuatan");?>">Usulan Pembuatan Surat</a>
            <a class="collapse-item" href="<?php echo base_url("ketuaRT/tbl_usulan_ketua");?>">Riwayat Usulan Surat</a>
            <a class="collapse-item" href="<?php echo base_url("ketuaRT/riwayat_Undangan");?>">Riwayat Surat Undangan</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKetuaRTsurat" aria-expanded="true" aria-controls="collapseKetuaRTsurat"> -->
        <a class="nav-link collapsed" href="<?php echo base_url('ketuaRT/riwayat_notulensi');?>" aria-expanded="true">
          <i class="fas fa-fw fa-edit"></i>
          <span>Riwayat Notulensi Rapat</span>
        </a>
      </li>

      <li class="nav-item">
        <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKetuaRTsurat" aria-expanded="true" aria-controls="collapseKetuaRTsurat"> -->
        <a class="nav-link collapsed" href="<?php echo base_url('ketuaRT/riwayat_arsip');?>" aria-expanded="true">
          <i class="fas fa-fw fa-archive"></i>
          <span>Riwayat Arsip Surat</span>
        </a>
      </li>

          <hr class="sidebar-divider">
      <?php } else if ( $this->session->userdata('role') == 'Bendahara'){ ?>
      <div class="sidebar-heading">
        Bendahara
      </div>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBendaharaPengeluaran" aria-expanded="true" aria-controls="collapseBendahara">
          <i class="fas fa-fw fa-cog"></i>
          <span>Pengeluaran</span>
        </a>
        <div id="collapseBendaharaPengeluaran" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url("Bendahara/formpengeluaran");?>">Form Pengeluaran</a>
            <a class="collapse-item" href="<?php echo base_url("Bendahara/tabeldataiurankeluar");?>">Tabel Pengeluaran</a>
            <!-- <a class="collapse-item" href="<?php echo base_url("Bendahara/formpemasukan");?>">Form Pemasukan</a>
            <a class="collapse-item" href="<?php echo base_url("Bendahara/tabelpemasukan");?>">Tabel Pemasukan</a>
            <a class="collapse-item" href="<?php echo base_url("Bendahara/tampilbulan");?>">Tabel Tampilan Bulan</a> -->
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBendaharaPembayaran" aria-expanded="true" aria-controls="collapseBendahara">
          <i class="fas fa-fw fa-cog"></i>
          <span>Pembayaran</span>
        </a>
        <div id="collapseBendaharaPembayaran" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <a class="collapse-item" href="<?php echo base_url("Bendahara/formpengeluaran");?>">Form Pengeluaran</a>
            <a class="collapse-item" href="<?php echo base_url("Bendahara/tabeldataiurankeluar");?>">Tabel Pengeluaran</a> -->
            <!-- <a class="collapse-item" href="<?php echo base_url("Bendahara/formpemasukan");?>">Form Pemasukan</a> -->
            <a class="collapse-item" href="<?php echo base_url("Bendahara/tabelpemasukan");?>">Tabel Pemasukan</a>
            <a class="collapse-item" href="<?php echo base_url("Bendahara/tampilbulan");?>">Tabel Tampilan Bulan</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?php echo base_url("Bendahara/rekapbulan");?>">
          <i class="fas fa-fw fa-cog"></i>
          <span>Laporan Keuangan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?php echo base_url("Bendahara/tabeltarif");?>">
          <i class="fas fa-fw fa-cog"></i>
          <span>Tarif</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      <?php } else if ( $this->session->userdata('role') == 'Bendahara RW'){ ?>
      <div class="sidebar-heading">
        Bendahara RW
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?php echo base_url("Bendahara/rekaprt");?>">
          <i class="fas fa-fw fa-cog"></i>
          <span>Laporan Keuangan</span>
        </a>
      </li>
      <?php } else if ( $this->session->userdata('role') == 'Kolektor Iuran'){ ?>
      <div class="sidebar-heading">
        Kolektor Iuran
      </div>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBendahara" aria-expanded="true" aria-controls="collapseBendahara">
          <i class="fas fa-fw fa-cog"></i>
          <span>Pembayaran</span>
        </a>
        <div id="collapseBendahara" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <a class="collapse-item" href="<?php echo base_url("Bendahara/tabeldataiurankeluaruser");?>">Tabel Pengeluaran</a> -->
            <a class="collapse-item" href="<?php echo base_url("Bendahara/formpemasukan");?>">Form Pemasukan</a>
            <!-- <a class="collapse-item" href="<?php echo base_url("Bendahara/tabelpemasukan");?>">Tabel Pemasukan</a> -->
            <a class="collapse-item" href="<?php echo base_url("Bendahara/tampilbulan");?>">Tabel Tampilan Bulan</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBendahara" aria-expanded="true" aria-controls="collapseBendahara">
          <i class="fas fa-fw fa-cog"></i>
          <span>Pengeluaran</span>
        </a>
        <div id="collapseBendahara" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url("Bendahara/tabeldataiurankeluaruser");?>">Tabel Pengeluaran</a>
            <!-- <a class="collapse-item" href="<?php echo base_url("Bendahara/formpemasukan");?>">Form Pemasukan</a> -->
            <!-- <a class="collapse-item" href="<?php echo base_url("Bendahara/tabelpemasukan");?>">Tabel Pemasukan</a>
            <a class="collapse-item" href="<?php echo base_url("Bendahara/tampilbulan");?>">Tabel Tampilan Bulan</a> -->
          </div>
        </div>
      </li>

    <?php }elseif ( $this->session->userdata('role') == 'Sekretaris RT' || $this->session->userdata('role') == 'Sekretaris RW' ) {?>
      <!-- ================================ SEKRETARIS ========================================== -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url("sekretaris/index");?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">Sekretaris</div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSekretarisUndangan" aria-expanded="true" aria-controls="collapseSekretarisUndangan">
          <i class="fas fa-fw fa-envelope"></i>
          <span>Surat undangan</span>
        </a>
        <div id="collapseSekretarisUndangan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">


            <a class="collapse-item" href="<?php echo base_url("sekretaris/pembuatan_undangan");?>">Pembuatan Surat <br>Undangan
              <?php
                foreach($notif_suratundangan as $rows){

                  if ($rows['total'] < 1) {
                    ?>
                    <span class="badge badge-danger" hidden></span>
                    <?php
                  } else {
                    ?>
                    <span class="badge badge-danger"><?= $rows['total']?></span>
                    <?php
                  }

                }
              ?>
            </a>

            <a class="collapse-item" href="<?php echo base_url("sekretaris/riwayat_Undangan");?>">Riwayat Surat Undangan</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSekretarisNotulensi" aria-expanded="true" aria-controls="collapseSekretarisNotulensi">
          <i class="fas fa-fw fa-edit"></i>
          <span>Notulensi Rapat</span>
        </a>
        <div id="collapseSekretarisNotulensi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url("sekretaris/riwayat_notulensi");?>">Riwayat Notulensi Rapat</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSekretarisArsip" aria-expanded="true" aria-controls="collapseSekretarisArsip">
          <i class="fas fa-fw fa-archive"></i>
          <span>Arsip Surat</span>
        </a>
        <div id="collapseSekretarisArsip" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url("sekretaris/input_arsipsurat");?>">Input Surat Masuk</a>
            <a class="collapse-item" href="<?php echo base_url("sekretaris/riwayat_arsip");?>">Riwayat Arsip Surat</a>
          </div>
        </div>
      </li>
          <hr class="sidebar-divider">
      <?php } else {?>
        <div class="sidebar-heading">
        Ketua RW
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/konfirmasiDataWarga')?>">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Approval Data Warga</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/listCetakSuratPengantar')?>">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Cetak Surat Pengantar</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/list_akun')?>">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>List Akun Pengguna</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/daftarKomplainRW')?>">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Daftar Komplain</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Ketua RT
      </div>

      <!-- Nav Item - Pages Collapse Menu -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKetuaRT" aria-expanded="true" aria-controls="collapseKetuaRT">
          <i class="fas fa-fw fa-users"></i>
          <span>Data Warga</span>
        </a>
        <div id="collapseKetuaRT" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url("admin/inputWarga");?>">Input Data Warga</a>
            <a class="collapse-item" href="<?= base_url('admin/tabelDataWarga')?>">List Data Warga</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKetuaRTsurat" aria-expanded="true" aria-controls="collapseKetuaRTsurat">
          <i class="fas fa-fw fa-envelope"></i>
          <span>Surat Pengantar</span>
        </a>
        <div id="collapseKetuaRTsurat" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url('admin/daftarSuratPengantar');?>">List Surat Pengantar</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKetuaRTkomplain" aria-expanded="true" aria-controls="collapseKetuaRTkomplain">
          <i class="fas fa-fw fa-cog"></i>
          <span>Komplain</span>
        </a>
        <div id="collapseKetuaRTkomplain" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url('admin/daftarKomplain');?>">List Komplain</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Bendahara
      </div>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBendahara" aria-expanded="true" aria-controls="collapseBendahara">
          <i class="fas fa-fw fa-cog"></i>
          <span>Keuangan</span>
        </a>
        <div id="collapseBendahara" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url("admin/formpengeluaran");?>">Form Pengeluaran</a>
            <a class="collapse-item" href="<?php echo base_url("admin/tabeldataiurankeluar");?>">Tabel Pengeluaran</a>
            <a class="collapse-item" href="<?php echo base_url("admin/formpemasukan");?>">Form Pemasukan</a>
            <a class="collapse-item" href="<?php echo base_url("admin/tabelpemasukan");?>">Tabel Pemasukan</a>
            <a class="collapse-item" href="<?php echo base_url("admin/tampilbulan");?>">Tabel Tampilan Bulan</a>
            <!-- <a class="collapse-item" href="<?php echo base_url("admin/rekapbulan");?>">Rekap Iuran</a> -->
          </div>
        </div>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">Sekretaris</div>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSekretarisUndangan" aria-expanded="true" aria-controls="collapseSekretarisUndangan">
          <i class="fas fa-fw fa-cog"></i>
          <span>Surat undangan</span>
        </a>
        <div id="collapseSekretarisUndangan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            hijau <a class="collapse-item" href="<?php echo base_url("admin/pembuatan_undangan");?>">Pembuatan  Surat <br>Undangan</a>
            <a class="collapse-item" href="<?php echo base_url("admin/riwayat_Undangan");?>">Riwayat Surat Undangan</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSekretarisNotulensi" aria-expanded="true" aria-controls="collapseSekretarisNotulensi">
          <i class="fas fa-fw fa-cog"></i>
          <span>Notulensi Rapat</span>
        </a>
        <div id="collapseSekretarisNotulensi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url("admin/riwayat_notulensi");?>">Riwayat Notulensi Rapat</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSekretarisArsip" aria-expanded="true" aria-controls="collapseSekretarisArsip">
          <i class="fas fa-fw fa-archive"></i>
          <span>Arsip Surat</span>
        </a>
        <div id="collapseSekretarisArsip" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url("admin/input_arsipsurat");?>">Input Surat Masuk</a>
            <a class="collapse-item" href="<?php echo base_url("admin/riwayat_arsip");?>">Riwayat Arsip Surat</a>
          </div>
        </div>
      </li>
      <?php } ?>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>



    </ul>
