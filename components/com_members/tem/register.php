<?php
if(isset($_POST['cmd_register'])){
	$flag='';
	$code=$_POST['txt_code'];
	if($_SESSION['SERCURITY_CODE']==$code){
		$obj=new CLS_SALER;
		$obj->CMT=md5(sha1($_POST['txt_cmt']));
		$obj->Password=md5(sha1($_POST['txt_pas']));
		$obj->Fullname=addslashes($_POST['txt_name']);
		$obj->Phone=$_POST['txt_tel'];
		$obj->Email=$_POST['txt_email'];
		$obj->Code=$_POST['txt_parcode'];
		$obj->Add_New();
		$flag='Success';
	}else{
		$flag='Error';
	}
	if($flag=='Success'){
	?>
	<script language='javascript'>
		alert('Đăng ký thành công! Bạn hãy chờ xác nhận từ ban quản trị');
		window.location='http://muathu7.vn';
	</script>
	<?php 
	}
}
?>
<script language='javascript'>
function checkinput(){
	var fillter=/^([0-9])+$/;
	if(fillter.test($('#txt_cmt').val())==false || $('#txt_cmt').val().length<9 ){
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
	if($('#txt_name').val()==''){
		alert('Hãy nhập tên đầy đủ của bạn!'); $('#txt_name').focus();return false;
	}
	if($('#txt_tel').val()==''){
		alert('Bạn hãy nhập số điện thoại trước khi gửi!'); $('#txt_tel').focus();return false;
	}
	if($('#txt_code').val()==''){
		alert('Bạn chưa điền mã bảo mật!'); $('#txt_code').focus();return false;
	}
	if($('#txt_chk').is(':checked')==false){
		alert('Bạn phải đồng ý với các điều khoản của muathu7.vn!'); $('#txt_chk').focus();return false;
	}
}
</script>
<form method='POST' action='' autocomplete="off">
<?php if(isset($flag) && $flag==false){?>
<h2 align='center' style='color:red;'>Đăng ký không thành công, mời bạn liên hệ với ban quản trị muathu7.vn!</h2>
<?php } else if(isset($flag) && $flag=='Error'){?>
<h2 align='center' style='color:red;'>Mã bảo mật không đúng, mời bạn thử lại một lần nữa!</h2>
<?php }?>
<h2 align='center'>ĐĂNG KÝ CỘNG TÁC VIÊN BÁN HÀNG ONLINE</h2>
<p align='center'>Để đảm bảo quyền lợi các thành viên tham gia. Mỗi thành viên chỉ được đăng ký một tài khoản duy nhất với một số CMT xác định. 
Bạn hãy cung cấp đúng số CMT của bạn để đảm bảo quyền lợi cộng tác viên theo quy định của MUATHU7.
MUATHU7.VN cam kết bảo mật thông tin của các thành viên tham gia.</p>
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
			<td align='right'>Mã bảo mật<span class='star'>*</span>:<input type='hidden' name='txt_parcode' id='txt_parcode' value='<?php echo $_SESSION['SCODE'];?>'/></td>
			<td><input style='float:left;margin-right:5px;' type='text' name='txt_code' id='txt_code'/><img style='float:left;' height='21' src='http://muathu7.vn/extensions/captcha/CaptchaSecurityImages.php'/></td>
		</tr>
		<tr>
			<td>&nbsp;	</td>
			<td>
			<label>
			<input type='checkbox' name='txt_chk' id='txt_chk' value='1'/> Tôi đồng ý với nội quy, quy định của muathu7.vn (<a href=''>chi tiết)</a>
			</label>
			</td>
		</tr>
		<tr>
			<td colspan='2' align=center>
				<input type='submit' name='cmd_register' id='cmd_register' value='Đăng ký' onclick='return checkinput();'/>
				<input type='reset' name='cmd_reset' id='cmd_reset' value='Làm lại'/>
			</td>
		</tr>
	</table>
</fieldset>
<br/>
</form>