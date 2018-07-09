<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$keyword='Keyword';
	$action='';
	$parid='';
	$level=0;
	
	if(isset($_POST['txtkeyword'])){
		$keyword=$_POST['txtkeyword'];
		$action=$_POST['cbo_active'];
	}
	$strwhere='';
	if($keyword!='' && $keyword!='Keyword'){
		$strwhere.="AND ( `name` like N'%$keyword%')";
	}
	if($action!='' && $action!='all' )
		$strwhere.="AND `isactive` = '$action'";

	//echo $strwhere;
	if(!isset($_SESSION['CUR_PAGE_CAT']))
		$_SESSION['CUR_PAGE_CAT']=1;
	if(isset($_POST['txtCurnpage'])){
		$_SESSION['CUR_PAGE_CAT']=$_POST['txtCurnpage'];
	}
	$obj->getList($strwhere,'');
	$total_rows=$obj->Num_rows();
	if($_SESSION['CUR_PAGE_CAT']>ceil($total_rows/MAX_ROWS))
		$_SESSION['CUR_PAGE_CAT']=ceil($total_rows/MAX_ROWS);
	$cur_page=$_SESSION['CUR_PAGE_CAT'];
?>
<div id="list">
  <script language="javascript">
  function checkinput()
  {
	  var strids=document.getElementById("txtids");
	  if(strids.value=="")
	  {
		  alert('You are select once record to action');
		  return false;
	  }
	  return true;
  }
  </script>
  <form id="frm_list" name="frm_list" method="post" action="">
    <table width="100%" border="0" cellspacing="0" cellpadding="3" class="list">
      <tr class="header">
        <td width="30" align="center">STT</td>
        <td width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></td>        
        <td align="center">Họ tên</td>
        <td width="50" align="center">Email</td>
        <td width="30" align="center">Số ĐT</td>
        <td width="50" align="center">Địa chỉ</td>
        <td width="30" align="center">Thời gian</td>
        <td align="center">Nội dung</td>
      </tr>
      <?php
  	     $obj->getList();
         $i=0;
         while ($row = $obj->Fetch_Assoc()) { ?>
           <tr>
              <td width="30"><?php echo $i+1?></td>
              <td width="30">
                <input type='checkbox' name='chk' id='chk' onclick='docheckonce("chk");' value='<?php echo $row['contact_id']?>' />
              </td>
             <td width="100"><?php echo $row['name']?></td>
             <td width="80"><?php echo $row['email']?></td>
             <td width="80"><?php echo $row['phone']?></td>
             <td width="100"><?php echo $row['address']?></td>
             <td width="80"><?php echo $row['time']?></td>
             <td>
              <?php echo "<strong>Tiêu đề: </strong>".$row['subject']?></br>
              <?php echo "<strong>Nội dung: </strong></br>";
                echo $row['text'];
              ?>
             </td>
           </tr>
        <?php  $i++;}
  	  ?>
      
    </table>
  </form>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
      <tr>
        <td align="center">	  
        <?php 
            paging($total_rows,MAX_ROWS,$cur_page);
        ?>
        </td>
      </tr>
  </table>
</div>
<?php //----------------------------------------------?>