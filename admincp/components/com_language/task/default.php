<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
	$id='';
	if(isset($_GET['id'])) $id=(int)$_GET['id'];
	$obj->setDefault($id,$_SESSION['ACTION_SITE']);
	header('location:index.php?com='.COMS);
?>