<?php
	defined('ISHOME') or die("Can't acess this page, please come back!");
	define('COMS','module');
	// Begin Toolbar
	include_once(LAG_PATH.'vi/lang_module.php');
	include_once(libs_path.'cls.module.php');
	include_once(libs_path.'cls.category.php');
	include_once(libs_path.'cls.menuitem.php');
	
	$obj=new CLS_MODULE();
	$objlag=new LANG_MODULE;
	
	$title_manager = $objlag->MODULE_MANAGER;
	if(isset($_GET['task']) && $_GET['task']=='add')
		$title_manager = $objlag->MODULE_MANAGER_ADD;
	if(isset($_GET['task']) && $_GET['task']=='edit')
		$title_manager = $objlag->MODULE_MANAGER_EDIT;
		
	require_once('includes/toolbar.php');
	// End toolbar
	if(isset($_POST['cmdsave']))
	{
		$obj->Title=addslashes($_POST['txttitle']);
		$obj->Type=addslashes($_POST['cbo_type']);
		$obj->ViewTitle=(int)$_POST['optviewtitle'];
		if(isset($_POST['cbo_menutype'])) 	$obj->MnuID=(int)$_POST['cbo_menutype'];
		if(isset($_POST['cbo_theme'])) 		$obj->Theme=addslashes($_POST['cbo_theme']);
		if(isset($_POST['cbo_cate'])) 			$obj->CatID=(int)$_POST['cbo_cate'];
		if(isset($_POST['txtcontent'])) 			$obj->HTML=addslashes($_POST['txtcontent']);
		$obj->Position=addslashes($_POST['cbo_position']);
		$obj->Mnuids=addslashes($_POST['txtmenus']);
		$obj->Class=addslashes($_POST['txtclass']);
		$obj->isActive=(int)$_POST['optactive'];
		
		if(isset($_POST['txtid'])){
			$obj->ID=(int)$_POST['txtid'];
			$obj->Update();
		}else{
			$obj->Add_new();
		}
		?>
		<script language="javascript">window.location='index.php?com=<?php echo COMS;?>'</script>
		<?php
	}
	if(isset($_POST['txtaction']) && $_POST['txtaction']!=''){
		$ids=$_POST['txtids'];
		$ids=str_replace(',',"','",$ids);
		switch ($_POST['txtaction']){
			case 'public': 		$obj->setActive($ids,1); 		break;
			case 'unpublic': 	$obj->setActive($ids,0); 		break;
			case 'order': 		$obj->Order($ids,$sls); 	break;
			case "delete": 		$obj->Delete($ids); 			break;
		}
		?>
		<script language="javascript">window.location='index.php?com=<?php echo COMS;?>'</script>
		<?php
	}
	define("THIS_COM_PATH",COM_PATH."com_".COMS."/");
	if(isset($_GET['task']))
		$task=$_GET['task'];
	if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
		$task='list';
	}
	include_once(THIS_COM_PATH.'task/'.$task.'.php');
	unset($task);	unset($ids);	unset($obj);	unset($objlag);
?>