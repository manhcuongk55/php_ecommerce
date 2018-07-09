<?php
$proId = '';
$aryConfig = '';
$name = '';
$sdt = '';
$add = '';
$note = '';

if(isset($_POST['pro_id'])) {
	$proId = $_POST['pro_id'];
} 
if(isset($_POST['ary_config'])) {
	$ary = $_POST['ary_config'];
	for ($i=0; $i < count($ary); $i++) { 
		$aryConfig .= $ary[$i].'!@';	
	}
	$aryConfig = substr($aryConfig, 0, strlen($aryConfig)-2);
}

if(isset($_POST['txt_name_cus'])) {
	$name = $_POST['txt_name_cus'];
}
if(isset($_POST['txt_sdt_cus'])) {
	$sdt = $_POST['txt_sdt_cus'];
}
if(isset($_POST['txt_add_cus'])) {
	$add = $_POST['txt_add_cus'];
}
if(isset($_POST['txt_note'])) {
	$note = $_POST['txt_note'];
}

include_once('libs/cls.orders.php');
	$obj = new CLS_ORDER;
	$obj->Cdate = date('Y-m-d h:i:s');
	$obj->ProId = $proId;
	$obj->Cname = $name;
	$obj->Cphone = $sdt;
	$obj->Add = $add;
	$obj->Config = $aryConfig;
	$obj->Note = $note;
	$obj->Add_new();

	echo "<script language=\"javascript\">window.location='index.php?com=members&viewtype=success'</script>";

?>