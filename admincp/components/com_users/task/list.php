<?php
	defined('ISHOME') or die("Can't acess this page, please come back!");
	$keyword='Keyword';
	$action='';
	if(isset($_POST['txtkeyword'])){
		$keyword=$_POST['txtkeyword'];
		$action=$_POST['cbo_active'];
	}
	$strwhere="";
	if($keyword!="" && $keyword!="Keyword")
		$strwhere.=" ( `name` like '%$keyword%' OR `desc` like '%$keyword%') AND";
	if($action!="" && $action!="all" )
		$strwhere.=" `isactive` = '$action' AND";
	if($strwhere!="")
		$strwhere=" WHERE ".substr($strwhere,0,strlen($strwhere)-4);
	//echo $strwhere;
	if(!isset($_SESSION["CUR_PAGE_MEM"]))
		$_SESSION["CUR_PAGE_MEM"]=1;
	if(isset($_POST["txtCurnpage"])){
		$_SESSION["CUR_PAGE_MEM"]=$_POST["txtCurnpage"];
	}
	$obj->getList($strwhere,'');
	$total_rows=$obj->Num_rows();
	if($_SESSION['CUR_PAGE_MEM']>ceil($total_rows/MAX_ROWS))
		$_SESSION['CUR_PAGE_MEM']=ceil($total_rows/MAX_ROWS);
	$cur_page=$_SESSION['CUR_PAGE_MEM'];
?>
<div id="list">
  <script language="javascript">
  function checkinput(){
	  var strids=document.getElementById("txtids");
	  if(strids.value==""){
		  alert('You are select once record to action');
		  return false;
	  }
	  return true;
  }
  </script>
  <form id="frm_list" name="frm_list" method="post" action="">
	<?php if($obj->isAdmin()==true) { ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Header_list">
      <tr>
        <td><?php echo SEARCH;?>:
            <input type="text" name="txtkeyword" id="txtkeyword" value="<?php echo $keyword;?>" onfocus="onsearch(this,1);" onblur="onsearch(this,0)" />
            <input type="submit" name="button" id="button" value="<?php echo SEARCH;?>" class="button" />
        </td>
        <td align="right">
          <select name="cbo_active" id="cbo_active" onchange="document.frm_list.submit();">
            <option value="all"><?php echo MALL;?></option>
            <option value="1"><?php echo MPUBLISH;?></option>
            <option value="0"><?php echo MUNPUBLISH;?></option>
            <script language="javascript">
			cbo_Selected('cbo_active','<?php echo $action;?>');
            </script>
          </select>
        </td>
      </tr>
    </table>
    <?php } ?>
    <table width="100%" border="0" cellspacing="1" cellpadding="5" class="list">
      <tr class="header">
        <td width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></td>
        <td align="center">Tên đăng nhập</td>
        <td align="center">Tên</td>
        <td align="center">Email</td>
        <?php 
	    if($obj->isAdmin()==true) {
		?>
        <td align="center">Đổi mật khẩu</td>
        <td width="75" align="center">Nhóm quyền</td>
        <td width="50" align="center"><?php echo CACTIVE;?></td>
        <td width="50" align="center"><?php echo CEDIT;?></td>
        <td width="50" align="center"><?php echo CDELETE;?></td>
        <?php } ?>
      </tr>
      <?php 
      $start=($cur_page-1)*MAX_ROWS;
	  $obj->getList($strwhere,' LIMIT $start,'.MAX_ROWS);
	  while($rows=$obj->Fetch_Assoc()){
		$id=$rows["mem_id"];
		$username=$rows["username"];
		$name=$rows["firstname"]." ".$rows["lastname"];
		$gender=($rows["gender"]==0)?'Nam':'Nữ';
		
		$objmem = new CLS_GUSER();
		$objmem->getList(" WHERE gmem_id='".$rows["gmem_id"]."' ",''); 
		$grow=$objmem->Fetch_Assoc();
		$gmember=$grow['name'];
		
		$email=$rows["email"];
		echo "<tr name='trow'>";
		echo "<td width='30' align='center'><label>";
		echo "<input type='checkbox' name='chk' id='chk' onclick='docheckonce('chk');' value='$id' />";
		echo "</label></td>";
		echo "<td width='100'><a href='index.php?com=".COMS."&amp;task=edit&amp;id=$id'>$username</a></td>";
		echo "<td nowrap='nowrap'><a href='index.php?com=".COMS."&amp;task=edit&amp;id=$id'>$name</a></td>";
		echo "<td nowrap='nowrap'>$email</td>";
		if($UserLogin->isAdmin()==true) {
			echo "<td align='center'><a href='index.php?com=".COMS."&amp;task=changepass&amp;id=$id'>Đổi</a></td>";
			echo "<td nowrap='nowrap'>$gmember</td>";
			echo "<td width='50' align='center'>";
				echo "<a href='index.php?com=".COMS."&amp;task=active&amp;id=$id'>";
				showIconFun('publish',$rows["isactive"]);
				echo "</a>";			
			echo "</td>";
			echo "<td width='50' align='center'>";
				echo "<a href='index.php?com=".COMS."&amp;task=edit&amp;id=$id'>";
				showIconFun('edit','');
				echo "</a>";			
			echo "</td>";
			echo "<td width='50' align='center'>";
				echo "<a href='javascript:detele_field('index.php?com=".COMS."&amp;task=delete&amp;id=$id')'>";
				showIconFun('delete','');
				echo "</a>";
			echo "</td>";
		}
		echo "</tr>";
	  }
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