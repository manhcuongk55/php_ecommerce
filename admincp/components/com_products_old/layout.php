<?php
	defined("ISHOME") or die("Can not acess this page, please come back!");
	define("COMS","products");
	define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
	// Begin Toolbar
	require_once(LAG_PATH."vi/lang_products.php");
	require_once(libs_path.'cls.products.php');
	require_once(libs_path.'cls.catalogs.php');

	$objlang=new LANG_PRODUCTS;
	$obj=new CLS_PRODUCTS;
	
	$title_manager=$objlang->CONTENT_MANAGER;
	if(isset($_GET["task"]) && $_GET["task"]=="add")
		$title_manager = $objlang->CONTENT_MANAGER_ADD;
	if(isset($_GET["task"]) && $_GET["task"]=="edit")
		$title_manager = $objlang->CONTENT_MANAGER_EDIT;
		
	require_once("includes/toolbar.php");
	// End toolbar
		
	if(isset($_POST["cmdsave"])){
		$obj->CatID = (int)$_POST["cbo_cate"];
		$obj->Code = addslashes(un_unicode($_POST["txtcode"]));
		$obj->Name = addslashes($_POST["txttitle"]);
		$obj->Intro = addslashes($_POST["txtintro"]);
		$obj->Fulltext =	addslashes($_POST['txtfulltext']);
		$obj->Thumb = addslashes($_POST["txtthumb"]);
		$obj->Old_price = addslashes($_POST["txt_oldprice"]);
		$obj->Cur_price = addslashes($_POST["txt_curprice"]);
		$obj->Quantity = addslashes($_POST["txt_quantity"]);
		
		if(isset($_POST['array_cf'])) {
			$json = json_encode($_POST['array_cf'], JSON_UNESCAPED_UNICODE);		
			$obj->Config = $json;	
		}		

		$obj->Class = $obj->getClass($obj->CatID);
					
		if(isset($_POST["txtcreadate"])){
			$txtjoindate=trim($_POST["txtcreadate"]);
			$joindate = mktime(0,0,0,substr($txtjoindate,3,2),substr($txtjoindate,0,2),substr($txtjoindate,6,4));
			$obj->Cdate = date("Y-m-d",$joindate);
		}
		
		if(isset($_POST["txtmodify"])) {
			$txtjoindate2=trim($_POST["txtmodify"]);
			$joindate2 = mktime(0,0,0,substr($txtjoindate2,3,2),substr($txtjoindate2,0,2),substr($txtjoindate2,6,4));
			$obj->Mdate = date("Y-m-d",$joindate2);
		}
		
		$obj->Order=addslashes($_POST["txt_order"]);
		$obj->MKey=	addslashes($_POST["txtmetakey"]);
		$obj->MDesc=addslashes($_POST["textmetadesc"]);
		
		$obj->isHot=	(int)$_POST["opt_hot"];
		$obj->isActive=	(int)$_POST["optactive"];
		if(isset($_POST["txtid"])){
			$obj->ID=(int)$_POST["txtid"];
			$obj->Update();
		}else{
			$obj->Add_new();
		}
		echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
	}
	if(isset($_POST["txtaction"]) && $_POST["txtaction"]!="")
	{
		$ids=$_POST["txtids"];
		$ids=str_replace(",","','",$ids);
		switch ($_POST["txtaction"])
		{
			case "public": 		$obj->setActive($ids,1); 		break;
			case "unpublic": 	$obj->setActive($ids,0); 		break;
			case "edit": 	
				$id=explode("','",$ids);
				echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&task=edit&id=".$id[0]."'</script>";
				exit();
				break;
			case "order"	: include(THIS_COM_PATH."tem/order.php"); break;	
			case "delete": 		$obj->Delete($ids); 		break;
		}
		echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
	}
	
	if(isset($_GET['task']))
		$task=$_GET['task'];
	if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
		$task='list';
	}
	include_once(THIS_COM_PATH.'task/'.$task.'.php');
	
	unset($obj); unset($task);	unset($objlang); unset($ids);
?>