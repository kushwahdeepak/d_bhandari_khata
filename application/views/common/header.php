<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <base href="<?php echo base_url(); ?>"/>

  <!-- <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/images/logo.png"> -->

  <title>Bhandari</title>
  
  <script src="https://code.jquery.com/jquery-1.11.1.min.js" integrity="sha256-VAvG3sHdS5LqTT+5A/aeq/bZGa/Uj04xKxY8KM/w9EE=" crossorigin="anonymous"></script>

    <?php
    /* getting this meta data from karyon_config.php file which is under application > config folder */
    foreach ($meta_data as $name => $content) {
        if (!empty($content))
            echo "<meta name='$name' content='$content'>";
    }

    /* getting this stylesheets from karyon_config.php file which is under application > config folder */
    foreach ($stylesheets as $media => $files) {
        foreach ($files as $file) {
            echo "<link href='$file' rel='stylesheet'>";
        }
    }

    /* getting this scripts from karyon_config.php file which is under application > config folder */
    foreach ($scripts['head'] as $file) {
        echo "<script src='$file'></script>";
    }
    ?>

  <style type="text/css">
    .heading_h4{
      font-weight: 600;
      font-size: 22px !important;
    }
    .modal-dialog {
      width: 760px;
      margin: 30px auto;
    }
    .smily_active {
      cursor: pointer;
      margin: 2px 2px;
      width: 20px;
    }
    .brown_color{
      color: #d07755;
    }
    .error{
      color: red;
      font-weight: 500;
    }
    .btn-prmary-background {
      background-color: #5099d7 !important;
    }
    .font_bold{
      font-weight: bold;
    }
    .file {
      visibility: hidden;
      position: absolute;
    }
    .sorting_disabled {
      padding-right: 10px !important;
    }
    .loan-class .input-group-custom {
      float: left !important;
      padding-right: 15px !important;
      padding-left: 15px !important;
    }
    .loan-class .input-group-button {
      margin-top: 25px
    }
    .loan-class .input-group-button-custom {
      /*margin-top: 0px !important;*/
    }    
    .loan-class .table > thead > tr > th, .loan-class .table > tbody > tr > td {
      padding: 1px 8px !important;
    }
    .error-custom {
      position: absolute;
      top: 60px;
      left: 15px;
    }
    .input-group .error {
        margin-bottom: 33px !important;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
    }

    input[type=number] {
        -moz-appearance:textfield; /* Firefox */
    }

    .customGold { background: gold;border-radius: 13px;padding: 9px 0px;display: inline-block; margin-bottom: 15px; width: 100%; }
    .customSilver { background: silver;border-radius: 13px;padding: 9px 0px;display: inline-block; margin-bottom: 15px; width: 100%; }

    input[type="date"].form-control, input[type="time"].form-control, input[type="datetime-local"].form-control, input[type="month"].form-control {
        line-height: 20px;
    }

  </style>
    <input type="hidden" id="site_url_path_for_external_js" name="site_url_path_for_external_js" value="<?php echo site_url(); ?>">
</head>
