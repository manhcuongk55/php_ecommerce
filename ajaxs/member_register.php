<script language='javascript' src='http://muathu7.vn/js/jquery-1.8.2.min.php'></script>
<script language='javascript'>
$(document).ready(function(){
	$('#cmd_register').click(function(){
		alert('Click!');
	});
});
function checkinput(){
	var fillter=/^([0-9])+$/;
	if(fillter.test($('#txt_cmt').val())==false || $('#txt_cmt').val().length<=9 ){
		alert('Bạn phải nhập CMT đúng của bạn');
		$('#txt_cmt').focus();
		return false;
	}
	if($('#txt_pas').val()==''){
		alert('Bạn phải nhập password đủ mạnh!');$('#txt_pas').focus(); return false;
	}
	if($('#txt_pas').val()!=$('#txt_rpas').val()){
		alert('Gõ lại mật khẩu không chính xác'); $('#txt_rpas').focus();return false;
	}
	if($('#txt_name').val()!=''){
		alert('Hãy nhập tên đầy đủ của bạn!'); $('#txt_name').focus();return false;
	}
	if($('#txt_tel').val()!=''){
		alert('Bạn hãy nhập số điện thoại trước khi gửi!'); $('#txt_tel').focus();return false;
	}
	if($('#txt_code').val()!=''){
		alert('Bạn chưa điền mã bảo mật!'); $('#txt_code').focus();return false;
	}
}
</script>
<form method='POST' action=''>
<h4>Dấu * là thông tin bắt buộc.</h4>
<fieldset>
	<legend>Thông tin tài khoản</legend>
	<table width="550">
		<tr>
			<td align='right' width=150>Số CMT<span class='star'>*</span>:</td>
			<td><input type='text' name='txt_cmt' id='txt_cmt'/> <a href=''>Chi tiết</a></td>
		</tr>
		<tr>
			<td align='right'>Password<span class='star'>*</span>:</td>
			<td><input type='password' name='txt_pas' id='txt_pas'/> <a href=''>Chi tiết</a></td>
		</tr>
		<tr>
			<td align='right'>Confirm Password<span class='star'>*</span>:</td>
			<td><input type='password' name='txt_rpas' id='txt_rpas'/></td>
	</table>
</fieldset>
<fieldset>
	<legend>Thông tin cá nhân</legend>
	<table width="550">
		<tr>
			<td align='right' width=150>Họ Tên<span class='star'>*</span>:</td>
			<td><input type='text' name='txt_name' id='txt_name'/></td>
		</tr>
		<tr>
			<td align='right'>Điện thoại<span class='star'>*</span>:</td>
			<td><input type='text' name='txt_tel' id='txt_tel'/></td>
		</tr>
		<tr>
			<td align='right'>Hòm thư<span class='star'></span>:</td>
			<td><input type='text' name='txt_email' id='txt_email'/></td>
		</tr>
		<tr>
			<td align='right'>Mã bảo mật<span class='star'>*</span>:<input type='hidden' name='txt_codec' id='txt_codec' value=''/></td>
			<td><input style='float:left;margin-right:5px;' type='text' name='txt_code' id='txt_code'/><img style='float:left;' height='21' src='http://muathu7.vn/extensions/captcha/CaptchaSecurityImages.php'/></td>
		</tr>
		<tr>
			<td colspan=2><input type='checkbox' name='txt_chk' id='txt_chk' value='1'/> Tôi đồng ý với nội quy, quy định của muathu7.vn (<a href=''>hi tiết)</a></td>
		</tr>
		<tr>
			<td colspan='2' align=center>
				<input type='button' name='cmd_register' id='cmd_register' value='Đăng ký'/>
				<input type='reset' name='cmd_reset' id='cmd_reset' value='Làm lại'/>
			</td>
		</tr>
	</table>
</fieldset>
<br/>
</form>