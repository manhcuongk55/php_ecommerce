<?php
session_start();
ini_set('display_errors',1);
include_once('../includes/gfinnit.php');
include_once('../libs/cls.mysql.php');
include_once('../libs/cls.comment.php');
$obj=new CLS_COMM;
if(isset($_POST['txt_content'])){
	if(isset($_POST['txt_par'])){
		$obj->Parid=$_POST['txt_par'];
	}
	$obj->Pro_id=$_POST['txt_pro'];
	$obj->Mess=$_POST['txt_content'];
	$obj->Name=$_POST['txt_name'];
	$obj->Email=$_POST['txt_email'];
	$_SESSION['NAME_COMMENT']=$_POST['txt_name'];
	$_SESSION['EMAIL_COMMENT']=$_POST['txt_email'];
	$obj->Joindate=date('Y-m-d h:i:s');
	$obj->isActive=0;
	$obj->Add_New();
	echo 'Success';
}else{
	echo 'Faile';
}
?>