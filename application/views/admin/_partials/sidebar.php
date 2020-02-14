<div id="wrapper">
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <!-- <i class="fas fa-laugh-wink"></i> -->
        </div>
        <div class="sidebar-brand-text mx-10"><?= config_item('web_title')?></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url("admin/index");?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
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
          <i class="fas fa-fw fa-cog"></i>
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
            <a class="collapse-item" href="<?= base_url('admin/inputHasilKomplain');?>">Input Hasil Komplain</a>
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
          </div>
        </div>
      </li>

      <!-- ================================ SEKRETARIS ========================================== -->
      <hr class="sidebar-divider">
      <div class="sidebar-heading">Sekretaris</div>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSekretarisUndangan" aria-expanded="true" aria-controls="collapseSekretarisUndangan">
          <i class="fas fa-fw fa-cog"></i>
          <span>Surat undangan</span>
        </a>
        <div id="collapseSekretarisUndangan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url("admin/inputundangan");?>">Input Surat Undangan</a>
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
            <a class="collapse-item" href="<?php echo base_url("admin/inputnotulensi");?>">Input Notulensi Rapat</a>
            <a class="collapse-item" href="<?php echo base_url("admin/riwayat_notulensi");?>">Riwayat Notulensi Rapat</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSekretarisArsip" aria-expanded="true" aria-controls="collapseSekretarisArsip">
          <i class="fas fa-fw fa-cog"></i>
          <span>Arsip Surat</span>
        </a>
        <div id="collapseSekretarisArsip" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url("admin/input_arsipsurat");?>">Input Surat Masuk</a>
            <a class="collapse-item" href="<?php echo base_url("admin/riwayat_arsip");?>">Riwayat Arsip Surat</a>
          </div>
        </div>
      </li>

      <!-- ================================ END OF SEKRETARIS ========================================== -->


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <div class="sidebar-heading">
        Pengurus RT/RW
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengurus" aria-expanded="true" aria-controls="collapsePengurus">
          <i class="fas fa-fw fa-cog"></i>
          <span>Usulan Rapat</span>
        </a>
        <div id="collapsePengurus" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url("admin/usul_pengurus");?>">Form Usulan Rapat</a>
          </div>
        </div>
      </li>
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
