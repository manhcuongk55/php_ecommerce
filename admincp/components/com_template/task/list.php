<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$keyword='Keyword';
	$active='';
	$site='site';
	if(!isset($_SESSION['SITE'])){
		$_SESSION['SITE']='site'; 
		$_SESSION['TEM_KEYWORD']='';
		$_SESSION['TEM_KEYWORD']='Keyword';
	}
	if(isset($_POST['txtkeyword'])){
		$_SESSION['TEM_KEYWORD']=$_POST['txtkeyword'];
		$_SESSION['TEM_ACTIVE']=$_POST['cbo_active'];
		$_SESSION['SITE']=$_POST['cbo_site'];
	}
	$keyword=$_SESSION['TEM_KEYWORD'];
	if (isset($_SESSION['TEM_ACTIVE'])) {
		$active=$_SESSION['TEM_ACTIVE'];	
	}
	
	$site=$_SESSION['SITE'];
	
	$strwhere='';
	if($site!='')
		$strwhere.=" `site` = '$site' AND";
	if($keyword!='' && $keyword!='Keyword')
		$strwhere.=" ( `name` like '%$keyword%' OR `desc` like '%$keyword%') AND";
	if($active!='' && $active!='all' )
		$strwhere.=" `isactive` = '$active' AND";
	if($strwhere!='')
		$strwhere=' WHERE '.$strwhere.' 1=1 ';
		
	if(!isset($_SESSION['CURPAGE']))
		$_SESSION['CURPAGE']=1;
	if(isset($_POST['txtCurnpage']))
		$_SESSION['CURPAGE']=$_POST['txtCurnpage'];
	
	$cur_page=$_SESSION['CURPAGE'];
?>
<div id='list'>
  <script language='javascript'>
  function checkinput(){
	  var strids=document.getElementById('txtids');
	  if(strids.value==''){
		  alert('You are select once record to active');
		  return false;
	  }
	  return true;
  }
  </script>
  <form id="frm_list" name="frm_list" method="post" active="">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Header_list">
      <tr>
        <td><?php echo SEARCH;?>:
            <input type="text" name="txtkeyword" id="txtkeyword" value="<?php echo $keyword;?>" onfocus="onsearch(this,1);" onblur="onsearch(this,0)" />
            <input type="submit" name="button" id="button" value="<?php echo SEARCH;?>" class="button" />
        </td>
        <td align="right">
          <label>
            <strong>List template of 
            </strong>
            <select name="cbo_site" id="cbo_site" onchange="document.frm_list.submit();">
              <option value="site" selected="selected">Site</option>
              <option value="admin">Admin</option>
              <script language="javascript">
				cbo_Selected('cbo_site','<?php echo $site;?>');
			  </script>
            </select>
          </label>
          <select name="cbo_active" id="cbo_active" onchange="document.frm_list.submit();">
            <option value="all"><?php echo MALL;?></option>
            <option value="1"><?php echo MPUBLISH;?></option>
            <option value="0"><?php echo MUNPUBLISH;?></option>
            <script language="javascript">
				cbo_Selected('cbo_active','<?php echo $active;?>');
            </script>
          </select>
        </td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="3" class="list">
	<tr class="header">
		<th width="30" align='center' ><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
		<th width="75" ><?php echo CNAME;?></th>
		<th><?php echo CAUTHOR;?></th>
		<th>Email</th>
		<th><?php echo CSITE;?></th>
		<th width="50" ><?php echo CDEFAULT;?></th>
		<th width="50" ><?php echo CACTIVE;?></th>
		<th colspan='2' align='center' >Process</th>
	</tr>
	<?php
	$obj->getList($strwhere,'');
	$total_rows=$obj->Num_rows($strwhere);
	$start=($cur_page-1)*MAX_ROWS;
	$obj->getList($strwhere," LIMIT $start,".MAX_ROWS);
	while($row=$obj->Fetch_Assoc()){
	?>
	<tr name="trow">
		<td align='center'><input type="checkbox" name='chk' id='chk' onclick="docheckonce('chk');" value='<?php echo $row['tem_id'];?>' /></td>
		<td><?php echo $row['name'];?></td>
		<td><?php echo $row['author'];?></td>
		<td><?php echo $row['author_email'];?></td>
		<td><?php echo $row['author_site'];?></td>
		<td width="50" align='center'><a href="index.php?com=<?php echo COMS;?>&task=default&id=<?php echo $row['tem_id'];?>">
		<?php 	showIconFun('isdefault',$row["isdefault"]);	?></a>
		</td>
		<td width="50" align='center'><a href="index.php?com=<?php echo COMS;?>&task=active&id=<?php echo $row['tem_id'];?>">
		<?php showIconFun('publish',$row['isactive']);?></a>
		</td>
		<td width="50" align='center'><a href="index.php?com=<?php echo COMS;?>&task=edit&id=<?php echo $row['tem_id'];?>">
		<?php showIconFun('edit','');?></a>
		</td>
		<td width="50" align='center'><a href="index.php?com=<?php echo COMS;?>&task=delete&id=<?php echo $row['tem_id'];?>" onclick="return confirm('Do you sure to delete this recored?')">
		<?php showIconFun('delete','');?></a>
		</td>
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