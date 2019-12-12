<?php $this->load->view('user/_partials/header');?>
<div class="wrapper">
    <?php $this->load->view('user/_partials/navbar');?>
    <?php $this->load->view($content);?>
    <?php $this->load->view('user/_partials/footbar');?>
</div>
<?php $this->load->view('user/_partials/footer');?>