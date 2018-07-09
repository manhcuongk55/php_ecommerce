<?php
	defined("ISHOME") or die("Can't acess this page, please come back!")
?>
<div id="action">
<script language="javascript">
function checkinput(){	

	if($("#cbo_viewtype").val()=="block" || $("#cbo_viewtype").val()=="list"){
		if($("#cbo_cate").val()=="0") {
			$("#category_err").fadeTo(200,0.1,function()
			{ 
			  $(this).html('Vui lòng chọn một nhóm tin').fadeTo(900,1);
			});
			$("#cbo_cate").focus();
			return false;
		}
	}
	else if($("#cbo_viewtype").val()=="article"){
		if($("#cbo_article").val()=="0") {
			$("#article_err").fadeTo(200,0.1,function()
			{ 
			  $(this).html('Vui lòng chọn một bài viết').fadeTo(900,1);
			});
			$("#cbo_article").focus();
			return false;
		}
	}
	else if($("#cbo_viewtype").val()=="link"){
		if($("#txtlink").val()=="" || $("#txtlink").val()=="http://" ) {
			$("#link_err").fadeTo(200,0.1,function()
			{ 
			  $(this).html('Vui lòng nhập đường dẫn đến bài viết').fadeTo(900,1);
			});
			$("#txtlink").focus();
			return false;
		}
	}
	
	if($("#txtname").val()=="")
	{
	 	$("#txtname_err").fadeTo(200,0.1,function()
		{ 
		  $(this).html('Vui lòng nhập tên').fadeTo(900,1);
		});
	 	$("#txtname").focus();
	 	return false;
	}
	if($("#txtcode").val()=="")
	{
		$("#txtcode_err").fadeTo(200,0.1,function()
		{ 
		  $(this).html('Vui lòng nhập mã').fadeTo(900,1);
		});
	 	$("#txtcode").focus();
	    return false;
	}
	else if (($("#txtcode").val().trim()).length<2) {
		$("#txtcode_err").fadeTo(200,0.1,function()
		 {
		 	$("#txtcode_err").html("Mã gồm ít nhất 2 ký tự").fadeTo(900,1);
		 });
		 $("#txtcode").focus();
		 return false;
	}
	return true;
}

$(document).ready(function()
{
	$("#txtname").blur(function() {
		if( $(this).val()=='') {
			$("#txtname_err").fadeTo(200,0.1,function()
			{ 
			  $(this).html('Vui lòng nhập tên').fadeTo(900,1);
			});
		}
		else {
			$("#txtname_err").fadeTo(200,0.1,function()
			{ 
			  $(this).html('').fadeTo(900,1);
			});
		}
	})
	
	$("#txtcode").blur(function() {
		if( $(this).val()=='') {
			$("#txtcode_err").fadeTo(200,0.1,function()
			{ 
			  $(this).html('Vui lòng nhập mã').fadeTo(900,1);
			});
		}
		else {
			$("#txtcode_err").fadeTo(200,0.1,function()
			{ 
			  $(this).html('').fadeTo(900,1);
			});
			
		}
	})
})

 function select_type(){
	 var txt_viewtype=document.getElementById("txt_viewtype");
	 var cbo_viewtype=document.getElementById("cbo_viewtype");
	 for(i=0;i<cbo_viewtype.length;i++)
	 if(cbo_viewtype[i].selected==true)
	 txt_viewtype.value=cbo_viewtype[i].value;
	 document.frm_type.submit();
 }
 </script>
 <?php
 	$viewtype="block";
	if(isset($_POST["txt_viewtype"]))
	$viewtype=$_POST["txt_viewtype"];
	
 ?>
  <form id="frm_type" name="frm_type" method="post" action="" style="display:none;">
    <label>
      <input type="text" name="txt_viewtype" id="txt_viewtype" />
    </label>
  </form>
<form id="frm_action" name="frm_action" method="post" action="">
  Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.
  <fieldset>
    <legend><strong><?php echo CTYPE;?>:</strong></legend>
  	<table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:#CCC 1px solid;">
  	  <tr>
  	    <td width="150" align="right" bgcolor="#EEEEEE"><strong><?php echo CTYPE;?>&nbsp;</strong></td>
  	    <td>
  	      <select name="cbo_viewtype" id="cbo_viewtype" onchange="select_type();">
  	        <option value="block" selected="selected">Block</option>
  	        <option value="list">List</option>
  	        <option value="article">Article</option>
  	        <option value="link">Links</option>
            <script language="javascript">
			cbo_Selected('cbo_viewtype','<?php echo $viewtype;?>');
            </script>
	      </select>
	      </td>
      </tr>
      <?php if($viewtype=="block" || $viewtype=="list"){?>
  	  <tr>
  	    <td align="right" bgcolor="#EEEEEE"><strong><?php echo CCATEGORY;?>&nbsp;<font color="red">*</font></strong></td>
  	    <td>
  	      <select name="cbo_cate" id="cbo_cate">
  	        <option value="0" title="Top"><?php echo SELECT_ONCE_CATEGORY;?></option>
           <?php
		  	if(!isset($objCate))
			$objCate=new CLS_CATE();
			 $objCate->ListCategory(0,0,0,1);
			//$objCate->getListCate(0,0);
		  	?>
	      </select> 
	      <label id="category_err" class="check_error"></label>
        </td>
      </tr>
      <?php } else if($viewtype=="article"){?>
  	  <tr>
  	    <td align="right" bgcolor="#EEEEEE"><strong><?php echo CARTICLE;?> <font color="red">*</font></strong></td>
  	    <td>
        <select name="cbo_article" id="cbo_article">
  	      <option value="0" title="N/A"><?php echo SELECT_ONCE_ARTICLE;?></option>
          <?php
			$objContent=new CLS_CONTENTS();
			$objContent->LoadConten();
		  ?>
           <script language="javascript">
			cbo_Selected('cbo_article','<?php echo $objContent->ID;?>');
           </script>
	    </select>
        <label id="article_err" class="check_error"></label> 
        </td>
	  </tr>
      <?php } else { ?>
  	  <tr>
  	    <td align="right" bgcolor="#EEEEEE"><strong><?php echo CLINK;?> <font color="red">*</font></strong></td>
  	    <td><input name="txtlink" type="text" id="txtlink" value="http://" size="45" />
        	<label id="link_err" class="check_error"></label>
        </td>
	    </tr>
       <?php }?>
    </table>
    </fieldset>
  <fieldset>
    <legend><strong><?php echo CDETAIL;?>:</strong></legend>
	<table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:#CCC 1px solid;">
      <tr>
        <td width="150" align="right" bgcolor="#EEEEEE"><strong><?php echo CNAME;?> <font color="red">*</font></strong></td>
        <td>
          <input name="txtname" type="text" id="txtname" size="45">
          <label id="txtname_err" class="check_error"></label>
          <input name="txttask" type="hidden" id="txttask" value="1" />
		</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo CCODE;?> <font color="red">*</font></strong></td>
        <td>
          <input name="txtcode" type="text" id="txtcode" size="45" />
          <label id="txtcode_err" class="check_error"></label>
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo CPARENT;?>&nbsp;</strong></td>
        <td>
          <select name="cbo_parid" id="cbo_parid">
              <option value="0">Top</option>
             <?php 
			  if(!isset($objitem))
			  $objitem=new CLS_MENUITEM();
			  echo  $objitem->getListMenuItem($mnuid,0,0);
			 ?>
          </select>  
			 
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo CCLASS;?>&nbsp;</strong></td>
        <td><label>
          <input type="text" name="txtclass" id="txtclass" />
        </label></td>
        </tr>
	  <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo CPUBLIC;?>&nbsp;</strong></td>
        <td>
        <input name="optactive" type="radio" id="radio" value="1" checked><?php echo CYES;?>
        <input name="optactive" type="radio" id="radio2" value="0"><?php echo CNO;?></td>
      </tr>
    </table>
    </fieldset>
  <fieldset>
    <legend><strong><?php echo CDESC;?>:</strong></legend>
    <?php //Create_textare("txtdesc",'oEdit1');?>
    <textarea name="txtdesc" id="txtdesc" cols="45" rows="5">&nbsp;</textarea>
    <script language="javascript">
				var oEdit1=new InnovaEditor("oEdit1");
				oEdit1.width="100%";
				oEdit1.height="300";
				oEdit1.cmdAssetManager ="modalDialogShow('<?php echo URLEDITOR;?>/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
				oEdit1.REPLACE("txtdesc");
				document.getElementById("idContentoEdit1").style.height="225px";
			</script>
    </fieldset>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
  </form>
</div>