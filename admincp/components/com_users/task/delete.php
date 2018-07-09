<?php
	defined("ISHOME") or die("Can't acess this page, please come back!");
	$id="";
	if(isset($_GET["id"]))
		$id=(int)$_GET["id"];
	if($obj->isAdmin()==true) {
		$obj->Delete($id);
	}
	header("location:index.php?com=".COMS);
?>