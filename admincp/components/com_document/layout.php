<?php
	defined("ISHOME") or die("Can't acess this page, please come back!");
	define("COMS","document");
	include_once ("libs/cls.document.php");
?>

  <div id="menus" class="toolbars">
	  <form id="frm_menu" name="frm_menu" method="post" action="">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td><h2 style="margin:0px; padding:0px;">Quản lý tài liệu</h2></td>
			<td>
            <label>
			  <input type="hidden" name="txtids" id="txtids" />
			  <input type="hidden" name="txtaction" id="txtaction" />
			</label>
            </td>
			<td align="right">
			<ul>
			<?php 
				$task="";
				if(!isset($_GET["task"])){
			?>
                <li><a class="addnew_folder" href="?com=<?php echo COMS;?>&task=addfolder" title="Tạo thư mục mới">Tạo thư mục mới</a></li>
                <li><a class="addnew_file" href="?com=<?php echo COMS;?>&task=addfile" title="Tạo tệp tin mới mới">Tạo tệp tin mới mới</a></li>
                <?php 
				}
				else
				{?>
                <li><a class="save"  href="#" onclick="dosubmitAction('frm_action','save');" title="<?php echo MSAVE;?>"><?php echo MSAVE;?></a></li>
                <li><a class="close"  href="index.php?com=<?php echo COMS;?>" title="<?php echo MCLOSE;?>"><?php echo MCLOSE;?></a></li>
                <li><a class="help"  href="index.php?com=<?php echo COMS;?>&task=help" title="<?php echo MHELP;?>"><?php echo MHELP;?></a></li>
			<?php } ?>
            </ul>
			</td>
		  </tr>
		</table>
	  </form>
	</div>
<?php
	$err='';
	$obj=new CLS_DOCUMENT();
	if(isset($_POST["txttask"]) && $_POST["txttask"]==1)
	{
		$obj->ParID	= $_POST["cbo_cate"];
		$obj->Code	= addslashes($_POST["txtcode"]);
		$obj->Name	=addslashes( $_POST["txtname"]);
		$obj->Loai=1;
		$obj->Type='';
		$obj->Author = $_SESSION["IGFUSERNAME"];
		$obj->CreateDate = date("m-d-Y");
		
		$obj->isActive=$_POST["optactive"];
		if(isset($_POST["txtid"]))
		$obj->ID=$_POST["txtid"];
		
		$sContent=addslashes($_POST['txtdesc']);
		$obj->Intro=encodeHTML($sContent);
		
		$obj->Urlfile="tailieu/";
		if($_POST["txtfolder"]==1 && $_POST["cbo_cate"]!=0) {
			$obj->Urlfile=$obj->getURL($_POST["cbo_cate"]);
		}
		$urlfolder = "../".$obj->Urlfile.$_POST["txtcode"];
		
		// kiem tra da ton tai ten file nay chua, truoc khi insert
		if($obj->ID=="-1")
		{
			$exist = $obj->getCode($obj->Code);
			if($exist>0)
				echo '<script language="javascript">window.location="index.php?com='.COMS.'&task=addfolder&err=exist"</script>';
		}
		
		if(!file_exists($urlfolder)) {
			if(mkdir($urlfolder, 0777)) {
				echo '<script language="javascript">window.location="index.php?com='.COMS.'&err=foldersuccess"</script>';
				//chmod($urlfolder, 0777);
			}

		}
		
		if($obj->ID=="-1")
		{
			if($exist==0) $obj->Add_new();
			echo '<script language="javascript">window.location="index.php?com='.COMS.'&err=addfol_success"</script>';
		}
		else {
			if($obj->Update()==true) 
				echo '<script language="javascript">window.location="index.php?com='.COMS.'&err=editfol_success"</script>';

		}
		//header("location:index.php?com=".COMS);
	}
	
	if(isset($_POST["txttaskfile"]) && $_POST["txttaskfile"]==1)
	{
		//print_r($_POST);
		//print_r ($_FILES);
		
		if(isset($_POST["txtid"]))
			$obj->ID=$_POST["txtid"];
			
		$obj->ParID=$_POST["cbo_cate"];
		$obj->Name=addslashes(trim($_POST["txtname"]));
		
		$obj->Assign=$_POST["txtguser"];
		
		$sContent=trim($_POST['txtdesc']);
		$obj->Intro=addslashes(encodeHTML($sContent));
		
		$obj->Author = $_SESSION["UUSERLOGIN"];
		$obj->CreateDate = date("m-d-Y");
		
		$obj->isActive=$_POST["optactive"];
		
		
		if($_POST["txtlinkweb"]!='') {
			$obj->Outsite=$_POST["txtlinkweb"];
		}
		else 
		{
		
			$filename = $_FILES["txturlfile"]["name"];
			$filetype = $_FILES["txturlfile"]["type"];
			$tmpfile  = $_FILES["txturlfile"]["tmp_name"];
			$filesize = $_FILES["txturlfile"]["size"];
			
			$obj->Type=$filetype;
			$obj->FileSize=$filesize;
			$obj->Code= $filename;
			$obj->Outsite='';

			$obj->Urlfile="tailieu/";
			if($_POST["txtfolder"]==0 && $_POST["cbo_cate"]!=0) 
				$obj->Urlfile=$obj->getURL($_POST["cbo_cate"]);
			
			// kiem tra da ton tai ten file nay chua truoc khi insert
			if($obj->ID=="-1")
			{
				$exist = $obj->getCode($obj->Code);
				if($exist>0)
					echo '<script language="javascript">window.location="index.php?com='.COMS.'&task=addfile&err=exist"</script>';
				elseif( move_uploaded_file($tmpfile, "../".$obj->Urlfile.$filename))
					echo '<script language="javascript">window.location="index.php?com='.COMS.'&err=filesuccess"</script>';
			}
		}
		
		if($obj->ID=="-1")
		{
			// kiem tra da ton tai ten file nay chua truoc khi insert
			$exist = $obj->getCode($obj->Code);
			if($exist>0)
				echo '<script language="javascript">window.location="index.php?com='.COMS.'&task=addfile&err=exist"</script>';
			else {	
				$obj->Add_new();
				echo '<script language="javascript">window.location="index.php?com='.COMS.'&err=addfile_success"</script>';
			}
		}
		else {
			if($obj->Update()==true)
				echo '<script language="javascript">window.location="index.php?com='.COMS.'&err=editfile_success"</script>';
			//else
				//header("location:index.php?com=".COMS."&err=editfile_notsuccess");
		}
		//header("location:index.php?com=".COMS);
	}
	
	if(isset($_POST["txtaction"]) && $_POST["txtaction"]!="")
	{
		$id=$_POST["txtids"];
		$id=str_replace(",","','",$id);
		switch ($_POST["txtaction"])
		{
			case "public": 		$obj->Publish($id); 		break;
			case "unpublic": 	$obj->UnPublish($id); 	break;
			case "edit": 	
				$id=explode("','",$id);
				header("location:index.php?com=".COMS."&task=edit&id=".$id[0]);
				exit();
				break;
			case "delete": 		$obj->Delete($id); 	break;
		}
		//header("location:index.php?com=".COMS);
	}
	// close object
	unset($obj);
	unset($obupload);
	
	define("THIS_COM_PATH",COM_PATH."com_".COMS."/");
	if(isset($_GET["task"]))
		$task=$_GET["task"];
	switch($task)
	{
		case "addfolder"	: 	include(THIS_COM_PATH."tem/addfolder.php"); 	break;
		case "editfolder"	: 	include(THIS_COM_PATH."tem/editfolder.php");	break;
		case "addfile"	: 		include(THIS_COM_PATH."tem/addfile.php");	break;
		case "editfile"	: 		include(THIS_COM_PATH."tem/editfile.php");	break;
		case "active"	: 		include(THIS_COM_PATH."tem/active.php");	break;
		case "delete"	: 		include(THIS_COM_PATH."tem/delete.php");	break;
		default: include(THIS_COM_PATH."tem/list.php");
	}
?>