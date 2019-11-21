<?php $this->load->view('default/_partials/header');?>
<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-10 col-lg-12 col-md-9">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-6 d-none d-lg-block">
            <img src="<?= base_url('assets/foto/bandung.jpg');?>" class="col-lg-12 py-5">
          </div>
          <div class="col-lg-6">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
              </div>
              <?= form_open('c_autentikasi/login', ['id' => 'default-form', 'log' => 'Input Login']);?>
                <div class="form-group form-input">
                  <input type="text" class="form-control form-control-user" id="input-username_email" aria-describedby="emailHelp" placeholder="Username/Email" name="username_email">
                  <div class="invalid-feedback"></div>
                </div>
                <div class="form-group form-input">
                  <input type="password" class="form-control form-control-user" id="input-password" placeholder="Password" name="password">
                  <div class="invalid-feedback"></div>
                </div>
                <!-- <div class="form-group">
                  <div class="custom-control custom-checkbox small">
                    <input type="checkbox" class="custom-control-input" id="customCheck">
                    <label class="custom-control-label" for="customCheck">Remember Me</label>
                  </div>
                </div> -->
                <input type="submit" class="btn btn-primary btn-user btn-block" value="Submit">
                <hr>
                <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Login with Google
                </a>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                </a> -->
              <?= form_close();?>
              <!-- <hr> 
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div> -->
              <!-- <div class="px-3 pt-2 text-center">
                <?= $this->session->flashdata('login_gagal') ?>
                <?= $this->session->userdata('status');?>
            </div> -->
              <div class="text-center">
                <a class="small" href="<?= base_url('c_autentikasi/register');?>">Belum Punya Akun? Silahkan Registrasi!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>
<script src="<?= base_url('assets/bootstrap4admin/vendor/jquery/jquery.min.js');?>"></script>
<script src="<?= base_url('assets/sweetalert/sweetalert.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/main.js'); ?>"></script>
