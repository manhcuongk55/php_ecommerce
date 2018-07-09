<?php
	defined("ISHOME") or die("Can't acess this page, please come back!");
	define("COMS","comments");
	// define("THIS_COM_PATH",COM_PATH."com_".COMS."/");
	// Begin Toolbar
	require_once(LAG_PATH."vi/lang_comments.php");
	require_once(libs_path."cls.comment.php");
	$obj=new CLS_COMM();
	$objlang = new LANG_COMMENTS;
	
	$title_manager = $objlang->COMMENT_MANAGER;
	if(isset($_GET["task"]) && $_GET["task"]=="add")
		$title_manager = $objlang->COMMENT_MANAGER_ADD;
	if(isset($_GET["task"]) && $_GET["task"]=="edit")
		$title_manager = $objlang->COMMENT_MANAGER_EDIT;
		
	require_once("includes/toolbar.php");
	// End toolbar
	if(isset($_POST['cmdsave']))
	{
		$obj->username=$_POST["txtname"];
		$obj->Thumb=$_POST["txtthumb"];
		$obj->Content=encodeHTML(addslashes($_POST["txtdesc"]));
		
		$obj->isactive=$_POST["optactive"];
		if(isset($_POST["txtid"]))
		$obj->comm_id=$_POST["txtid"];
		if(isset($_POST['txtid'])){
			$obj->comm_id=(int)$_POST['txtid'];
			$obj->Update();
		}else{
			$obj->Add_new();
		}
		?>
		<script language="javascript">window.location='index.php?com=<?php echo COMS;?>'</script>
		<?php
	}
	if(isset($_POST["txtaction"]) && $_POST["txtaction"]!="")
	{
		$ids=trim($_POST["txtids"]);
		if($ids!='')
			$ids = substr($ids,0,strlen($ids)-1);
		$ids=str_replace(",","','",$ids);
		switch($_POST["txtaction"]){
			case "public": 		$obj->setActive($ids,1); 	break;
			case "unpublic": 	$obj->setActive($ids,0); 	break;
			case "delete": 		$obj->Delete($ids); 		break;
		}
		echo "<script language=\"javascript\">window.locommion='index.php?com=".COMS."'</script>";
	}
	define("THIS_COM_PATH",COM_PATH."com_".COMS."/");
	if(isset($_GET['task']))
		$task=$_GET['task'];
	if(!is_file(THIS_COM_PATH.'tem/'.$task.'.php')){
		$task='list';
	}
	include_once(THIS_COM_PATH.'tem/'.$task.'.php');
	unset($task); unset($ids); unset($obj); unset($objlag);
?>
