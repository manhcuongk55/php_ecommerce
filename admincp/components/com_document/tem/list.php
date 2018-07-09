<style>
table.tbldocument a { color:#000;}
table.tbldocument a:hover { text-decoration:underline; color:green} 

tr.row1 { background-color:#fff}
tr.row2 { background-color:#fefee2;}

a.download img { border:0; vertical-align:middle}

</style>

<script language="javascript" src="../js/function_doc.js"></script>
<?php
$msg =''; 

  if(!isset($objdata)) $objdata = new CLS_MYSQL();
  if(!isset($objdoc)) $objdoc = new CLS_DOCUMENT();

  $folderid =''; $url='';


  if(isset($_GET["folderid"])) 
	$folderid=$_GET["folderid"]; //echo $id;
	
  if(isset($_POST["cbofolder"]) && $_POST["cbofolder"]!='') 
	$folderid=$_POST["cbofolder"]; //echo $folderid;	
	
  if(isset($_POST["txturl"])) {
	$url=$_POST["txturl"];
	if(strlen($url)>8) 
		{$url = substr($url,0,strlen($url)-1); // loai bỏ ký tự "/" ở cuối xâu
		$vitri = strrpos($url,"/"); // Tìm vị trí cuối cùng xuất hiện của dấu "/". strrpos:Tìm vị trí lần xuất hiện cuối cùng cùng của một kí tự trong một xâu.
		//echo $vitri;
		if($vitri!=0) $url = substr($url,0,$vitri)."/"; 
	}
  }
  
  if($folderid==''){
	 	$objdata = $objdoc->getAllList(" WHERE par_id=0 ORDER BY loai DESC, name ASC");
  }
  else
  	$objdata = $objdoc->getAllList(" WHERE par_id=".$folderid." ORDER BY loai DESC, name ASC");

 if($url!='') {
	$objdata = $objdoc->getAllList(" WHERE urlfile='$url' ORDER BY loai DESC, name ASC");
 }
// Lay link tai lieu
if(!isset($_SESSION["URLDOC"])) $_SESSION["URLDOC"]='tailieu/';

if($folderid=='' || $folderid==0) 
	$_SESSION["URLDOC"]='tailieu/';
else
	$_SESSION["URLDOC"]=$objdoc->getURLdoc($folderid);

if($url!='' && $url!="tailieu/") {
	$_SESSION["URLDOC"]=$url;
}
?>

<form name="frmdocument" id="frmdocument" action="" method="post">
  <table width="100%" border="0" cellspacing="0" cellpadding="5">
	  <tr>
	    <td>Chọn thư mục 
	      <select name="cbofolder" id="cbofolder" onchange="frmdocument.submit()">
          <option value="" style="background-color:#ccc;">-- Chọn thư mục & tệp tin --</option>
          <option value="0" <?php if($folderid==0) echo ' selected="selected"' ;?>>Tất cả các thư mục & tệp tin gốc</option>
          <?php  $objdoc->getListDoc(0,1,$folderid);?>
        </select> <?php //echo "url=".$url." ; docid=".$folderid;?>   </td>
    </tr>
   </table>
</form>
<h4 style="color:red; background-color:#FFC"><?php echo $err;?></h4>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr><td colspan="3">
  <?php if( ($url=='' && $folderid!=0 && $folderid!='') || ($url!='' && $url!='tailieu/' ) ) { ?>
  <form name="frmbackdocument" id="frmbackdocument" action="#" method="post">
  <input type="submit" name="backurl" id="backurl" onclick="javascript:frmbackdocument.submit()" value="<< Quay lại thư mục trước"/>
  </a>
  <input type="hidden" name="txturl" id="txturl" value="<?php echo $_SESSION["URLDOC"];?>" />
  </form>
  <?php } ?>
  </td></tr>
  <tr>
  	<td colspan="3" style="color:red">
	<?php 
	if(isset($_GET["err"]))
		$err = $_GET["err"];
	$icon = '<img src="images/Icon_Warning_Red.png" align="absmiddle"> ';
	$icon2 = '<img src="images/success-icon.png" align="absmiddle"> ';
	switch($err) {
		case 'foldersuccess': 		echo $icon2.'Tạo mới thư mục thành công';break;
		case 'not_foldersuccess': 	echo $icon.'Không tạo mới được thư mục.';break;
		
		case 'editfol_success': 	echo $icon2.'Cập nhật thư mục thành công.';break;
		case 'editfol_notsuccess': 	echo $icon.'Lỗi. Cập nhật thư mục không thành công.';break;
		
		case 'addfol_success': 		echo $icon2.'Thêm mới thư mục thành công vào CSDL.';break;
		case 'addfol_notsuccess': 	echo $icon.'Lỗi. Không thêm mới được thư mục vào CSDL.';break;
		
		case 'filesuccess': 		echo $icon2.'Tệp tin đã được Upload thành công !';break;
		case 'not_filesuccess': 	echo $icon.'Upload không thành công !';break;
		
		case 'addfile_success': 	echo $icon2.'Đã thêm mới tệp tin vào CSDL !';break;
		case 'addfile_notsuccess': 	echo $icon.'Lỗi. Không thêm mới được tệp tin vào CSDL !';break;
		case 'editfile_success': 	echo $icon2.'Cập nhật tệp tin thành công !';break;
		case 'editfile_notsuccess': echo $icon.'Lỗi. Cập nhật tệp tin không thành công !';break;
		
		case 'notdel': 				echo $icon.'Trước khi xóa: Yêu cầu xóa tất cả các thư mục, tệp tin nằm trong thư mục này.'; break;	
		case 'delsuccess': 			echo $icon2.'Xóa thành công.'; break;	
	}
	?>
    </td>
  </tr>
  <?php
  $i=1;
  while ($r=$objdata->FetchArray()) {
  ?>
  <tr class="row<?php echo $i;?>">
    <td width="50">
	<?php 
	$isactive 	= $r["isactive"];
	$docid 		= $r["doc_id"];
	$outsite 	= $r["outsite"];
	$loai 		= $r["loai"];
	$type 		= $r["type"];
	
	if($loai==1) 
		echo '<img src="../images/icon/folder.gif" height="32" />'; 
	else {
		switch($type) {
			case 'image/png': 
			case 'image/x-png':
			case 'image/jpg':
			case 'image/jpeg':
			case 'image/gif':	
				echo '<img src="../images/icon/7.gif" height="32"/>'; break;
			
			case 'application/msword':	
			case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document': //.docx word 2007
				echo '<img src="../images/icon/icon_doc.gif" height="11"/>'; break;
			
			case 'application/vnd.ms-excel':	
			case 'application/vnd.openxmlformats-officedocument.presentationml.presentation': //.xlsx Excel 2007
				echo '<img src="../images/icon/icon_xls.gif" height="11"/>'; break;
			
			case 'application/vnd.ms-powerpoint':
			case 'application/vnd.openxmlformats-officedocument.presentationml.presentation"': //.pptx PowerPoint 2007	
				echo '<img src="../images/icon/icon_ppt.gif" height="11"/>'; break;
				
			case 'application/pdf':	
				echo '<img src="../images/icon/icon_pdf.gif" height="11"/>'; break;
				
			case 'application/download': 
			case 'application/octet-stream': //.zip	
				echo '<img src="../images/icon/icon_zip.gif" height="11"/>'; break;
				
			case 'application/x-rar-compressed': 
			case 'application/rar':	
				echo '<img src="../images/icon/icon_rar.gif" height="11"/>'; break;
			default: 	echo '<img src="../images/icon/5.gif" height="32"/>';
		}
	}
	?></td>
    
    <td>
    <?php 
	if($loai!=1) 
		 echo stripslashes($r["name"]);
	else {
	?>

    <a href="?com=document&folderid=<?php echo $docid;?>"><?php echo stripslashes($r["name"]);?></a>
    <?php } ?>
    </td>
    <td width="250" align="left">
    <?php
	
	if($isactive==0) 
		echo '<a href="?com='.COMS.'&task=active&id='.$docid.'"><img src="../images/icon/icon_key.jpg" height="20" align="absmiddle" border="0" alt="Khóa"/></a>';
	else 
		echo '<img src="../images/icon/icon_key_unblock.jpg" height="20" align="absmiddle" border="0" alt="Cho phép sử dụng"/>';
	
	if($loai==1) { ?>
    <a href="?com=<?php echo COMS;?>&task=editfolder&id=<?php echo $docid;?>">Sửa</a>
    <?php 
	} 
	else { ?>
    <a href="?com=<?php echo COMS;?>&task=editfile&id=<?php echo $docid;?>">Sửa</a>
    <?php } ?>
     <span style="color:#cccccc">|</span>
    <a href="?com=<?php echo COMS;?>&task=delete&id=<?php echo $docid;?>">Xóa</a> 
    <?php if($loai!=1) { ?>
        <span style="color:#cccccc">|</span>
        <?php if($outsite!='') { ?>
        <a href="<?php echo $outsite;?>" target="_blank" class="download">Download</a>
        <?php } else { ?>
        <a href="javascript:download_file('<?php echo HOST_URL."download.php?id=".$docid;?>')" class="download">Download</a>
    <?php }  // end if $outsite!=''
	} // end if $loai!=1
	?>
    </td>
  </tr>
  <?php 
  if($i==1) $i=2;
  else $i=1;
  } //end while
  ?>
</table>
