<?php
	defined("ISHOME") or die("Can not acess this page, please come back!");
	$id="";
	if(isset($_GET["id"]))
		$id=$_GET["id"];
	if(!isset($obj))
	$obj=new CLS_COMS();
	$obj->getList(" WHERE `com_id`='$id' ",'');
	$row=$obj->Fetch_Assoc();
?>
<div id="action">
 <script language="javascript">
 function checkinput(){
	var codeReg = /^[a-z0-9]{2,50}$/i;
	if($("#txtname").val()==""){
	 	$("#txtname_err").fadeTo(200,0.1,function(){ 
		  $(this).html('Yêu cầu nhập tên Component').fadeTo(900,1);
		});
	 	$("#txtname").focus();
	 	return false;
	}
	if($("#txtcode").val()==""){
		$("#txtcode_err").fadeTo(200,0.1,function(){ 
		  $(this).html('Yêu cầu nhập mã Component').fadeTo(900,1);
		});
	 	$("#txtcode").focus();
	    return false;
	}
	else if (($("#txtcode").val().trim()).indexOf(' ') > -1) {
	 	$("#txtcode_err").fadeTo(200,0.1,function(){
		 	$("#txtcode_err").html("Mã có chứa dấu cách(space). Vui lòng nhập mã không có dấu cách.").fadeTo(900,1);
		 });
		 $("#txtcode").focus();
		 return false;
	}
	else if (($("#txtcode").val().trim()).length<2) {
		$("#txtcode_err").fadeTo(200,0.1,function(){
		 	$("#txtcode_err").html("Mã gồm ít nhất 2 ký tự").fadeTo(900,1);
		 });
		 $("#txtcode").focus();
		 return false;
	}
	else if (!codeReg.test($("#txtcode").val().trim())) {
		$("#txtcode_err").fadeTo(200,0.1,function(){
		 	$("#txtcode_err").html("Mã gồm các chữ cái a->z, số 0->9, không bao gồm dấu cách(space)").fadeTo(900,1);
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
			$("#txtname_err").fadeTo(200,0.1,function(){ 
			  $(this).html('Yêu cầu nhập tên Component').fadeTo(900,1);
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
			  $(this).html('Yêu cầu nhập mã Component').fadeTo(900,1);
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
	<fieldset><legend><strong>Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.</strong></legend>
    <table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:#CCC 1px solid;">
      <tr>
        <td width="150" align="right" bgcolor="#EEEEEE"><strong><?php echo CNAME;?> <font color="red">*</font></strong></td>
        <td>
          <input type="text" name="txtname" id="txtname" value="<?php echo $row['name'];?>">
          <label id="txtname_err" class="check_error"></label>
	      <input type="hidden" name="txtid" id="txtid" value="<?php echo $row['com_id'];?>"></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo CCODE;?> <font color="red">*</font></strong></td>
        <td>
          <input type="text" name="txtcode" id="txtcode" value="<?php echo $row['code'];?>">
          <label id="txtcode_err" class="check_error"></label>
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo CSITE;?>&nbsp;</strong></td>
        <td>
            <select name="cbo_site" id="cbo_site">
              <option value="site" selected="selected"><?php echo CSITE;?></option>
              <option value="admin"><?php echo CADMIN;?></option>
              <script language="javascript">
			  cbo_Selected('cbo_site','<?php echo $row['site'];?>');
			  </script>
            </select>
		</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo CPUBLIC;?>&nbsp;</strong></td>
        <td>
        <input name="optactive" type="radio" id="radio" value="1" <?php if($row['isactive']==1) echo "checked";?>>
			<?php echo CYES;?>
        <input name="optactive" type="radio" id="radio2" value="0" <?php if($row['isactive']==0) echo "checked";?>>
			<?php echo CNO;?></td>
      </tr>
    </table>
    </fieldset>
	<fieldset><legend><strong><?php echo CDESC;?>:</strong></legend>
          <?php //Create_textare("txtdesc",'oEdit1');?>
            <textarea name="txtdesc" id="txtdesc" cols="45" rows="5"><?php echo $row['desc'];?></textarea>
        	<script language="javascript">
				var oEdit1=new InnovaEditor("oEdit1");
				oEdit1.width="100%";
				oEdit1.height="300";
				oEdit1.cmdAssetManager ="modalDialogShow('<?php echo URLEDITOR;?>/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
				oEdit1.REPLACE("txtdesc");
				document.getElementById("idContentoEdit1").style.height="225px";
			</script>
      <label>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
      </label>
    </fieldset>
  </form>
</div>