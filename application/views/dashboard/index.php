<?php $this->load->view('dashboard/_partials/header');?>
<div class="wrapper">
    <?php $this->load->view('dashboard/_partials/navbar');?>
    <?php $this->load->view($content);?>
    <?php $this->load->view('dashboard/_partials/footbar');?>
</div>
<?php $this->load->view('dashboard/_partials/footer');?>