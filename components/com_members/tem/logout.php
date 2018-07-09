<?php
session_start();
ini_set('display_errors',1);
include_once('../includes/gfinnit.php');
include_once('../libs/cls.mysql.php');
include_once('../libs/cls.saler.php');
$objsaler=new CLS_SALER;
$objsaler->LOGOUT();
header('location:http://muathu7.vn/trang-chu.html');
?>