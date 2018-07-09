<?php
	$MOD='catalog';
	$obj=new CLS_MODULE;
	$obj->getList('AND `tbl_modules`.`mod_id`='.$rows["mod_id"],0);
	$r=$obj->Fetch_Assoc();
	$theme = 'brow1';
	if($r['theme']!='') 
		$theme=$r['theme'];
?>