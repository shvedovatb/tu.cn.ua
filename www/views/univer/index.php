<?php defined('TU') or die('Access denied'); ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include_once'inc/head.php' ?>    
  </head>
  <body>   
  <div class="header">
  <?php include_once 'inc/header.php'; ?>
  </div>
  <div class="wrapper">
  <?php include_once 'inc/main_menu.php'; ?>  
  <?php include $view.'.php'; ?>      
  </div>
  <div class="footer">
 <?php include_once 'inc/footer.php'; ?>
  </div>
  <?php include_once 'inc/modal_window.php'; ?>
  </body>
  </html>