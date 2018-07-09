<?php
session_start();
ini_set('display_errors',1);
include_once('../includes/gfinnit.php');
include_once('../libs/cls.mysql.php');
include_once('../libs/cls.saler.php');
$obj=new CLS_SALER;

if(isset($_POST['txt_user'])){
	if($_POST['txt_code']!=$_SESSION['SERCURITY_CODE']){
		echo 'ICORECT';
	}
	else{
		if($obj->LOGIN($_POST['txt_user'],$_POST['txt_pass']))
			echo 'Success';
		else
			echo 'Faile';
	}
}else{
	echo 'Faile';
}
?>