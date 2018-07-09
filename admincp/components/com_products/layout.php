<?php
	defined("ISHOME") or die("Can not acess this page, please come back!");
	define("COMS","products");
	define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
	// Begin Toolbar
	require_once(LAG_PATH."vi/lang_products.php");
	require_once(libs_path.'cls.products.php');
	require_once(libs_path.'cls.catalogs.php');

	$objlang = new LANG_PRODUCTS;
	$obj = new CLS_PRODUCTS;
	$objCat = new CLS_CATALOGS;

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
		$obj->isShow = addslashes($_POST["optShow"]);
		$obj->folder = addslashes($_POST["txtFolder"]);
		$obj->Class = $objCat->getClassCatalog($obj->CatID);
		$obj->isConfigPro = $_POST['optConfigPro'];
		// echo $obj->Class; die;

		if ($obj->folder != null || $obj->folder != '') {
			$path = $_SERVER['DOCUMENT_ROOT'].'/demo/pic/zoom3d/'.$obj->folder;
			if (!file_exists($path)) {
				mkdir($path, 0777, true);
			}
		}
				
		if(isset($_POST['array_cf']) && $obj->isConfigPro == 1 && !is_null($_POST['array_cf'])) {
			$json = $_POST['array_cf'];
			$str = '';
			for ($i=0; $i < count($json); $i++) { 
				$str.= $json[$i].'!@';
			}
			$obj->Config = substr($str, 0, strlen($str)-2);
		}
					
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

		////////////////////////////////////////////////////
		$j = 0;     // Variable for indexing uploaded image.
		$strImg = "";
		// var_dump($_FILES['file']['name'][1]);
		for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
			// die;
			$target_path = "uploads/";  
			// Loop to get individual element from the array
			$validextensions = array("jpeg", "jpg", "png", "gif", "JPEG", "JPG", "PNG", "GIF");      // Extensions which are allowed.
			var_dump($_FILES['file']['name']);
			$ext = explode('.', basename($_FILES['file']['name'][$i]));   // Explode file name from dot(.)
			$file_extension = end($ext); // Store extensions in the variable.
			// $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];     // Set the target path with a new name of image.
			$marT = array(' ','	',',','@','!','#');
			$marRP = array('','','-','','','');
			$fileName = str_replace($marT, $marRP, $_FILES['file']['name'][$i]);
			$target_path = $target_path . $fileName;

			$j = $j + 1;      // Increment the number of uploaded images according to the files in array.
			// ($_FILES["file"]["size"][$i] < 100000)     // Approx. 100kb files can be uploaded.
			if (in_array($file_extension, $validextensions)) {
				if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {
					$strImg .= $target_path.'@';
					// If file moved to uploads folder.
				} else {     //  If File Was Not Moved.
					echo $j. ').<span id="error">please try again!.</span><br/><br/>';
				}
			} else {     //   If File Size And File Type Was Incorrect.
				echo $j. ').<span id="error">Invalid file Size or Type</span><br/><br/>';
			}
		}
		////////////////////////////////////////////////////////
		
		// echo $obj->isConfigPro;
		// die;
		
		$obj->Order=addslashes($_POST["txt_order"]);
		$obj->MKey=	addslashes($_POST["txtmetakey"]);
		$obj->MDesc=addslashes($_POST["textmetadesc"]);
		
		$obj->isHot=	(int)$_POST["opt_hot"];
		$obj->isActive=	(int)$_POST["optactive"];

		if(isset($_POST["txtid"])){
			$obj->ID=(int)$_POST["txtid"];
			if (isset($_POST['strFile'])) {
				$aryOldFile = $_POST['strFile'];
				for ($i=0; $i < count($aryOldFile); $i++) { 
					$strImg .= $aryOldFile[$i].'@';
				}	
			}

			$obj->imgSlide = substr($strImg, 0, strlen($strImg)-1);
			// echo $obj->imgSlide; die;
			$idNew = $obj->Update();
		}else{
			$obj->imgSlide = substr($strImg, 0, strlen($strImg)-1);
			$idNew = $obj->Add_new();
		}

		// die;
		if($obj->isShow == 0 && isset($_POST['isPageEdit'])) {
			echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&task=edit&id=".$idNew."'</script>";
		} else {
			echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
		}
		
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