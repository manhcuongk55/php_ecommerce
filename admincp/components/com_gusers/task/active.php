<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
	$id="";
	if(isset($_GET["id"]))
		$id=$_GET["id"];
	if(!isset($obj))
		$obj=new CLS_GUSER();
	$obj->setActive($id);
	header("location:index.php?com=".COMS);
?>