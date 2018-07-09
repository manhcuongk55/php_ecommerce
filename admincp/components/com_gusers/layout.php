<?php
	defined('ISHOME') or die("Can't acess this page, please come back!");
	define('COMS','gusers');

	// Begin Toolbar
	require_once(LAG_PATH.'vi/lang_default.php');
	require_once(libs_path.'cls.guser.php');
	
	if(!isset($objlag)) $objlag=new LANG_DEFAULT;
	
	$title_manager = 'Phân quyền nhóm người dùng';
	if(isset($_GET['task']) && $_GET['task']=='add')
		$title_manager = 'Thêm nhóm người dùng';
	if(isset($_GET['task']) && $_GET['task']=='edit')
		$title_manager = 'Sửa nhóm người dùng';
		
	require_once('includes/toolbar.php');
	// End toolbar
	
	$obj=new CLS_GUSER();
	if(isset($_POST['cmdsave']))
	{
		$obj->ParID=(int)$_POST['cbo_parid'];
		$obj->Name=addslashes($_POST['txtname']);
		
		$sContent=addslashes($_POST['txtdesc']);
		$obj->Intro=encodeHTML($sContent);
		
		$obj->isActive=$_POST['optactive'];
		if(isset($_POST['txtid'])){
			$obj->ID=(int)$_POST['txtid'];
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
			case "public": 		$obj->setActive($ids,1); 	break;
			case "unpublic": 	$obj->setActive($ids,0); 	break;
			case "edit": 	
				$id=explode("','",$ids);
				echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&task=edit&id=".$id[0]."'</script>";
				break;
			case "delete": 		$obj->Delete($ids); break;
		}
		echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
	}
	
define("THIS_COM_PATH",COM_PATH."com_".COMS."/");
if(isset($_GET["task"]))
	$task=$_GET["task"];
if(!is_file(THIS_COM_PATH.'task/'.$task.'.php'))
	$task='list';
include(THIS_COM_PATH.'task/'.$task.'.php'); 
	
unset($objlag);
unset($obj); 
?>