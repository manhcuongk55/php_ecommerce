<?php
	defined("ISHOME") or die("Can't acess this page, please come back!");
	$id="0";
	if(isset($_GET["id"]))
		$id=$_GET["id"];
	$obj->setDefault($id,$_SESSION['SITE']);
	echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
?>