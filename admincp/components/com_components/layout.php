<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	define('COMS','components');
	// Begin Toolbar
	require_once(LAG_PATH.'vi/lang_component.php');
	require_once(libs_path.'cls.component.php');
	
	$objlang=new LANG_COMPONENT;
	$obj=new CLS_COMS;
	
	$title_manager = $objlang->COMPONENT_MANAGER;
	if(isset($_GET['task']) && $_GET['task']=='add')
		$title_manager = $objlang->COMPONENT_MANAGER_ADD;
	if(isset($_GET['task']) && $_GET['task']=='edit')
		$title_manager = $objlang->COMPONENT_MANAGER_EDIT;
		
	require_once('includes/toolbar.php');
	// End toolbar
	// process form edit or addnew
	if(isset($_POST['cmdsave']))
	{
		$obj->Code=$_POST['txtcode'];
		$obj->Name=$_POST['txtname'];
		$obj->Desc=encodeHTML(addslashes($_POST['txtdesc']));
		$obj->Site=$_POST['cbo_site'];
		$obj->isActive=$_POST['optactive'];
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
	// process action toolbar
	if(isset($_POST['txtaction']) && $_POST['txtaction']!='')
	{
		$ids=$_POST['txtids'];
		$ids=str_replace(',',"','",$ids);
		switch ($_POST['txtaction'])
		{
			case 'public': 		$obj->setActive($ids,1); 		break;
			case 'unpublic': 	$obj->setActive($ids,0); 		break;
			case 'edit': 	
				$id=explode("','",$mnuids);
				echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&task=edit&comid=".$id[0]."'</script>";
				break;
			case 'delete': 		$obj->Delete($mnuids); 		break;
		}
		echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
	}
	// close object
	define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
	if(isset($_GET['task']))
		$task=$_GET['task'];
	if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
		$task='list';
	}
	include_once(THIS_COM_PATH.'task/'.$task.'.php');
	unset($task); unset($ids); unset($obj); unset($objlang);
?>