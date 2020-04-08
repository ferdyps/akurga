<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $title; ?></title>

  <!-- Font Awesome Icons -->
  <link href="<?php echo base_url('assets/user/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="<?php echo base_url('assets/user/vendor/magnific-popup/magnific-popup.css');?>" rel="stylesheet">

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="<?php echo base_url('assets/user/css/creative.min.css');?>" rel="stylesheet">
  <link rel="stylesheet" href="<?= config_item('asset_url') . 'pickadate.js-3.6.2/themes/classic.css'; ?>">
  <link rel="stylesheet" href="<?= config_item('asset_url') . 'pickadate.js-3.6.2/themes/classic.date.css'; ?>">
  <link rel="stylesheet" href="<?= config_item('asset_url') . 'pickadate.js-3.6.2/themes/classic.time.css'; ?>">

  <link rel="stylesheet" href="<?= config_item('asset_url') . 'css/main.css'; ?>">
  <?php $this->load->view('user/_partials/js_core');?>

  <style>
    .notulensi-text{
      color: #000000;
    }
  </style>
</head>
