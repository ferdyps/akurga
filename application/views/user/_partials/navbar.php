<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="<?= base_url('user/index')?>">AKURGA</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('user/formSuratPengantar')?>">Surat Pengantar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('user/riwayatSuratPengantar')?>">Riwayat Surat Pengantar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('user/formKomplain')?>">Komplain</a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('user/riwayatKomplain')?>">Riwayat Pengajuan Komplain</a>
          </li> 
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="<?= base_url()?>">Notulensi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" onclick="return confirm('Apakah anda yakin untuk logout..?');" href="<?= site_url('auth/logout')?>">Logout</a>
          </li>
         
        </ul>
      </div>
    </div>
  </nav>