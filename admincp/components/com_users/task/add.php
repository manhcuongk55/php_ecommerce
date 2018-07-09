<?php
	defined("ISHOME") or die("Can not acess this page, please come back!")
?>
<div id="action">
<script language="javascript">

function checkinput(){
	return true;
}
$(document).ready(function()
{
	$('#txtbirthday').datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: '1900:<?php echo date("Y");?>'
    });
	
	$("#txtusername").blur(function(){
		$("#msgbox").removeClass().addClass('messagebox').text('Kiểm tra dữ liệu...').fadeIn("slow");
		$.post("user_availabity.php",{ user_name:$(this).val() } ,function(data){
		  if($.trim(data)=='nodata' || $.trim(data)=='') {
		  	$("#msgbox").fadeTo(200,0.1,function(){ 
			  //add message and change the class of the box and start fading
			  $(this).html('Vui lòng nhập tên đăng nhập').addClass('messageboxerror').fadeTo(900,1);
			});
		  }
		  else if($.trim(data)=='no'){
		  	$("#msgbox").fadeTo(200,0.1,function(){ 
			  $(this).html('Tên đăng nhập này đã tồn tại. Vui lòng nhập tên đăng nhập khác').addClass('messageboxerror').fadeTo(900,1);
			});		
			document.getElementById("checkuser").value="false";
          }
		  else {
			$("#msgbox").fadeTo(200,0.1,function(){ 
			  $(this).html('Tên đăng nhập có thể sử dụng').addClass('messageboxok').fadeTo(900,1);	
			});
			document.getElementById("checkuser").value="true";
		  }
        });
	});
});
 </script>
  <form id="frm_action" name="frm_action" method="post" action="">
    <fieldset>
	<legend><strong>Thông tin tài khoản người dùng</strong></legend>
    <table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr><td colspan="2">Các mục đánh dấu <font color="red">*</font> là thông tin bắt buộc</td></tr>
      <tr>
        <td width="160" align="right" bgcolor="#EEEEEE"><strong>Tên đăng nhập<font color="red"> *</font></strong></td>
        <td width="788">
          <input name="txtusername" type="text" id="txtusername" size="30" class="required" minlength="3"/>
          <span id="msgbox" style="display:none"></span>
          <input type="hidden" name="checkuser" id="checkuser" value="" />
          <input name="txttask" type="hidden" id="txttask" value="1" />
          </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Mật khẩu<font color="red"> *</font></strong></td>
        <td>
          <input name="txtpassword" type="password" id="txtpassword" size="30" class="required"/>
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Nhập lại mật khẩu <font color="red">*</font></strong></td>
        <td><input name="txtrepass" type="password" id="txtrepass" size="30" class="required" /></td>
      </tr>
    </table>
    </fieldset>
    <fieldset>
	<legend><strong>Thông tin người dùng</strong></legend>
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="170" align="right" bgcolor="#EEEEEE"><strong>Họ & đệm</strong><font color="red"> *</font></strong></td>
        <td width="246"><strong><input name="txtfirstname" type="text" id="txtfirstname" size="30" class="required"/>
         
          </strong></td>
        <td width="191" align="right" bgcolor="#EEEEEE"><strong>Ngày sinh&nbsp;</strong></td>
        <td width="297"><input type="text" name="txtbirthday" id="txtbirthday" /></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Tên <font color="red">*</font></strong></td>
        <td> <input name="txtlastname" type="text" id="txtlastname" size="30" class="required"/></td>
        <td align="right" bgcolor="#EEEEEE"><strong>Giới tính&nbsp;</strong></td>
        <td>
          <input type="radio" name="optgender" value="0" checked="checked" />Nam
          <input type="radio" name="optgender" value="1" />N&#7919;</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Địa chỉ &nbsp;</strong></td>
        <td><label>
          <input name="txtaddress" type="text" id="txtaddress" size="30" />
        </label></td>
        <td align="right" bgcolor="#EEEEEE"><strong>Điện thoại bàn&nbsp;</strong></td>
        <td><input type="text" name="txtphone" id="txtphone" /></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Email&nbsp;</strong></td>
        <td><input name="txtemail" type="text" id="txtemail" size="30" class="required email"/></td>
        <td align="right" bgcolor="#EEEEEE"><strong>Điện thoại di động&nbsp;</strong></td>
        <td><input type="text" name="txtmobile" id="txtmobile" class="required"/></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Nhóm quyền <font color="red">*</font></strong></td>
        <td>
        <select name="cbo_gmember" id="cbo_gmember">
        	<option value="0" style="font-weight:bold; background-color:#cccccc">Chọn nhóm quyền</option>
			<?php 
			 if(!isset($obju)) $obju = new CLS_GUSER();
			  $obju->getListGmem(0,1); 
			  unset($obju);
			?>
        </select>
        </td>
        <td align="right" bgcolor="#EEEEEE"><strong>Tình trạng &nbsp;</strong></td>
        <td><input name="optactive" type="radio" value="1" checked /> Active
          <input name="optactive" type="radio" value="0" /> Deactive</td>
      </tr>
    </table>
      <label>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
      </label>
    </fieldset>
  </form>
</div>