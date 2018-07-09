<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	define('COMS','template');
	
	// Begin Toolbar
	include_once(LAG_PATH.'vi/lang_tem.php');
	include_once(libs_path.'cls.template.php');
	
	$objlang=new LANG_TEM;
	$obj=new CLS_TEMPLATE();
	
	$title_manager = $objlang->TEM_MANAGER;
	if(isset($_GET['task']) && $_GET['task']=='add')
		$title_manager = $objlang->TEM_MANAGER_ADD;
	if(isset($_GET['task']) && $_GET['task']=='edit')
		$title_manager = $objlang->TEM_MANAGER_EDIT;
		
	require_once('includes/toolbar.php');
	// End toolbar
	
	if(isset($_POST['cmdsave']))
	{
		$obj->Name=addslashes($_POST['txtname']);
		$obj->Author=addslashes($_POST['txtauthor']);
		$obj->Email=addslashes($_POST['txtemail']);
		$obj->Website=addslashes($_POST['txtwebsite']);
		$obj->Desc=addslashes($_POST['txtdesc']);
		$obj->isDefault=(int)$_POST['optactive'];
		if(isset($_POST['txtid'])){
			$obj->ID=(int)$_POST['txtid'];
			$obj->Update();
		}else{
			$obj->Add_new();
		}
		header('location:index.php?com='.COMS);
	}
	if(isset($_POST['txtaction']) && $_POST['txtaction']!='')
	{
		$ids=addslashes($_POST['txtids']);
		$ids=str_replace(',',"','",$ids);
		switch ($_POST['txtaction'])
		{
			case 'public': 		$obj->setActive($ids,1); 		break;
			case 'unpublic': 	$obj->setActive($ids,0); 		break;
			case 'edit':	
				$id=explode('','',$ids);
				header("location:index.php?com=".COMS."&task=edit&temid=".$id[0]);
				break;
			case 'delete': 		$obj->Delete($ids); 		break;
		}
		header('location:index.php?com='.COMS);
	}
	
	define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
	if(isset($_GET['task']))
		$task=$_GET['task'];
	if(!is_file(THIS_COM_PATH.'task/'.$task.'.php'))
		$task='list';
	include_once(THIS_COM_PATH.'task/'.$task.'.php');
	unset($obj);
	unset($objlang);
?>