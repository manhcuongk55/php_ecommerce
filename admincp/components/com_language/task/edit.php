<?php
	defined("ISHOME") or die("Can't acess this page, please come back!");
	$id="";
	if(isset($_GET["id"]))
		$id=(int)$_GET["id"];
	$obj=new CLS_LANGUAGE();
	$obj->getList(" WHERE `lag_id`='$id' ",'');
	$row=$obj->Fetch_Assoc();
?>
<div id="action">
<script language="javascript">
function checkinput(){
	var codeReg = /^[a-z0-9]{2,50}$/i;
	if($("#txtname").val()==""){
	 	$("#txtname_err").fadeTo(200,0.1,function(){ 
		  $(this).html('Yêu cầu nhập tên ngôn ngữ').fadeTo(900,1);
		});
	 	$("#txtname").focus();
	 	return false;
	}
	if($("#txtcode").val()==""){
		$("#txtcode_err").fadeTo(200,0.1,function(){ 
		  $(this).html('Yêu cầu nhập mã ngôn ngữ').fadeTo(900,1);
		});
	 	$("#txtcode").focus();
	    return false;
	}
	else if (($("#txtcode").val().trim()).indexOf(' ') > -1) {
	 	$("#txtcode_err").fadeTo(200,0.1,function(){
		 	$("#txtcode_err").html("Mã có chứa dấu cách(space). Vui lòng nhập mã không có dấu cách.").fadeTo(900,1);
		 });
		 return false;
	}
	else if (($("#txtcode").val().trim()).length<2) {
		$("#txtcode_err").fadeTo(200,0.1,function(){
		 	$("#txtcode_err").html("Mã gồm ít nhất 2 ký tự").fadeTo(900,1);
		 });
		 return false;
	}
	else if (!codeReg.test($("#txtcode").val().trim())) {
		$("#txtcode_err").fadeTo(200,0.1,function(){
		 	$("#txtcode_err").html("Mã gồm các chữ cái a->z, số 0->9, không bao gồm dấu cách(space").fadeTo(900,1);
		 });
		 return false;
	}
	return true;
}
$(document).ready(function()
{
	$("#txtname").blur(function() {
		if( $(this).val()=='') {
			$("#txtname_err").fadeTo(200,0.1,function(){ 
			  $(this).html('Yêu cầu nhập tên ngôn ngữ').fadeTo(900,1);
			});
		}
		else {
			$("#txtname_err").fadeTo(200,0.1,function(){ 
			  $(this).html('').fadeTo(900,1);
			});
		}
	})
	
	$("#txtcode").blur(function() {
		if( $(this).val()=='') {
			$("#txtcode_err").fadeTo(200,0.1,function(){ 
			  $(this).html('Yêu cầu nhập mã ngôn ngữ').fadeTo(900,1);
			});
		}
		else {
			$("#txtcode_err").fadeTo(200,0.1,function(){ 
			  $(this).html('').fadeTo(900,1);
			});
		}
	})
})
</script>
  <form id="frm_action" name="frm_action" method="post" action="">
  	Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.
    <table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:#CCC 1px solid;">
      <tr>
        <td width="150" align="right" bgcolor="#EEEEEE">
        	<strong><?php echo $objlang->LANG_NAME;?> <font color="red">*</font></strong>
        </td>
        <td>
          <input type="text" name="txtname" id="txtname" value="<?php echo $row['name'];?>">
          <label id="txtname_err" class="check_error"></label>
          <input type="hidden" name="txtid" id="txtid" value="<?php echo $row['lag_id'];?>">
		</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo $objlang->LANG_CODE;?> <font color="red">*</font></strong>
        </td>
        <td><input type="text" name="txtcode" id="txtcode" value="<?php echo $row['code'];?>" />
            <label id="txtcode_err" class="check_error"></label>
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo $objlang->LANG_FLAG;?> <font color="red">*</font></strong></td>
        <td><input name="txtflag" type="text" id="txtflag" maxlength="50" value="<?php echo $row['flag'];?>" /></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE">
        	<strong><?php echo $objlang->LANG_SITE;?> <font color="red">*</font></strong>
        </td>
        <td>
        <input name="optsite" type="radio" value="front_end" <?php if($row['site']=="front_end") echo ' checked="checked"';?>/>
          <?php echo $objlang->TAB_SITE;?>
          <input type="radio" name="optsite" value="back_end" <?php if($row['site']=="back_end") echo ' checked="checked"';?>/>
          <?php echo $objlang->TAB_ADMIN;?></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo CPUBLIC;?> <font color="red">*</font></strong></td>
        <td><input name="optactive" type="radio"  value="1" <?php if($row['isactive']==1) echo ' checked="checked"';?> />
          <?php echo CYES;?>
          <input type="radio" name="optactive" value="0" <?php if($row['isactive']==0) echo ' checked="checked"';?>/>
          <?php echo CNO;?></td>
      </tr>
    </table>
    <label>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
      </label>
  </form>
</div>