<?php $this->load->view('admin/_partials/header');?>
<div class="wrapper">
    <?php $this->load->view('admin/_partials/sidebar');?>
    <?php $this->load->view('admin/_partials/navbar');?>
    <?php $this->load->view($content);?>
    <?php $this->load->view('admin/_partials/footbar');?>
    <?php $this->load->view('admin/_partials/scroll');?>
    <?php $this->load->view('admin/_partials/modal');?>
</div>
<?php $this->load->view('admin/_partials/footer');?>