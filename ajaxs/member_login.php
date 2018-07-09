<?php session_start();?>
<script language='javascript' src='http://muathu7.vn/js/jquery-1.8.2.min.php'></script>
<script language='javascript'>
$(document).ready(function(){
	$('#cmd_login').click(function(){
		if(checkinput()==true){
			$.post('http://muathu7.vn/ajaxs/process_login.php',{txt_user:$('#txt_cmt').val(),txt_pass: $('#txt_pas').val(),txt_code:$('#txt_code').val()},function(data){
				if(data=='ICORECT'){
					alert('Mã bảo mật không chính xác mời bạn thử lại một lần nữa!');
					return false;
				}else if(data=='Faile'){
					alert('Bạn đăng nhập không thành công, hãy thử lại một lần nữa một cách cẩn thận!');
					return false;
				}else{
					$('#bg_popup').hide(); $('#popup').hide();
					window.location='http://muathu7.vn/ca-nhan.html';
				}
			});
		}
	});
});
function checkinput(){
	var fillter=/^([0-9])+$/;
	if(fillter.test($('#txt_cmt').val())==false || $('#txt_cmt').val().length<9 ){
		alert('Bạn phải nhập CMT đúng của bạn');
		$('#txt_cmt').focus();
		return false;
	}
	if($('#txt_pas').val()==''){
		alert('Bạn phải nhập mật khẩu đúng của bạn!');$('#txt_pas').focus(); return false;
	}
	if($('#txt_code').val()==''){
		alert('Bạn chưa điền mã bảo mật!'); $('#txt_code').focus();return false;
	}
	return true;
}
</script>
<form method='POST' action='' autocomplete="off">
<h4>Dấu * là thông tin bắt buộc.</h4>
<fieldset>
	<legend>Thông tin tài khoản</legend>
	<table width="100%">
		<tr>
			<td align='right' width=150>Số CMT<span class='star'>*</span>:</td>
			<td><input type='text' name='txt_cmt' id='txt_cmt'/></td>
		</tr>
		<tr>
			<td align='right'>Password<span class='star'>*</span>:</td>
			<td><input type='password' name='txt_pas' id='txt_pas'/></td>
		</tr>
		<tr>
			<td align='right'>Mã bảo mật<span class='star'>*</span>:</td>
			<td><input style='float:left;margin-right:5px;' type='text' name='txt_code' id='txt_code'/><img style='float:left;' height='21' src='http://muathu7.vn/extensions/captcha/CaptchaSecurityImages.php'/></td>
		</tr>
		<tr>
			<td colspan='2' align=center>
				<input type='button' name='cmd_login' id='cmd_login' value='Đămg nhập'/>
				<input type='reset' name='cmd_reset' id='cmd_reset' value='Làm lại'/>
			</td>
		</tr>
	</table>
</fieldset>
<br/>
</form>