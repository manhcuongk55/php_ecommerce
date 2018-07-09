<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
	$id="";
	if(isset($_GET["id"]))
		$id=$_GET["id"];
	if(!isset($objcat))
		$objcat=new CLS_DOCUMENT();
	$objcat->ActiveOnce($id);
	header("location:index.php?com=".COMS);
?>