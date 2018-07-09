<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$keyword='Keyword';	$action='';	$catid='';
	
	//echo $strwhere;
	if(!isset($_SESSION['CUR_PAGE_CON']))
		$_SESSION['CUR_PAGE_CON']=1;
	if(isset($_POST['txtCurnpage'])){
		$_SESSION['CUR_PAGE_CON']=$_POST['txtCurnpage'];
	}
	//$obj->getList($strwhere,'');
	$total_rows=$obj->Num_rows();
	if($_SESSION['CUR_PAGE_CON']>ceil($total_rows/MAX_ROWS))
		$_SESSION['CUR_PAGE_CON']=ceil($total_rows/MAX_ROWS);
	$cur_page=($_SESSION['CUR_PAGE_CON']<1)?1:$_SESSION['CUR_PAGE_CON'];
?>
<div id="list">
<H1 align='center'>Danh sách đơn hàng đang sử lý</H1>
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
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Header_list">
      <tr>
        <td align="right">
        <select name="cbo_active" id="cbo_active" onchange="document.frm_list.submit();">
          <option value="all"><?php echo MALL;?></option>
          <option value="1"><?php echo MPUBLISH;?></option>
          <option value="0"><?php echo MUNPUBLISH;?></option>
          <script language="javascript">
			cbo_Selected('cbo_active','<?php echo $action;?>');
          </script>
        </select></td>
      </tr>
    </table>
	
    <table width="100%" border="0" cellspacing="0" cellpadding="3" class="list">
      <tr class="header">
        <th width="30" align="center">#</th>
        <th width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
        <th width="50">Số Hóa đơn</th>
        <th>Khách hàng</th>
        <th>Điện thoại</th>
        <th width="50" align="center">Status</th>
        <th width="50" align="center">Chi tiết</th>
        <th width="30" align="center"><?php echo CDELETE;?></th>
      </tr>
      <?php 
	  $obj->getList(" WHERE `status`='1'",' ORDER BY `cdate` DESC ','');
	  $total_rows=$obj->Num_rows();
	  $num=0;
	  while($row=$obj->Fetch_Assoc()){$num++;
	  ?>
	  <tr>
		<td align='center'><?php echo $num;?></td>
		<td align='center'><input type="checkbox" name="chkall" id="chkall" value="<?php echo $row['id'];?>"/></td>
		<td align='center'>HD<?php echo $row['id'];?></td>
		<td><?php echo $row['cname'];?></td>
		<td><?php echo $row['cphone'];?></td>

		<td align='center'><span style='color:#0033ff;'>Processing</span></td>
		<td align='center'><a href='index.php?com=orders&task=detail&id=<?php echo $row['id'];?>' title='Detail'><?php showIconFun('edit','');?></td>
		<td align='center'><a href='index.php?com=orders&task=delete&id=<?php echo $row['id'];?>' onclick='return confirm("Bạn chắc chắn muốn xóa hóa đơn này?");'><?php showIconFun('delete','');?></a></td>
	  </tr>
	  <?php
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