<?php
	defined("ISHOME") or die("Can't acess this page, please come back!")
?>
<div id="action">
<script language="javascript">
function checkinput(){
	if($("#txtname").val()=="")
	{
	 	$("#txtname_err").fadeTo(200,0.1,function()
		{ 
		  $(this).html('Vui lòng nhập tên').fadeTo(900,1);
		});
	 	$("#txtname").focus();
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
})
</script>
  <form id="frm_action" name="frm_action" method="post" action="">
    <table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr><td colspan="2">Các mục đánh dấu <font color="red">*</font> là thông tin bắt buộc</td></tr>
      <tr>
        <td width="300" align="right" bgcolor="#EEE"><strong><?php echo CNAME;?> <font color="red">*</font></strong></td>
        <td width="603">
          <input name="txtname" type="text" id="txtname" size="30">
          <label id="txtname_err" class="check_error"></label>
		</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEE"><strong>Thuộc nhóm người dùng:</strong></td>
        <td>
            <select name="cbo_parid" id="cbo_parid">
              <option value="0" selected="selected" style="font-weight:bold"><?php echo "Root";?></option>
              <?php 
			  if(!isset($obju)) $obju = new CLS_GUSER();
			  $obju->getListCate(0,1); 
			  unset($obju);
			  ?>
            </select>
		</td>
        <td width="10"></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEE"><strong><?php echo CPUBLIC;?>:</strong></td>
        <td><input name="optactive" type="radio" id="radio" value="1" checked />
          <?php echo CYES;?>
          <input name="optactive" type="radio" id="radio2" value="0" />
        <?php echo CNO;?></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEE"><strong><?php echo CDESC;?>:</strong></td>
        <td><textarea name="txtdesc" cols="50" rows="3" id="txtdesc"></textarea></td>
      </tr>
    </table>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
  </form>
</div>