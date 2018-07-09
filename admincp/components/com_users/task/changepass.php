<?php
ini_set('display_errors', '1');
defined("ISHOME") or die("Can't acess this page, please come back!");
$memid="";
if(isset($_GET["id"]))
	$memid=(int)$_GET["id"];
	
if(!isset($objmember)) $objmember = new CLS_USERS(); 

if(isset($_POST["txtnewpass"])) {
	$user = $_POST["txtusername"];
	$newpass = $_POST["txtnewpass"];
	$result = $objmember->ChangePass_User($user,$newpass);
	if($result) {
		echo '<div id="action"><h3 style="color:#3399FF">Mật khẩu đã được đổi thành công !</h3></div>';
	}
	else
		echo '<div id="action"><h3 style="color:red">Lỗi trong quá trình lưu trữ. Mật khẩu chưa được đổi.</h3></div>';
}
$objmember->getMemberByID($memid);
?>
<script language="javascript">
  function checkinput(){
	  if($("#txtpassword").val()==''){
	  	$("#pass_error").fadeTo(200,0.1,function() //start fading the messagebox
		{
			$(this).html('Vui lòng nhập mật khẩu đang sử dụng hiện tại').addClass('check_error').fadeTo(900,1);
		})
		$("#txtpassword").focus();
		return false;
	  }
	  if($("#txtnewpass").val()==''){
	  	$("#newpass_error").fadeTo(200,0.1,function() //start fading the messagebox
		{
			$(this).html('Vui lòng nhập mật khẩu mới').addClass('check_error').fadeTo(900,1);
		})
		$("#txtnewpass").focus();
		return false;
	  }
	  if($("#txtnewpass2").val()==''){
	  	$("#newpass2_error").fadeTo(200,0.1,function() //start fading the messagebox
		{
			$(this).html('Vui lòng nhập lại mật khẩu mới lần 2').addClass('check_error').fadeTo(900,1);
		})
		$("#txtnewpass2").focus();
		return false;
	  }
	  if($("#txtnewpass").val()!='' && $("#txtnewpass2").val()!='' && $("#txtnewpass").val()!=$("#txtnewpass2").val() ){
	  	$("#newpass2_error").fadeTo(200,0.1,function() //start fading the messagebox
		{
			$(this).html('Mật khẩu mới nhập 2 lần không khớp nhau. Vui lòng nhập chính xác.').addClass('check_error').fadeTo(900,1);
		})
		$("#txtnewpass2").focus();
		return false;
	  }
	  return true;
  }
</script>
<div id="action">
<form method="post" action="#" name="frm_action" id="frm_action">
<table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr><td colspan="2">Các mục đánh dấu <font color="red">*</font> là thông tin bắt buộc</td></tr>
      <tr>
        <td width="235" align="right" bgcolor="#EEEEEE"><strong>Tên đăng nhập<font color="red"> *</font></strong></td>
        <td width="750">
          <input name="txtusername" type="text" class="required" id="txtusername" value="<?php echo $objmember->UserName;?>" minlength="3"<?php if($objmember->isAdmin()==false) echo '  readonly="readonly"';?>/>
          <span id="msgbox" style="display:none"></span>
          <input type="hidden" name="checkuser" id="checkuser" value="" />
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Mật khẩu hiện tại <font color="red">*</font></strong></td>
        <td>
		<?php if($objmember->isAdmin()==true) { ?>
        <input type="password" name="txtpassword" id="txtpassword" value="<?php echo $objmember->Password;?>" readonly/> 
        <?php } else { ?>
        <input type="password" name="txtpassword" id="txtpassword" class="required" value=""/>
        <?php } ?>
        <label id="pass_error" class="check_error"></label>
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Mật khẩu mới <font color="red">*</font></strong></td>
        <td><input type="password" name="txtnewpass" id="txtnewpass" class="required" value=""/>
        <label id="newpass_error" class="check_error"></label>
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Nhập lại mật khẩu mới <font color="red">*</font></strong></td>
        <td><input type="password" name="txtnewpass2" id="txtnewpass2" class="required"/>
        <label id="newpass2_error" class="check_error"></label>
        </td>
      </tr>
    </table>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
</form>
</div>