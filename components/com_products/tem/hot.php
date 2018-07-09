<?php
include_once(libs_path.'cls.products.php');
$obj=new CLS_PRODUCTS();
	$obj->GetHotPro("  ",' ORDER BY `mdate` DESC '," LIMIT 0,5");
?>