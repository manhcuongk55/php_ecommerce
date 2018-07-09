<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$keyword='Keyword';
	$action='';
	if(isset($_POST['txtkeyword'])){
		$keyword=$_POST['txtkeyword'];
		$action=$_POST['cbo_active'];
	}
	$strwhere='';
	if($keyword!='' && $keyword!='Keyword')
		$strwhere.=" ( `name` like '%$keyword%' OR `desc` like '%$keyword%') AND ";
	if($action!='' && $action!='all' )
		$strwhere.=" `isactive` = '$action' AND ";
	if($mnuid!='' && $mnuid!='all')
		$strwhere.=" `mnu_id` = '$mnuid' AND ";
	if(!isset($_SESSION['CUR_PAGE_MNUITEM']))
		$_SESSION['CUR_PAGE_MNUITEM']=1;
	if(isset($_POST['txtCurnpage'])){
		$_SESSION['CUR_PAGE_MNUITEM']=$_POST['txtCurnpage'];
	}
	$obj->getList($strwhere,'');
	$total_rows=$obj->Num_rows();
	if($_SESSION['CUR_PAGE_MNUITEM']>ceil($total_rows/MAX_ROWS))
		$_SESSION['CUR_PAGE_MNUITEM']=ceil($total_rows/MAX_ROWS);
	$cur_page=$_SESSION['CUR_PAGE_MNUITEM'];
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
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Header_list">
      <tr>
        <td><?php echo SEARCH;?>:
            <input type="text" name="txtkeyword" id="txtkeyword" value="<?php echo $keyword;?>" onfocus="onsearch(this,1);" onblur="onsearch(this,0)" />
            <input type="submit" name="button" id="button" value="<?php echo SEARCH;?>" class="button" />
        </td>
        <td align="right">
          <label>
            <select name="cbo_menutype" id="cbo_menutype" onchange="document.frm_list.submit();">
              <option value="all">Select once menu</option>
              <?php 
			    $objmnu=new CLS_MENU();
                $str=$objmnu->getListmenu("option");
				unset($objmnu);
			  	echo $str;
			  ?>
            <script language="javascript">
			cbo_Selected('cbo_menutype','<?php echo $mnuid;?>');
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
        <td width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></td>
        <td width="50" align="center"><?php echo CPAR_ID;?></td>
        <td align="center"><?php echo CCODE;?></td>
        <td align="center"><?php echo CNAME;?></td>
        <td width="100" align="center"><?php echo CTYPE;?></td>
        <td width="50" align="center"><?php echo CORDER;?><img src="templates/default/images/save.png" width="13" alt="Save" longdesc="#" /></td>
        <td width="50" align="center"><?php echo CACTIVE;?></td>
        <td width="50" align="center"><?php echo CEDIT;?></td>
        <td width="50" align="center"><?php echo CDELETE;?></td>
      </tr>
      <?php
	  $obj->listTableItemMenu($strwhere.' 1=1',$cur_page,0,0);
	  ?>
    </table>
  </form>
</div>
<?php //----------------------------------------------?>