<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	if(!isset($_SESSION['ACTION_SITE'])){
		$_SESSION['ACTION_SITE']='';
		$_SESSION['ACTION_SITE']='front_end';
	}	
	if(isset($_POST['tab_site']) && $_POST['tab_site']!='')
		$_SESSION['ACTION_SITE'] = $_POST['tab_site'];
		
	$keyword='Keyword';
	$action='';
	if(isset($_POST['txtkeyword'])){
		$keyword=addslashes($_POST['txtkeyword']);
		$action=$_POST['cbo_active'];
	}
	$strwhere=" `site`='".$_SESSION['ACTION_SITE']."' AND";
	if($keyword!='' && $keyword!='Keyword')
		$strwhere.=" ( `name` like '%$keyword%') AND";
	if($action!='' && $action!='all' )
		$strwhere.=" `isactive` = '$action' AND";
	if($strwhere!='')
		$strwhere=' WHERE '.$strwhere.' 1=1 ';
	//echo $strwhere;
	if(!isset($_SESSION['CUR_PAGE_LANG']))
		$_SESSION['CUR_PAGE_LANG']=1;
	if(isset($_POST['txtCurnpage'])){
		$_SESSION['CUR_PAGE_LANG']=$_POST['txtCurnpage'];
	}
	$obj->getList($strwhere,'');
	$total_rows=$obj->Num_rows();
	if($_SESSION['CUR_PAGE_LANG']>ceil($total_rows/MAX_ROWS))
		$_SESSION['CUR_PAGE_LANG']=ceil($total_rows/MAX_ROWS);
	$cur_page=$_SESSION['CUR_PAGE_LANG'];
?>
<div class="tab">
    <a href="javascript:document.getElementById('tab_site').value='front_end'; document.frm_list.submit();" class="<?php if($_SESSION["ACTION_SITE"]=="front_end") echo 'activetab';?>"><?php echo $objlang->TAB_SITE;?></a>
    <a href="javascript:document.getElementById('tab_site').value='back_end'; document.frm_list.submit();" class="<?php if($_SESSION["ACTION_SITE"]=="back_end") echo 'activetab';?>"><?php echo $objlang->TAB_ADMIN;?></a>
</div>
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
  <form id="frm_list" name="frm_list" method="post" action="" onsubmit="document.getElementById('tab_site').value= '<?php echo $_SESSION["ACTION_SITE"];?>';">
  	<input type="hidden" name="tab_site" id="tab_site" value="" />
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
    <table width="100%" border="0" cellspacing="0" cellpadding="3" class="list">
      <tr class="header">
        <th width="30" align="center">STT</th>
        <th width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
        <th width="75" align="center"><?php echo $objlang->LANG_NAME;?></th>
        <th align="center"><?php echo $objlang->LANG_CODE;?></th>
        <th align="center"><?php echo $objlang->LANG_FLAG;?></th>
        <th width="50" align="center"><?php echo IS_DEFAULT;?></th>
        <th width="50" align="center"><?php echo ACTIVE;?></th>
        <th width="50" align="center"><?php echo EDIT;?></th>
        <th width="50" align="center"><?php echo DELETE;?></th>
      </tr>
      <?php
	  $start=($cur_page-1)*MAX_ROWS;
	  $obj->getList($strwhere," LIMIT $start,".MAX_ROWS);
	  $i=1;
	  while($rows=$obj->Fetch_Assoc()){
	  ?>
      <tr name="trow" class="list">
        <td width="30" align="center"><?php echo $i;?></td>
        <?php //begin change -----------------------------------------------------------?>
        <td width="30" align="center"><input type="checkbox" name="chk" id="chk" onclick="docheckonce('chk');" value="<?php echo $rows["lag_id"]; ?>"  /></td>
       <?php //end change -----------------------------------------------------------?>
        <td width="75"><?php echo $rows["name"];?></td>
        <td><?php echo $rows["code"];?></td>
        <td><?php echo '<img src="../images/flags/'.$rows["flag"].'" width="22" align="absmiddle" /> '.$rows["flag"];?></td>
        <td width="50" align="center">
        	<a href="index.php?com=<?php echo COMS;?>&task=default&id=<?php echo $rows["lag_id"];?>">
			<?php showIconFun('isdefault',$rows["isdefault"]);?>
            </a>
        </td>
        <td width="50" align="center">
        	<a href="index.php?com=<?php echo COMS;?>&task=active&id=<?php echo $rows["lag_id"];?>">
			<?php showIconFun('publish',$rows["isactive"]);?>
            </a>
        </td>
        <td width="50" align="center">
        	<a href="index.php?com=<?php echo COMS;?>&task=edit&id=<?php echo $rows["lag_id"];?>">
			<?php showIconFun('edit','');?>
            </a>
            </td>
        <td width="50" align="center">
        	<a href="javascript:detele_field('index.php?com=<?php echo COMS;?>&task=delete&id=<?php echo $rows["lag_id"];?>');">
			<?php showIconFun('delete','');?>
            </a>
         </td>
      </tr>
      <?php 
	  $i++;
	  }?>
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