<?php
	defined("ISHOME") or die("Can't acess this page, please come back!");
	$id="0";
	if(isset($_GET["id"]))
		$id=$_GET["id"];
	$obj->Delete($id);
	echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
?>