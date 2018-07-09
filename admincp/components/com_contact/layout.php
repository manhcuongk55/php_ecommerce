<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	define('COMS','contact');
	// Begin Toolbar
	require_once(LAG_PATH.'vi/lang_category.php');
	require_once(libs_path.'cls.category.php');
	
	if(!isset($objlang)) $objlang = new LANG_CATEGORY;
	$title_manager = "QUẢN LÝ LIÊN HỆ";
	require_once('includes/toolbar.php');
?>
<?php
	include('libs/cls.contact.php');
	$obj = new CLS_CONTACT();
	
	if(isset($_POST["txtaction"]) && $_POST["txtaction"]!="")
	{
		$ids=trim($_POST["txtids"]);
		if($ids!='')
			$ids = substr($ids,0,strlen($ids)-1);
		$ids=str_replace(",","','",$ids);

		$obj->Delete($ids);
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