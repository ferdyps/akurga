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
        <a class="nav-link" href="<?php echo base_url("c_halaman_admin/index");?>">
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
        <a class="nav-link" href="<?= base_url('c_halaman_admin/konfirmasiDataWarga')?>">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Konfirmasi Data Warga</span></a>
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
            <a class="collapse-item" href="<?php echo base_url("c_halaman_admin/inputWarga");?>">Input Data Warga</a>
            <a class="collapse-item" href="<?= base_url('c_halaman_admin/tabelDataWarga')?>">Tabel Data Warga</a>
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
            <a class="collapse-item" href="<?php echo base_url();?>">Riwayat Surat Pengantar</a>
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
            <a class="collapse-item" href="<?= base_url('c_halaman_admin/inputHasilKomplain');?>">Input Hasil Komplain</a>
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
            <a class="collapse-item" href="<?php echo base_url("c_halaman_admin/formpengeluaran");?>">Form Pengeluaran</a>
            <a class="collapse-item" href="<?php echo base_url("c_halaman_admin/tabelpengeluaran");?>">Tabel Pengeluaran</a>
            <a class="collapse-item" href="<?php echo base_url("c_halaman_admin/formpemasukan");?>">Form Pemasukan</a>
            <a class="collapse-item" href="<?php echo base_url("c_halaman_admin/tabelpemasukan");?>">Tabel Pemasukan</a>
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
            <a class="collapse-item" href="<?php echo base_url("c_halaman_admin/inputrapat");?>">Input Surat Rapat</a>
            <a class="collapse-item" href="<?php echo base_url("c_halaman_admin/inputkegiatan");?>">Input Surat Kegiatan</a>
            <a class="collapse-item" href="cards.html">List Data Warga</a>
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
            <a class="collapse-item" href="<?php echo base_url("c_halaman_admin/inputnotulensi");?>">Input Notulensi Rapat</a>
            <a class="collapse-item" href="cards.html">List Data Warga</a>
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
            <a class="collapse-item" href="<?php echo base_url("c_halaman_admin/input_arsipsurat");?>">Input Surat Masuk</a>
            <a class="collapse-item" href="cards.html">List Data Warga</a>
          </div>
        </div>
      </li>

      <!-- ================================ END OF SEKRETARIS ========================================== -->


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
