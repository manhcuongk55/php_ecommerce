<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$id='';
	if(isset($_GET['id']))
		$id=(int)$_GET['id'];
	$obj->setActive($id);
	header('location:index.php?com='.COMS);
?>