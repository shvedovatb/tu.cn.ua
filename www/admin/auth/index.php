<?php
define('TU', TRUE);
session_start();

include $_SERVER['DOCUMENT_ROOT'].'/config.php';

if(!$_SESSION['auth']['admin']){
    header("Location: " .PATH. "admin/auth/enter.php");
    exit;
}else{
    header("Location: " .PATH. "admin/");
    exit;
}