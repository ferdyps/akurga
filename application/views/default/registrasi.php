<?php $this->load->view('default/_partials/header');?>
<div class="container">
<!-- Outer Row -->
<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block">
            <img src="<?= base_url('assets/foto/bandung.jpg');?>" class="col-lg-12 py-5">
          </div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <?= form_open('c_autentikasi/insert_register');?>
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="exampleInputNIK" placeholder="Nomor Induk Kependudukan" name="nik">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="exampleInputUsername" placeholder="Username" name="username">
                  </div>
                  <div class="col-sm-6">
                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email" name='email'>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="exampleKonfirmasiPassword" placeholder="Konfirmasi Password" name="konfirmasi_password">
                  </div>
                </div>
                <input type="submit" class="btn btn-primary btn-user btn-block" value="Register Akun">
                <hr>
                <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a> -->
              <?= form_close();?>
              <!-- <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div> -->
              <div class="text-center">
                <a class="small" href="<?= base_url('c_autentikasi/');?>">Sudah Punya Akun? Silahkan Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
