<?php
include_once(libs_path.'cls.catalogs.php');
include_once(libs_path.'cls.products.php');
$objcat=new CLS_CATALOGS;
$objcat->getListCategory();
unset($objcat);
?>