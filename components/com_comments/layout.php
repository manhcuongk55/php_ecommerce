<?php
if(isset($_POST["cmdsave"]))
{
	if ($_FILES["hocvien"]["error"] > 0)
  {
  echo "Error: " . $_FILES["hocvien"]["error"] . "<br />";
  }
else
  {
  }
?>
<?php
if ((($_FILES["hocvien"]["type"] == "image/gif")
|| ($_FILES["hocvien"]["type"] == "image/jpeg")
|| ($_FILES["hocvien"]["type"] == "image/pjpeg")
|| ($_FILES["hocvien"]["type"] == "image/png"))
&& ($_FILES["hocvien"]["size"] < 2000000))
  {
  if ($_FILES["hocvien"]["error"] > 0)
    {
    }
  else
    {

    if (file_exists("upload/" . $_FILES["hocvien"]["name"]))
      {
     // echo $_FILES["hocvien"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["hocvien"]["tmp_name"],"images/hocvien/" . $_FILES["hocvien"]["name"]);
	// echo "images/hocvien/" . $_FILES["hocvien"]["name"]; die();
	  
      //echo "Stored in: " . "D:/wamp/www/IGF_EDU/images/hocvien/" . $_FILES["hocvien"]["name"];
	  $_SESSION["NAME_FILEIMG"]="";
	  $_SESSION["NAME_FILEIMG"]="images/hocvien/".$_FILES["hocvien"]["name"];
	  //echo $_SESSION["NAME_FILEIMG"]; die();
	 echo "<script language=\"javascript\">window.location='index.php?com=comments&viewtype=list'</script>";
      }
    }
  }
else
  {
  echo "Invalid file";
  }
	?>
	<?php
	if(!isset($objcomm)) $objcomm =new CLS_COMM();
	if(isset($_POST["txttask"]) && $_POST["txttask"]==1)
	{
		$objcomm->username=$_POST["txtusername"];
		$objcomm->Content=$_POST["txtdesc"];
		$objcomm->Thumb=$_SESSION["NAME_FILEIMG"];
		if(isset($_POST["txtid"]))
			$objcomm->comm_id=$_POST["txtid"];
		if($objcomm->comm_id=="-1")
		{
			
			$result1=$objcomm->Add_new();
			if(!$result1)
				echo "<script language=\"javascript\">window.location='index.php'</script>";
			else	
				echo "<script language=\"javascript\">window.location='index.php?com=comments&viewtype=list'</script>";
		}
		else {
			$result3=$objcomm->Update();
			if(!$result3)
				echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&mess=U02'</script>";
			else	
				echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&mess=U01'</script>";
		}
	}
}
$viewtype="";
if(isset($_GET["viewtype"])){
	$viewtype=addslashes($_GET["viewtype"]);
}
	switch($viewtype)
	{
		case "add":	include("tem/add.php"); break;
		case "edit":	include("tem/edit.php"); break;
		case "list":	include("tem/list.php"); break;
		case "changepass": include("tem/changepass.php"); break;
		case "login": include("tem/login.php"); break;
		case "upload_file": include("tem/upload_file.php"); break;
	}
unset($objcomm);
unset($result1);unset($result2);unset($result3);
?>