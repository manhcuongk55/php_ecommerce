<?php
	defined("ISHOME") or die("Can't acess this page, please come back!");
	$id="0";
	if(isset($_GET["id"]))
		$id=$_GET["id"];
	$obj->getList(' WHERE `tem_id`='.$id );
	if($obj->Num_rows()>1)	
		$obj->setActive($id);
	echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
?>