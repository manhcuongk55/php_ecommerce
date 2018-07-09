<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$keyword='Keyword';	$action='';	$catid='';
	
	if(!isset($_SESSION['EDU_CONTENT_CATID'])) $_SESSION['EDU_CONTENT_CATID']='';
	if(!isset($_SESSION['EDU_CONTENT_ACT'])) $_SESSION['EDU_CONTENT_ACT']='';
	
	if(isset($_POST['txtkeyword'])){
		$keyword=$_POST['txtkeyword'];
		$_SESSION['EDU_CONTENT_ACT']=$_POST['cbo_active'];
		$_SESSION['EDU_CONTENT_CATID']=$_POST['cbo_cont'];
	}
	$catid = $_SESSION['EDU_CONTENT_CATID'];
	$action = $_SESSION['EDU_CONTENT_ACT'];

	$strwhere='';
	if($keyword!='' && $keyword!='Keyword')
		$strwhere.="AND ( `name` like '%$keyword%' OR `desc` like '%$keyword%')";
	if($catid!='' && $catid!='all')
		$strwhere.="AND `cat_id` = '$catid' ";
	if($action!='' && $action!='all' )
		$strwhere.="AND `isactive` = '$action'";
	//echo $strwhere;
	if(!isset($_SESSION['CUR_PAGE_CON']))
		$_SESSION['CUR_PAGE_CON']=1;
	if(isset($_POST['txtCurnpage'])){
		$_SESSION['CUR_PAGE_CON']=$_POST['txtCurnpage'];
	}
	$obj->getList($strwhere,'');
	$total_rows=$obj->Num_rows();
	if($_SESSION['CUR_PAGE_CON']>ceil($total_rows/MAX_ROWS))
		$_SESSION['CUR_PAGE_CON']=ceil($total_rows/MAX_ROWS);
	$cur_page=($_SESSION['CUR_PAGE_CON']<1)?1:$_SESSION['CUR_PAGE_CON'];
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
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Header_list">
      <tr>
        <td><?php echo SEARCH;?>:
            <input type="text" name="txtkeyword" id="txtkeyword" value="<?php echo $keyword;?>" onfocus="onsearch(this,1);" onblur="onsearch(this,0)" />
            <input type="submit" name="button" id="button" value="<?php echo SEARCH;?>" class="button" />
        </td>
        <td align="right">
        <label>
        <select name="cbo_cont" id="cbo_cont" onchange="document.frm_list.submit();">
          <option value="all">Select once article</option>
              <?php 
			  if(!isset($objcate))
			  	$objcate=new CLS_CATE();
			  	echo $objcate->getListCate(0,"");
			  ?>
          <script language="javascript">
			cbo_Selected('cbo_cont','<?php echo $catid;?>');
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
        </select></td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="3" class="list">
      <tr class="header">
        <th width="30" align="center">#</th>
        <th width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
        <th align="center"><?php echo CTITLE;?></th>
        <th width="150" align="center"><?php echo CCATEGORY;?></th>
        <th align="center"><?php echo CAUTHOR;?></th>
        <th align="center"><?php echo CVISITED;?></th>
        <th width="30" align="center">
        <img onclick="do_order();" src="templates/default/images/save.png" border="0px;" width="13" alt="Order" title="Order" />
        </th>
        <th width="30" align="center"><?php echo CACTIVE;?></th>
        <th width="30" align="center"><?php echo CEDIT;?></th>
        <th width="30" align="center"><?php echo CDELETE;?></th>
      </tr>
      <?php 
	  $obj->listTableCon($strwhere,$cur_page);
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