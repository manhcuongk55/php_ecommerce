<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	define('COMS','catalogs');

	// Begin Toolbar
	require_once(LAG_PATH.'vi/lang_catalogs.php');
	require_once(libs_path.'cls.catalogs.php');
	
	if(!isset($objlang)) $objlang = new LANG_CATALOGS;
	
	$title_manager = $objlang->CATE_MANAGER;
	if(isset($_GET['task']) && $_GET['task']=='add')
		$title_manager = $objlang->CATE_MANAGER_ADD;
	if(isset($_GET['task']) && $_GET['task']=='edit')
		$title_manager = $objlang->CATE_MANAGER_EDIT;
		
	require_once('includes/toolbar.php');
	// End toolbar
?>
<?php
	$obj = new CLS_CATALOGS();
	if (isset($_POST['cmdsave']))
	{
		$obj->ParID = (int)$_POST['cbo_cate'];
		$obj->Name = addslashes($_POST['txtname']);
		$sContent = addslashes($_POST['txtdesc']);
		$obj->Intro = encodeHTML($sContent);
		$obj->isActive = (int)$_POST['optactive'];

		$clsCat = $obj->getClassCatalog($obj->ParID);
		if ($clsCat == '') {
			$obj->Class = 'cat_red';
		} else {
			$obj->Class = $clsCat;
		}
		

		if (isset($_POST['txtid'])){
			$obj->ID = (int)$_POST['txtid'];
			$obj->Update();
		}else{
			
			$obj->Add_new();
		}
		echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&mess=U01'</script>";
	}
	if(isset($_POST["txtaction"]) && $_POST["txtaction"]!="")
	{
		$ids=trim($_POST["txtids"]);
		if($ids!='')
			$ids = substr($ids,0,strlen($ids)-1);
		$ids=str_replace(",","','",$ids);
		switch ($_POST["txtaction"]){
			case "public": 		$obj->setActive($ids,1); 		break;
			case "unpublic": 	$obj->setActive($ids,0); 		break;
			case "delete": 		$obj->Delete($ids); 			break;
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
	unset($task); unset($ids); unset($obj); unset($objlang);
?>