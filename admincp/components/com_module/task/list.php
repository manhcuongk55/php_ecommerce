<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$keyword='Keyword';
	$action='';
	$position='';
	if(isset($_POST['txtkeyword'])){
		$keyword=$_POST['txtkeyword'];
		$action=$_POST['cbo_active'];
		$position=$_POST['cbo_position'];
	}
	$strwhere='';
	if($keyword!='' && $keyword!='Keyword')
		$strwhere.=" ( `title` like '%$keyword%' OR `content` like '%$keyword%') AND ";
	if($action!='' && $action!='all' )
		$strwhere.=" `isactive` = '$action' AND ";
	if($position!='' && $position!='all' )
		$strwhere.=" `position` = '$position' AND ";
	if($strwhere!='')
		$strwhere=' WHERE '.$strwhere.' 1=1 ';
	
	if(!isset($_SESSION['CUR_PAGE_MOD']))
		$_SESSION['CUR_PAGE_MOD']=1;
	if(isset($_POST['txtCurnpage']))
		$_SESSION['CUR_PAGE_MOD']=$_POST['txtCurnpage'];
		
	$obj->getList($strwhere,'');
	$total_rows=$obj->Num_rows();
	if($_SESSION['CUR_PAGE_MOD']>ceil($total_rows/MAX_ROWS))
		$_SESSION['CUR_PAGE_MOD']=ceil($total_rows/MAX_ROWS);
	$cur_page=$_SESSION['CUR_PAGE_MOD'];
?>
<div id="list">
<script language="javascript">
function checkinput(){
	var strids=document.getElementById('txtids');
	if(strids.value==''){
		alert('You are select once record to action');
		return false;
	}
	return true;
}
</script>
  <form id="frm_list" name="frm_list" method="post" action="">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Header_list">
      <tr>
        <td><?php echo SEARCH;?>:
            <input type="text" name="txtkeyword" id="txtkeyword" value="<?php echo $keyword;?>" onfocus="onsearch(this,1);" onblur="onsearch(this,0)" />
            <input type="submit" name="button" id="button" value="<?php echo SEARCH;?>" class="button" />
        </td>
        <td align="right">
          <label>
            <select name="cbo_position" id="cbo_position" onchange="document.frm_list.submit();">
              <option value="all">Select position</option>
              <?php 
			  $obj->getPosition();
			  ?>
              <script language="javascript">
				cbo_Selected('cbo_position','<?php echo $position;?>');
              </script>
            </select>
          </label>
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
    <table width="100%" border="0" cellspacing="0" cellpadding="3" class="list">
      <tr class="header">
		<th width="30" align="center">STT</th>
        <th width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
        <th align="center"><?php echo CTITLE;?></th>
        <th width="75" align="center"><?php echo TYPE;?></th>
        <th width="75" align="center"><?php echo CPOSITION;?></th>
        <th width="60" align="center"><?php echo CORDER;?>
			<a href="index.php?com=<?php echo COMS;?>&task=order&modid=2">
				<img src="templates/default/images/save.png" border="0" width="13" alt="Save" longdesc="#" />
			</a>
        </th>
        <th width="50" align="center"><?php echo CACTIVE;?></th>
        <th width="50" align="center" colspan='2'>Process</th>
      </tr>
      <?php
	  $start=($cur_page-1)*MAX_ROWS;
	  $obj->getList($strwhere," LIMIT $start,".MAX_ROWS);
	  $i=0;
	  while($rows= $obj->Fetch_Assoc()){ $i++;
	  ?>
	  <tr>
		<td align='center'><?php echo $i;?></td>
		<td align='center'><input type="checkbox" name="chk" id="chk" value="<?php echo $rows['mod_id'];?>" onclick="docheckonce('chk');" /></td>
		<td><?php echo $rows['title'];?></td>
		<td align='center'><?php echo $rows['type'];?></td>
		<td align='center'><?php echo $rows['position'];?></td>
		<td align="center"><input type="text" value="<?php echo $rows['order'];?>" name='txt_order'/></td>
		<td width='50' align="center">
			<a href="index.php?com=<?php echo COMS;?>&task=active&id=<?php echo $rows["mod_id"];?>">
			<?php showIconFun('publish',$rows["isactive"]);?>
			</a>
		</td>
		<td width='50' align="center">
			<a href="index.php?com=<?php echo COMS;?>&task=edit&id=<?php echo $rows["mod_id"];?>">
			<?php showIconFun('edit','');?>
			</a>
		</td>
		<td width='50' align="center">
			<a href="index.php?com=<?php echo COMS;?>&task=delete&id=<?php echo $rows["mod_id"];?>">
			<?php showIconFun('delete','');?>
			</a>
		</td>
	  </tr>
	  <?php } unset($obj); unset($start);?>
    </table>
  </form>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
      <tr>
        <td align="center"><?php paging($total_rows,MAX_ROWS,$cur_page);?></td>
      </tr>
  </table>
</div>
<?php //----------------------------------------------?>