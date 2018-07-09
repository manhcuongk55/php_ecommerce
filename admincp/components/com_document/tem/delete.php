<?php
	defined("ISHOME") or die("Can't acess this page, please come back!");
	$id="";
	if(isset($_GET["id"]))
		$id=$_GET["id"];
	
	$objcate=new CLS_DOCUMENT();
	
	//kiem tra xem còn thu muc hoặc tep tin bcon khong. neu co, yeu cau xoa truoc khi xoa muc nay
	if($objcate->haveChild($id)==0) {
		$objcate->Delete($id,HOST_URL);
		header("location:index.php?com=".COMS."&err=delsuccess");
	}
	else 
		header("location:index.php?com=".COMS."&err=notdel");
	
?>