<div id="wrapper">
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
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
        Ketua RT
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKetuaRT" aria-expanded="true" aria-controls="collapseKetuaRT">
          <i class="fas fa-fw fa-cog"></i>
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
            <a class="collapse-item" href="cards.html">Tabel Pemasukan</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSekretaris" aria-expanded="true" aria-controls="collapseSekretaris">
          <i class="fas fa-fw fa-cog"></i>
          <span>Sekretaris</span>
        </a>
        <div id="collapseSekretaris" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url("c_halaman_admin/inputrapat");?>">Input Rapat</a>
            <a class="collapse-item" href="cards.html">List Data Warga</a>
          </div>
        </div>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Addons
      </div>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
