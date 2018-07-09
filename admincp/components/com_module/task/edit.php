<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$id='';
	if(isset($_GET['id']))
		$id=(int)$_GET['id'];
	$obj->getList(" WHERE `mod_id`='$id' ",'');
	$row=$obj->Fetch_Assoc();
?>
<div id="action">
 <script language="javascript">
 function checkinput(){
	if($('#txttitle').val()=="") {
		$("#txttitle_err").fadeTo(200,0.1,function(){ 
		  $(this).html('Mời bạn nhập tiêu đề Module').fadeTo(900,1);
		});
		$('#txttitle').focus();
		return false;
	}
	if( $('#cbo_type').val()=="mainmenu") {
		if($('#cbo_menutype').val()=="") {
			$("#menutype_err").fadeTo(200,0.1,function(){ 
			  $(this).html('Mời chọn kiểu Menu cần hiển thị').fadeTo(900,1);
			});
			$('#cbo_menutype').focus();
			return false;
		}
	}
	else if( $('#cbo_type').val()=="latestnew" || $('#cbo_type').val()=="hotnews"|| $('#cbo_type').val()=="othernews") {
		if($('#cbo_cata').val()=="0") {
			$("#category_err").fadeTo(200,0.1,function(){ 
			  $(this).html('Mời chọn nhóm tin').fadeTo(900,1);
			});
			$('#cbo_cate').focus();
			return false;
		}
	}
 
 return true;
}
 function select_type(){
	 var txt_viewtype=document.getElementById("txt_type");
	 var cbo_viewtype=document.getElementById("cbo_type");
	 for(i=0;i<cbo_viewtype.length;i++)
	 if(cbo_viewtype[i].selected==true)
	 txt_viewtype.value=cbo_viewtype[i].value;
	 document.frm_type.submit();
 }
 
 $(document).ready(function() {
	$('#txttitle').blur(function(){
		if($(this).val()=="") {
			$("#txttitle_err").fadeTo(200,0.1,function(){ 
			  $(this).html('Mời bạn nhập tiêu đề Module').fadeTo(900,1);
			});
			$('#txttitle').focus();
		}
	})
});
 </script>
 <?php
 	$viewtype=$row['type'];
	if(isset($_POST["txt_type"]))
	$viewtype=addslashes($_POST["txt_type"]);
 ?>
  <form id="frm_type" name="frm_type" method="post" action="" style="display:none;">
    <label>
      <input type="text" name="txt_type" id="txt_type" />
    </label>
  </form>
<form id="frm_action" name="frm_action" method="post" action="">
Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.
  <fieldset>
    <legend><strong><?php echo CDETAIL;?>:</strong></legend>
	<table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:#CCC 1px solid;">
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo CTYPE;?></strong></td>
        <td>
        <select name="cbo_type" id="cbo_type" onchange="select_type();">
  	        <?php 
			$obj->LoadModType();?>
            <script language="javascript">
			cbo_Selected('cbo_type','<?php echo $viewtype;?>');
            </script>
	    </select>&nbsp;
         <input type="hidden" name="txtid" id="txtid" value="<?php echo $row['mod_id'];?>" /></td>
      </tr>
      <tr>
        <td width="150" align="right" bgcolor="#EEEEEE"><strong><?php echo CTITLE;?> <font color="red">*</font></strong></td>
        <td>
          <input name="txttitle" type="text" id="txttitle" size="45" value="<?php echo $row['title'];?>">
          <label id="txttitle_err" class="check_error"></label>
		</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo SHOWTITLE;?>&nbsp;</strong></td>
        <td><input name="optviewtitle" type="radio" id="radio" value="1" <?php if($row['viewtitle']==1) echo "checked";?>/>
          <?php echo CYES;?>
          <input name="optviewtitle" type="radio" id="radio2" value="0" <?php if($row['viewtitle']==0) echo "checked";?> />
          <?php echo CNO;?></td>
        </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo CPOSITION;?>&nbsp;</strong></td>
        <td>
          <select name="cbo_position" id="cbo_position">
             <?php LoadPosition();?>
             <script language="javascript">
			  cbo_Selected('cbo_position','<?php echo $row['position'];?>');
			  </script>
          </select>   
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo CCLASS;?>&nbsp;</strong></td>
        <td><label>
          <input type="text" name="txtclass" id="txtclass" value="<?php echo $row['class'];?>" />
        </label></td>
        </tr>
	  <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo CPUBLIC;?>&nbsp;</strong></td>
        <td>
        <input name="optactive" type="radio" id="radio" value="1" <?php if($row['isactive']==1) echo "checked";?>><?php echo CYES;?>
        <input name="optactive" type="radio" id="radio2" value="0" <?php if($row['isactive']==0) echo "checked";?>><?php echo CNO;?></td>
      </tr>
    </table>
    </fieldset>
    <?php 
	$arr_type=array('mainmenu','menucat','latestnews','comments','hotnews','othernews','html','catalog','hotproduct');
	if(in_array($viewtype,$arr_type)){ ?>
    <fieldset>
    <legend><strong><?php echo "Parameter";?>:</strong></legend>
  	<table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:#CCC 1px solid;">
      <?php if($viewtype=="mainmenu" || $viewtype = "menucat"){?>
      <tr>
  	    <td width="150" align="right" bgcolor="#EEEEEE" valign="top"><strong><?php echo MMENU;?> <font color="red">*</font></strong></td>
  	    <td>
        	<select name="cbo_menutype" id="cbo_menutype" onchange="document.frm_list.submit();">
              <option value="all">Select once menu</option>
              <?php 
			  if(!isset($objmenu)) $objmenu=new CLS_MENU();
			  	echo $objmenu->getListmenu("option");
			  ?>
              <script language="javascript">
			  cbo_Selected('cbo_menutype','<?php echo $row['mnu_id'];?>');
			  </script>
            </select>
            <label id="menutype_err" class="check_error"></label>
        </td>
      </tr>
      <?php }else if($viewtype=="latestnews" || $viewtype=='hotnews' || $viewtype=="comments" || $viewtype=='othernews'){?>
      <tr>
  	    <td width="150" align="right" bgcolor="#EEEEEE" valign="top"><strong><?php echo CCATEGORY;?> <font color="red">*</font></strong></td>
  	    <td>
        	<select name="cbo_cate" id="cbo_cate">
  	        <option value="0" title="Top"><?php echo SELECT_ONCE_CATEGORY;?></option>
           <?php
		  	if(!isset($objCate)) $objCate=new CLS_CATE();
				$objCate->getListCate(0,0);
		  	?>
	        </select>  
			<script language="javascript">
			  cbo_Selected('cbo_cate','<?php echo $row['cat_id'];?>');
			  </script>
            <label id="category_err" class="check_error"></label> 
        </td>
      </tr>
      <?php }else if($viewtype=="html"){?>
  	  <tr>
  	    <td colspan="2">
        <textarea name="txtcontent" id="txtcontent" cols="45" rows="5"><?php echo uncodeHTML($row['content']);?></textarea>
		<script language="javascript">
            var oEdit1=new InnovaEditor("oEdit1");
            oEdit1.width="100%";
            oEdit1.height="300";
            oEdit1.cmdAssetManager ="modalDialogShow('<?php echo URLEDITOR;?>/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
            oEdit1.REPLACE("txtcontent");
            document.getElementById("idContentoEdit1").style.height="225px";
        </script>
        </td>
      </tr>
      <?php } else {};?>
      <tr>
  	    <td width="150" align="right" bgcolor="#EEEEEE" valign="top"><strong><?php echo CTHEME;?>&nbsp;</strong></td>
  	    <td>
        	<select name="cbo_theme" id="cbo_theme" onchange="document.frm_list.submit();">
              <option value="">Select once theme</option>
             <?php LoadModBrow("mod_".$viewtype);?>
			<script language="javascript">
				cbo_Selected('cbo_theme','<?php echo $row['theme'];?>');
			  </script>
            </select>      
        </td>
      </tr>
    </table>
    </fieldset>
    <?php }?>
  	<fieldset>
     <legend><strong><?php echo MENU_ASSIGNMENT;?>:</strong></legend>
   <table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:#CCC 1px solid;">
  	  <tr>
  	    <td width="150" align="right" bgcolor="#EEEEEE"><strong><?php echo MENUS;?>&nbsp;</strong></td>
  	    <td>
        <?php
			$flag=3;
			if($row['mnuids']=="all")
				$flag=1;
			if($row['mnuids']=="")
				$flag=2;
		?>
           <input name="optmenus" type="radio" id="radio3" value="1" onclick="selectall(1);" <?php if($flag==1) echo "checked";?> />
          <?php echo ALL;?> 
          <input name="optmenus" type="radio" id="radio4" onclick="selectall(0);" value="2" <?php if($flag==2) echo "checked";?> />
          <?php echo NONE;?>
          <input type="radio" name="optmenus" id="radio5" value="3" onclick="selectall(2);" <?php if($flag==3) echo "checked";?> />
          <?php echo SELECT_MENUS;?></td>
      </tr>
  	  <tr>
  	    <td align="right" valign="top" bgcolor="#EEEEEE"><strong><?php echo CCATEGORY;?>:</strong></td>
  	    <td>
		<style type="text/css">
		  option.menutype{
			  font-weight: bold;
		  }
          </style>
          <input name="txtmenus" type="hidden" id="txtmenus" value="<?php echo trim($row['mnuids']);?>" />
  	      <select name="cbo_menus" size="7" id="cbo_menus" multiple="multiple">      
           <?php  MENUS_ASSIGN(); 	?>
	        </select> 
            <script language="javascript">
				selectedIDs(<?php echo $flag;?>); // hien thi selected tat ca cac muc da chon
			</script>
	      </td>
      </tr>
    </table>
    </fieldset>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
  </form>
</div>