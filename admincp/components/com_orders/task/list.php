<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$keyword='';
	if(isset($_POST['txt_searchdate']))
		$keyword=$_POST['txt_searchdate'];
	//echo $strwhere;
	if(!isset($_SESSION['CUR_PAGE_ORDER']))
		$_SESSION['CUR_PAGE_ORDER']=1;
	if(isset($_POST['txtCurnpage'])){
		$_SESSION['CUR_PAGE_ORDER']=$_POST['txtCurnpage'];
	}
	//$obj->getList($strwhere,'');
	$total_rows=$obj->Num_rows();
	if($_SESSION['CUR_PAGE_ORDER']>ceil($total_rows/MAX_ROWS))
		$_SESSION['CUR_PAGE_ORDER']=ceil($total_rows/MAX_ROWS);
	$cur_page=($_SESSION['CUR_PAGE_ORDER']<1)?1:$_SESSION['CUR_PAGE_ORDER'];
?>
<div id="list">
<H1 align='center'>Danh sách đơn hàng mới đặt</H1>
<script language="javascript">
  function checkinput(){
	  var strids=document.getElementById("txtids");
	  if(strids.value==""){
		  alert('You are select once record to action');
		  return false;
	  }
	  return true;
  }
  $(document).ready(function() {
	$(function() {
		$( "#txt_searchdate" ).datepicker({dateFormat: 'dd-mm-yy' });
	});
	});
  </script>
  <form id="frm_list" name="frm_list" method="post" action="">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Header_list">
      <tr>
        <td align="right">List of by
			<input type="text" id='txt_searchdate' name='txt_searchdate' size='10' value='<?php echo $keyword;?>' onchange='document.getElementById("frm_list").submit();'/>
        </td>
      </tr>
    </table>
	
    <table width="100%" border="0" cellspacing="0" cellpadding="3" class="list">
      <tr class="header">
        <th width="30" align="center">#</th>
        <th width="50">Số Hóa đơn</th>
        <th>Khách hàng</th>
        <th>Điện thoại</th>
        <th width="50" align="center">Status</th>
        <th width="50" align="center">Chi tiết</th>
        <th width="30" align="center"><?php echo CDELETE;?></th>
      </tr>
      <?php
	  $keyword=date('Y-m-d',strtotime($keyword));
	  $obj->getList(" WHERE `status`='0' ",' ORDER BY `cdate` DESC ','');
	  $total_rows=$obj->Num_rows();
	  $num=0;
	  while($row=$obj->Fetch_Assoc()){$num++;
	  ?>
	  <tr>
		<td align='center'><?php echo $num;?></td>
		<td align='center'>HD<?php echo $row['id'];?></td>
		<td><?php echo $row['cname'];?></td>
		<td><?php echo $row['cphone'];?></td>
		
		<td align='center'><span style='color:red;'>Waiting</span></td>
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