<?php
	defined("ISHOME") or die("Can not acess this page, please come back!");
	define("COMS","orders");
	define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
	// Begin Toolbar
	require_once(LAG_PATH."vi/lang_products.php");
	require_once(libs_path.'cls.catalogs.php');
	require_once(libs_path.'cls.products.php');
	require_once(libs_path.'cls.orders.php');

	$obj=new CLS_ORDER;
	$task="";
	$title_manager="Quản lý đơn hàng";
	if(isset($_GET["task"]) && $_GET["task"]=="add")
		$title_manager = "";
	if(isset($_GET["task"]) && $_GET["task"]=="edit")
		$title_manager = "Cập nhập đơn hàng";
	if(isset($_GET['task']))
		$task=$_GET['task'];
	if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
		$task='list';
	}
	include_once(THIS_COM_PATH.'task/'.$task.'.php');
	
	unset($obj); unset($task);	unset($objlang); unset($ids);
?>