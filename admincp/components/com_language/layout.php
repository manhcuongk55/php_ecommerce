<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	define('COMS','language');
	include_once(LAG_PATH.'vi/lang_language.php');
	include_once(libs_path.'cls.language.php');
	$obj=new CLS_LANGUAGE;
	$objlang=new LANG_LANGUAGE;
	// Begin Toolbar
	$title_manager=$objlang->LANGUAGE_MANAGER;
	if(isset($_GET['task']) && $_GET['task']=='add')
		$title_manager = $objlang->LANGUAGE_MANAGER_ADD;
	if(isset($_GET['task']) && $_GET['task']=='edit')
		$title_manager = $objlang->LANGUAGE_MANAGER_EDIT;
	require_once('includes/toolbar.php');
	// End toolbar
	if(isset($_POST['cmdsave']))
	{
		$obj->_Code=addslashes(trim($_POST['txtcode']));
		$obj->_Name=addslashes($_POST['txtname']);
		$obj->_Flag=addslashes($_POST['txtflag']);
		$obj->_Site=addslashes($_POST['optsite']);
		$obj->isActive=(int)$_POST['optactive'];
		
		if(isset($_POST['txtid'])){
			$obj->ID=(int)$_POST['txtid'];
			$obj->Update();
		}else{
			$obj->Add_new();
		}
		echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
	}
	if(isset($_POST['txtaction']) && $_POST['txtaction']!='')
	{
		$ids=$_POST['txtids'];
		$ids=str_replace(',',"','",$ids);
		echo $ids;
		switch ($_POST['txtaction'])
		{
			case 'public': 		$obj->setActive($ids,1); 		break;
			case 'unpublic': 	$obj->setActive($ids,0); 		break;
			case 'edit': 	
				$id=explode("','",$ids);
				echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&task=edit&id=".$id[0]."'</script>";
				
				break;
			case 'delete': 		$obj->Delete($ids); 			break;
		}
		echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
	}
	
	define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
	if(isset($_GET['task']))
		$task=$_GET['task'];
	if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
		$task='list';
	}
	include_once(THIS_COM_PATH.'task/'.$task.'.php');
	// close object
	unset($obj);
?>